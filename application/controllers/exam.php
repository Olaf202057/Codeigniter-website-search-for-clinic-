<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('Structure_model','smod');
		$this->load->model('users_model','umod');
        $this->load->model('exam_model','emod');
		$this->load->library('pagination');
		$this->load->model('master_model');
		$this->load->library('form_validation');
		$this->load->model('email_sending');
        $this->load->model('callerservice');
        $this->load->library('paypal_recurring_express');

	}

	/*Function To view Exams*/

	public function index()
	{
    
		$data = array();
		$user_id = $this->session->userdata('user')->id;
        if($user_id=="")
        {
            redirect(base_url());
        }
        $exam_name = $this->input->get('q') ? $this->input->get('q') :0;
        $hospital_id = $this->input->get('structure') ? $this->input->get('structure') :0;
        if($exam_name != '')
        {
            $this->db->where('(tblexamination.exam_type like "%'.$exam_name.'%")');
        }
        
        if($hospital_id != '0')
        {
            $this->db->where('tblstructure.id',$hospital_id);
        }
	    	$this->db->select('tblexamination.*,tblstructure.hospital,tbl_ads_users.budget_amount,tbl_ads_users.examination_id');
		    $this->db->join('tblstructure','tblexamination.struct_id=tblstructure.id');
        $this->db->join('tbl_ads_users','tbl_ads_users.examination_id=tblexamination.id');
		    $exam_info = $this->master_model->getRecords('tblexamination',array('tblstructure.status'=>'1','tblexamination.owner_id'=>$user_id,'tblexamination.status'=>'1'));
        $query = $this->db->last_query();
        
        $this->data['title']="Exam list";
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Prossimo';
        $config['prev_link'] = 'Prev';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>'; 
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'exam/index/';
        $config['uri_segment'] = 3;
        $config['total_rows'] =  count($exam_info); // Total results only.

        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3)?$this->uri->segment(3):0;
		  $query.=" LIMIT ".$offset.', '.$config["per_page"];
	    $result = $this->db->query($query);
	    $exam_info = $result->result_array();
	    
        $links=$this->pagination->create_links();
	    $data['pagination_links'] = $links;
        $data['exams'] = $exam_info;
        if($this->input->is_ajax_request()){
            echo json_encode($data);
        }else{
            $data['menu'] = 'exam';
            $data['common_names'] =  $this->emod->get_exam_common_name();
            $data['scripts'] = array();
            $this->render('exam-view',$data);
        }
	}

	/*Function To add exams*/
	public function add()
	{
       	$user_id = $this->session->userdata('user')->id;
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        if($user_id == "")
        {
            redirect(base_url());
        }
        if(isset($_POST['btn_add_exam']))
        { 
           $this->form_validation->set_rules('exam_type','Exam Type','required|trim|xss_clean');
           //  $this->form_validation->set_rules('budget','Budget','required|trim|xss_clean');
           $this->form_validation->set_rules('official_waiting_days','Official waiting days','required|trim|xss_clean');
           $this->form_validation->set_rules('price','Price','required|trim|xss_clean');
           $this->form_validation->set_rules('price','price','required|trim|xss_clean');
            if($this->form_validation->run())
            {
                $exam_type              = $this->input->post('exam_type');
               // $official_waiting_days  = $this->input->post('official_waiting_days');
                $budget                 = $this->input->post('budget');
                //$payment_method         = $this->input->post('payment_method');
                //$payment_type           = $this->input->post('payment_type');
                $price                  = $this->input->post('price');
               
                $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id,'status'=>1));
                if(count($hospital_info)<=0)
                {
                    $this->session->set_flashdata('error','No hospital available');
                    redirect(base_url().'exam');
                }
                $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
                          
                $insert_exam = array('struct_id'                 => $hospital_info[0]['id'],
                                      'exam_type'               => $exam_type,
                                      'official_waiting_days'   => $official_waiting_days,
                                      'price'                   => $price,
                                      'lastupdated'             => date('Y-m-d H:i:s'),
                                      'date_updated'            => date('Y-m-d'),
                                      'owner_id'                => $user_id,
                                      'date_updated'            => 'NA',
                                      'status'                  => '1'
                                  );
                $exam_id    = $this->master_model->insertRecord('tblexamination',$insert_exam,TRUE);
                $insert_ads = array('examination_id'    => $exam_id,
                                    'login_id'          => $user_id,
                                     'hospital_id'      => $hospital_info[0]['id'],
                                     'budget_amount'    => 0,
                                     'number_of_click'  => 0,
                                     );
                $this->master_model->insertRecord('tbl_ads_users',$insert_ads);
                $exam_pay_arr = array('exam_id'          => $exam_id,
                                      'login_id'         => $user_id,
                                      'amount'           => 0,
                                      );
                $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);

                $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                   'exam'       => $exam_type,
                                   'msg'        => "add",
                                   'message'    => 'Examination added successfully with  payment.',
                                   'hospital'   => $hospital_info[0]['hospital']
                                   );
              
                $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                    'email'     => $user_email,
                                    'exam'      => $exam_type,
                                    'msg'       => "add",
                                    'message'   => '  added new examination',
                                    'hospital'   => $hospital_info[0]['hospital']
                                    );
           
                if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                {
                    $this->session->set_flashdata('success','Your exam added successfull.');
                }
                else 
                {
                    $this->session->set_flashdata('error','Failed to send mail');
                }
            }
            else
            {
                 $this->session->set_flashdata('error',$this->form_validation->error_string());
            }
        }
        

        redirect(base_url().'exam');
     
        
  }

    /* Function to edit exam*/
    public function edit()
    {
        $user_id = $this->session->userdata('user')->id;
        if($user_id == "")
        {
            redirect(base_url());
        }

        if(isset($_POST['update_exam']))
        {
            $this->form_validation->set_rules('exam_type', 'Exam Type', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('common_name', 'Search Keyword', 'trim|xss_clean');
            $this->form_validation->set_rules('official_waiting_days', 'Official waiting days', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('reported_waiting_days', 'Reported waiting days', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
            $this->form_validation->set_rules('exam_id', 'Exam id', 'trim|required|xss_clean');

            //validate form input
            if ($this->form_validation->run())
            {
                $exam_id = $this->input->post('exam_id');
                $data = array( 'price'      => $this->input->post('price'),
                                'exam_type' => $this->input->post('exam_type'),
                                'official_waiting_days' => $this->input->post('official_waiting_days'),
                                'price'     => $this->input->post('price')
                            );

                // insert form data into database
                if ($this->master_model->updateRecord('tblexamination',$data,array('id'=>$exam_id)))
                {
                    //$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Exam updated Successfully!!!</div>');
                    $this->session->set_flashdata('success','Exam updated Successfully');
                    redirect(base_url().'exam');
                }
                else
                {
                    // error
                    //$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    $this->session->set_flashdata('errror','Oops! Error.  Please try again later');
                    redirect(base_url().'exam');
                }
            }
            else
            {
               // $data['error'] = $this->form_validation->error_string();
                $this->session->set_flashdata('errror',$this->form_validation->error_string());

            }
        } 
        redirect(base_url().'exam');
       /* $data = array();
        $data['exam'] = $this->master_model->getRecords('tblexamination',array('id'=>$id));
        // echo"<pre>"; print_r($data['exam']); exit();
        $this->data['title']="Edit Exam";
        $data['scripts'] = array();
        $this->render('admin/exam-form-view',$data);   */
    }

    /*Function to remove exam*/
    function remove_exam()
    {
        $post = $this->input->post();
        if(!empty($post)){
            if($this->emod->remove_exam($post['id']))
            {
                $this->master_model->deleteRecord('tbl_ads_users','examination_id',$post['id']);
                echo "1";
            }
        }else{
            echo 0;
        }
    }

    /*Fucntion for Exam Reviews*/
    public function examReviews()
    {
        $user_id  = $this->session->userdata('user')->id;
        if($user_id == '')
        {
            redirect(base_url());
        }
        $exam_id  = $this->uri->segment(3);
        $struct_id  = $this->uri->segment(4);
        $data = array();

        $limit = 1;
        $this->db->select('tblexamination_review.*,tblstructure.hospital,tblexamination.exam_type,users.firstname');
        $this->db->join('users','users.id=tblexamination_review.user_id');
        $this->db->join('tblstructure','tblstructure.id=tblexamination_review.structure_id');
        $this->db->join('tblexamination','tblexamination.id=tblexamination_review.exam_id');
        $exam_info = $this->master_model->getRecords('tblexamination_review',array('tblexamination.id'=>$exam_id,'tblexamination.struct_id'=>$struct_id));
       // echo"<pre>"; print_r($exam_info); exit();
        $query = $this->db->last_query();
        $this->data['title']="Exam Review List";
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Prossimo';
        $config['prev_link'] = 'Prev';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active" ><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>'; 
        $config['per_page'] = 10;
        $config['base_url'] = base_url(). 'exam/examReviews/';
        $config['uri_segment'] = 5;
        //$config['use_page_numbers'] = TRUE;
        $config['total_rows'] =  count($exam_info); // Total results only.

        $this->pagination->initialize($config);
        $offset = $this->uri->segment(5)?$this->uri->segment(5):0;
        $query.=" LIMIT ".$offset.', '.$config["per_page"];
        $result = $this->db->query($query);
        $exam_info = $result->result_array(); 
        $links=$this->pagination->create_links();
        $data['pagination_links'] = $links;
        $data['reviews'] = $exam_info;
         //echo"<pre>"; print_r($data['reviews']); exit();
        if($this->input->is_ajax_request()){
            echo json_encode($data);
        }else{
            $data['menu'] = 'reviews';
            $data['scripts'] = array();
            $this->render('exam-reviews',$data);
        }    
    }

    /*Function to change common  name for exam*/
    public function update_exam_common_name()
    {
       $exam_id= $this->input->post('exam_id');
       $common_name= $this->input->post('common_name');
       echo  $this->emod->update_exam_common_name($common_name,$exam_id);
    }
    


public function paypal_sucess_add_exam()
    {

        if(isset($_REQUEST['res']) && $_REQUEST['res']=="success" && $_REQUEST['token']!="")
        {
            $getSess = $this->session->userdata('exam_pay_session');
            $trans_date = date('Y-m-d H:i:s');
            $currencyCodeType=currencyCode; //define in paypal_constant in third_party directory
            $paymentType=paymentType; //define in paypal_constant in third_party directory

            $nvpHeader          ="";
            $token              =urlencode($_REQUEST['token']);
            $nvpstr             ="&TOKEN=".$token;
            $nvpstr             = $nvpHeader.$nvpstr;
            $resArray           =$this->callerservice->hash_call("GetExpressCheckoutDetails",$nvpstr);
            
            $price                  = $getSess['price'];
            $exam_type              = $getSess['exam_type'];
            $budget                 = $getSess['budget'];
            $official_waiting_days  = $getSess['official_waiting_days'];
            $hospital               = $getSess['hospital'];
            $hospital_id            = $getSess['hospital_id'];


            $user_id = $this->session->userdata('user')->id;
            $user_email    = $this->session->userdata('user')->email;
            $user_fname    = $this->session->userdata('user')->firstname;
            $user_lname    = $this->session->userdata('user')->lastname;
            if($user_id == '')
                redirect(base_url());
            $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));

            $ack = strtoupper($resArray["ACK"]);
            if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING')
            {
              $trans_amount       =$resArray['AMT'];
              
              $number_of_clicks = 0;
              $clicks_price = 0;
              if($getUser[0]['clicks_price']>0)
              {
                   $number_of_clicks   = intval($amount/($getUser[0]['clicks_price'])); 
                   $clicks_price =  $getUser[0]['clicks_price'];
              }

                $nvpstr='&TOKEN='.$_REQUEST['token'].'&PAYERID='.$_REQUEST['PayerID'].'&PAYMENTACTION='.$paymentType.'&AMT='.$trans_amount.'&CURRENCYCODE='.$currencyCodeType;
                $resDoDirect=$this->callerservice->hash_call("DoExpressCheckoutPayment",$nvpstr);
                
                $trans_id = $resDoDirect['TRANSACTIONID'];
                
                $exp_date =  date('Y-m-d', strtotime('+1 month'));
                
                if($trans_id)
                {   
                    
                    $insert_exam = array('struct_id'             => $hospital_id,
                                         'exam_type'             => $exam_type,
                                         'official_waiting_days' => $official_waiting_days,
                                         'price'                 => $price,
                                         'lastupdated'           => date('Y-m-d H:i:s'),
                                         'owner_id'              => $user_id,
                                         'date_updated'          => 'NA',
                                         'status'=>'1'
                                         );
                    $exam_id = $this->master_model->insertRecord('tblexamination',$insert_exam,TRUE);
                    $insert_ads = array('examination_id'    => $exam_id,
                                        'login_id'          => $user_id,
                                         'hospital_id'      => $hospital_id,
                                         'budget_amount'    => $trans_amount,
                                         'number_of_click'  => $number_of_clicks,
                                         'clicks_price'     => $clicks_price,
                                         'exp_date'         => $exp_date,
                                         'payment_status'   => 'active',
                                         'payment_method'   => "non_recurring",
                                         'payment_type'     => 'credit'
                                        );
                    $this->master_model->insertRecord('tbl_ads_users',$insert_ads);
                    $exam_pay_arr = array('exam_id'          => $exam_id,
                                          'login_id'         => $user_id,
                                          'amount'           => $trans_amount,
                                          'payment_type'     => "paypal",
                                          'payment_method'   => "non_recurring",
                                          'transaction_date' => date('Y-m-d'),
                                          'transaction_id'   => $trans_id 
                                        );
                    $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);


                    $trans_data = array('login_id'         => $user_id,
                                        'transaction_id'   => $trans_id,
                                        'amount'           => $trans_amount,
                                        'type'             => 'credit card',
                                        'status'           => 'active',
                                        'transaction_date' => date('Y-m-d H:i:s')
                                        );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);

                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'exam'       => $exam_type,
                                       'pay_type'   => 'Paypal',
                                       'pay_method' => 'Manual',
                                       'exp_date'   => $exp_date,
                                       'amount'     => $trans_amount,
                                       'msg'        => "add",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Paypal',
                                        'pay_method'=> 'Manual',
                                        'amount'    => $trans_amount,
                                        'email'     => $user_email,
                                        'exam'      => $exam_type,
                                        'msg'       => "add",
                                        'message'   => " added new examination.",
                                        'hospital'  => $hospital_info[0]['hospital']
                                        );
               
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                    {
                        $this->session->set_flashdata('success','Your examination added successfull');
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error','Error white adding record ');
                    
                }
            }
            else
            {
                $this->session->set_flashdata('error', "Something went wrong. Please try after some time.");
                
            }
        }
        redirect(base_url().'exam');
            
    }


    public function paypal_cancel_add_exam()
    {
        
        $this->session->set_flashdata('error', "Sorry you cancel your payment request.");
        redirect(base_url().'exam');
    }


public function chk_rec_profile_add_exam()
{
        
        $recurring_start_date =  urlencode(date('Y-m-d')."T0:0:0");

        $user_id = $this->session->userdata('user')->id;
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        if($user_id == '')
            redirect(base_url());
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));

        $getSess = $this->session->userdata('exam_pay_session');
        $trans_amount       = $getSess['budget'];
        $trans_amount = number_format($trans_amount,2);
        $environment='sandbox';
        $this->paypal_recurring_express->environment = $environment;    // or 'beta-sandbox' or 'live'
        $this->paypal_recurring_express->paymentType = paymentType;             // or 'Sale' or 'Order' or 'Authorization'
        // Set request-specific fields.
        $this->paypal_recurring_express->startDate = $recurring_start_date;
        $this->paypal_recurring_express->billingPeriod = urlencode("Month");              // or "Day", "Week", "SemiMonth", "Year","Month"
        $this->paypal_recurring_express->billingFreq = urlencode("1");  
        $this->paypal_recurring_express->billingDes = "Test description";                   // combination of this and billingPeriod must be at most a year
        $this->paypal_recurring_express->paymentAmount = number_format(urlencode($trans_amount),2);
        $this->paypal_recurring_express->currencyID = urlencode(currencyCode);                          // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
    
        /* PAYPAL API  DETAILS */
        $this->paypal_recurring_express->API_UserName  = API_USERNAME;
        $this->paypal_recurring_express->API_Password  = API_PASSWORD;
        $this->paypal_recurring_express->API_Signature = API_SIGNATURE;
        $this->paypal_recurring_express->API_Endpoint  = API_ENDPOINT;


        /*SET SUCCESS AND FAIL URL*/
        $this->paypal_recurring_express->returnURL = urlencode(base_url()."exam/chk_rec_profile_add_exam/getExpressCheckout");
        $this->paypal_recurring_express->cancelURL = urlencode(base_url()."exam/paypal_cancel_add_exam");
        if($this->uri->segment(3)=="")
        {$n_task="setExpressCheckout";}
        else
        {   

            $_REQUEST['token'];
            if(isset($_REQUEST['token']))
            {
                $result=json_decode($this->paypal_recurring_express->getExpressCheckout());
                $resultAtatus=urldecode($result->ACK);

              
                if($resultAtatus=='Failure')
                {
                    redirect(base_url('exam'));
                }
                $profileId = urldecode($result->PROFILEID);
                $trans_id = urldecode($result->CORRELATIONID);
                
                $trans_date = date('Y-m-d H:i:s');

                    $budget                = $getSess['budget'];
                    $price                 = $getSess['price'];
                    $official_waiting_days = $getSess['official_waiting_days'];
                    $exam_type             = $getSess['exam_type'];
                    $hospital              = $getSess['hospital'];
                    $hospital_id           = $getSess['hospital_id'];
                    $official_waiting_days = $getSess['official_waiting_days'];
                   
                    $exam_insert_arr  = array('struct_id'               => $hospital_id,
                                              'owner_id'                => $user_id,
                                              'exam_type'               => $exam_type,
                                              'official_waiting_days'   => $official_waiting_days,
                                              'price'                   => $price,
                                              'date_updated'            => date('d/m/Y'),
                                            );
                    $total_clicks = 0;
                    $clicks_price = 0;
                    if($getUser[0]['clicks_price']>0)
                    {
                      $total_clicks   = intval($trans_amount/($getUser[0]['clicks_price']));
                      $clicks_price = $getUser[0]['clicks_price'];
                    }
                    $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                    $inser_arr = array('login_id'        => $user_id,
                                       'hospital_id'     => $hospital_id,
                                       'examination_id'  => $exam_id,
                                       'number_of_click' => $total_clicks,
                                       'click_price'     => $clicks_price,
                                       'budget_amount'   => $budget,
                                       'payment_status'  => "active",
                                       'profile_id'      => $profileId,
                                       'payment_method'  => 'recurring',
                                       'payment_type'    => 'paypal'
                                       );
                    $this->master_model->insertRecord('tbl_ads_users',$inser_arr);

                    $exam_pay_arr = array('exam_id'          => $exam_id,
                                          'login_id'         => $user_id,
                                          'amount'           => $trans_amount,
                                          'payment_type'     => "paypal",
                                          'payment_method'   => "recurring",
                                          'transaction_date' => date('Y-m-d'),
                                          'profile_id'       => $profileId,
                                          'transaction_id'   => $trans_id 
                                        );
                    $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);


                   
                    $trans_data = array('login_id'       => $user_id,
                                        'transaction_id' => $trans_id,
                                        'amount'         => $trans_amount,
                                        'type'           => 'paypal',
                                        'payment_method' => 'recurring',
                                        'transaction_date'=> date('Y-m-d H:i:s'),
                                        'status'          => 'active',
                                        'profile_id'      => $profileId 
                                        );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);
                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                  
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'pay_type'   => 'Paypal',
                                       'pay_method' => 'Automatic',
                                       'amount'     => $trans_amount,
                                       'exam'       => $exam_type,
                                       'msg'        => "add",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Paypal',
                                        'pay_method'   => 'Automatic',
                                        'amount'    => $trans_amount,
                                        'exam'       => $exam_type,
                                        'email'     => $user_email,
                                        'msg'       => "add",
                                        'message'    => " added new examination.",
                                        'hospital'   => $hospital
                                        );  
                                       
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                    {
                        $this->session->set_flashdata('success','Your examination added successfull with payment.');
                        redirect(base_url().'exam');    
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail !!!');
                        redirect(base_url().'exam');
                    }
                
            }
            else
            {
                $$this->session->set_flashdata("error","Error while payment.");
                redirect(base_url().'exam');
            }
            
            
        }
    
        $task=$n_task; //set initial task as Express Checkout
    
        switch($task)
        {
            case "setExpressCheckout":
            $this->paypal_recurring_express->setExpressCheckout();

            exit;
            case "getExpressCheckout":
            $this->paypal_recurring_express->getExpressCheckout();
            exit;
            case "error":
            echo "setExpress checkout failed";
            exit;
        }
            

} 

   // Credit card Recurring payment add exam

    public function create_rec_cardPay_add_exam()
    {   
         

        $user_id       = $this->session->userdata('user')->id;
        if($user_id =='')
            redirect(base_url());
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
        $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id));
        if(count($hospital_info)<=0)
        {
            $this->session->set_flashdata('error','No hospital available');
            redirect(base_url().'exam');
        }

        if($this->session->userdata('exam_pay_session')!='')
        {
            $recurring_start_date = date('Y-m-d')."T0:0:0";

            $getSess = $this->session->userdata('exam_pay_session');
           /* print_r($getSess);
            exit();*/
            
            $cardTypes    = $getSess['card_type'];
            $creditCard   = $getSess['card_number'];
            $cc_exp       = $getSess['cc_exp'];

            $cc_exp_arr   = explode('/', $cc_exp);
            $expDateMonth = trim($cc_exp_arr[0]);
            $expDateYear  = trim($cc_exp_arr[1]);
            $expDate    = intval($expDateMonth.$expDateYear);
            $cvv2Number = intval($getSess['cvv']);
            $start      = $recurring_start_date;
            $desc       = 'Medscanner Advertise';
            $period     = urlencode("Month");
            $freq       = urlencode("1");
            $amt = $getSess['amount'];
            $currency=currencyCode;
            
            $street='';
            $city='';
            $state='';
            $code='';
            $zip='';
            $email=$user_email;
            //exit();
            
        }
        $dollarValue=(float)number_format($amt,2);
        //require_once('credentials.php');
        // Include and instantiate the API
        require_once('PayPal.class.php');
        $username  = API_USERNAME;
        $password  = API_PASSWORD;
        $signature = API_SIGNATURE;
        
        $paypal = new PayPal('SANDBOX', $username, $password, $signature);
        $paypal->setCardDetails($cardTypes, $creditCard, $expDate, $cvv2Number);
        $paypal->setCurrencyCode($currency);
        $paypal->setPayerDetails($email, $street, $city, $state, $code, $zip);
        $paypal->setProfileDetails($start, $desc, $period, $freq, number_format($dollarValue,2), $initAmt = 0.00);
       
        $profile = $paypal->createRecurringPaymentsProfile();
        if($profile['ACK']=="Success" && $profile['PROFILEID']!='')
        {
                $profileId = urldecode($profile['PROFILEID']);

                $trans_id = urldecode($profile['CORRELATIONID']);
                
                $trans_date = date('Y-m-d H:i:s');

                $exam_type             = $getSess['exam_type'];
                $exam_price            = $getSess['price'];
                $official_waiting_days = $getSess['official_waiting_days'];
                
             
                $exam_insert_arr  = array('struct_id'               => $hospital_info[0]['id'],
                                          'owner_id'                => $user_id,
                                          'exam_type'               => $exam_type,
                                          'official_waiting_days'   => $official_waiting_days,
                                          'price'                   => $exam_price,
                                          'date_updated'            => date('d/m/Y'),
                                        );

                $total_clicks = 0;
                $clicks_price = 0;
                $budget_amount = $amt;
                if($getUser[0]['clicks_price']>0)
                {
                    $total_clicks  = $budget_amount / $getUser[0]['clicks_price'];
                    $clicks_price = $getUser[0]['clicks_price'];
                }

                $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                $inser_arr = array('login_id'        => $user_id,
                                   'hospital_id'     => $hospital_info[0]['id'],
                                   'examination_id'  => $exam_id,
                                   'number_of_click' => intval($total_clicks),
                                   'budget_amount'   => $budget_amount,
                                   'click_price'     => $clicks_price, 
                                   'payment_status'  => "active",
                                   'profile_id'      => $profileId,
                                   'payment_method'  => 'recurring',
                                   'payment_type'    => 'credit'
                                   );
                $this->master_model->insertRecord('tbl_ads_users',$inser_arr);

                $exam_pay_arr = array('exam_id'          => $exam_id,
                                      'login_id'         => $user_id,
                                      'amount'           => $budget_amount,
                                      'payment_type'     => "credit",
                                      'payment_method'   => "recurring",
                                      'transaction_date' => date('Y-m-d'),
                                      'profile_id'       => $profileId,
                                      'transaction_id'   => $trans_id 
                                    );
                $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
               
                  $trans_data = array('login_id'       => $user_id,
                                      'transaction_id' => $trans_id,
                                      'amount'         => $amt,
                                      'type'           => 'credit card',
                                      'payment_method' => 'recurring',
                                      'transaction_date'=> date('Y-m-d H:i:s'),
                                      'status'          => 'active',
                                      'profile_id'      => $profileId 
                                      );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);
                    
                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'pay_type'   => 'Credit card',
                                       'pay_method' => 'Automatic',
                                       'amount'     => $amt,
                                       'exam'       => $exam_type,
                                       'msg'        => "add",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Credit card',
                                        'pay_method'   => 'Automatic',
                                        'amount'    => $amt,
                                        'exam'      => $exam_type,
                                        'email'     => $user_email,
                                        'msg'       => "add",
                                        'message'    => " added new examination",
                                        'hospital'   => $hospital_info[0]['hospital']
                                        );  
                                       
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                    {
                        $this->session->set_flashdata('success','Your exam added successfully with payment');
                        redirect(base_url().'exam');    
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail !!!');
                        redirect(base_url().'exam');
                    }
       
        }
        if($profile['ACK']!="Success")
        {
            $this->session->set_flashdata("error",'Invalid card information provided.');
            redirect(base_url().'exam');    
        }
    }



  /*Function To add exams by csv file */
    public function add_exam_csv()
    {
        $user_id       = $this->session->userdata('user')->id;
        if($user_id =='')
            redirect(base_url());
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
        $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id,'status'=>1));
        if(count($hospital_info)<=0)
        {
            $this->session->set_flashdata('error','No hospital available');
            redirect(base_url().'exam');
        }

        if($user_id == "")
        {
            redirect(base_url());
        }
        if(isset($_POST['btn_pay_exam_csv']))
        { 
            $arr_exam_type = array();
            $arr_wait_day  = array();
            $arr_price     = array();
            $exam_file = '';

            if(isset($_FILES['file_name']) && $_FILES['file_name']['error']==0)
            {

                $config['upload_path']   = 'uploads/exam_files';
                $config['allowed_types'] = '*';
                $config['file_name']=time().basename($_FILES['file_name']['name']);
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('file_name'))
                {
                    $upload_data = $this->upload->data();
                    $file_name =$upload_data['file_name'];
                    $image_url = base_url().'uploads/exam_files/'.$file_name;
                    $i = 1;
                    $exam_file = 'uploads/exam_files/'.$file_name;
                    $file = fopen($exam_file, "r");
                   
                    while (($examData = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                      
                        if($i==1)
                        {
                            if(strtolower($examData[0]) != 'exam type' ||  strtolower($examData[1]) != 'official waiting days' ||  strtolower($examData[2]) != 'price')
                            {
                                $this->session->set_flashdata('error',"Your file column name sequence must be as exam type, official waiting days and price");
                                redirect(base_url().'exam');
                            }
                            $i++;
                            continue;

                        }
                        $i++;
                        if(!is_numeric($examData[2]))
                        {
                            $this->session->set_flashdata('error',"Your file price column contain invalid value.");
                            redirect(base_url().'exam');
                        }
                        if(!is_numeric($examData[1]))
                        {
                            $this->session->set_flashdata('error',"Your file official waiting days column contain invalid value.");
                            redirect(base_url().'exam');
                        }
                        array_push($arr_exam_type,$examData[0]);
                        array_push($arr_wait_day,$examData[1]);
                        array_push($arr_price,$examData[2]);
                    }

                }
                else
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url().'exam');
                }
            }
            if(count($arr_exam_type) <= 0 || count($arr_wait_day) <= 0 || count($arr_price) <= 0)
            {
                $this->session->set_flashdata('error','Examinations all fields are required');
                redirect(base_url().'exam');
            }
                      

            for($i=0;$i<count($arr_exam_type);$i++)
            {
                
                
                $exam_insert_arr  = array('struct_id'               => $hospital_info[0]['id'],
                                          'owner_id'                => $user_id,
                                          'exam_type'               => $arr_exam_type[$i],
                                          'official_waiting_days'   => $arr_wait_day[$i],
                                          'price'                   => $arr_price[$i],
                                          'date_updated'            => date('Y-m-d'),
                                        );
                $total_clicks = 0;
                $clicks_price = 0;
                $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                $inser_arr = array('login_id'        => $user_id,
                                   'hospital_id'     => $hospital_info[0]['id'],
                                   'examination_id'  => $exam_id,
                                   'number_of_click' => 0,
                                   'budget_amount'   => 0
                                    );
                $this->master_model->insertRecord('tbl_ads_users',$inser_arr);

                $exam_pay_arr = array('exam_id'          => $exam_id,
                                      'login_id'         => $user_id,
                                      'amount'           => 0
                                     );
                $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
            }
           
       
            $admin_email = $this->master_model->getRecords('users',array('id'=>12));
            $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
            $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
            $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                               'msg'        => "add_csv",
                               'message'    => "Examination added successfully with  payment.",
                               'hospital'   => $hospital_info[0]['hospital']
                               );
          
            $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
            $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                'email'     => $user_email,
                                'msg'       => "add_csv",
                                'message'    => " added new examination by file.",
                                'hospital'   => $hospital_info[0]['hospital']
                                );   
            
            if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail_attach($info_arr1,$other_arr1,$exam_file))
            {
                $this->session->set_flashdata('success','Your exam added successfully with payment');
                redirect(base_url().'exam');    
            }
            else 
            {
                $this->session->set_flashdata('error','Failed to send mail !!!');
                redirect(base_url().'exam');
            }
             
        }
    }

// Plane paypal payment by csv uplaod

    public function paypal_sucess_csv()
    {

        $user_id       = $this->session->userdata('user')->id;
        if($user_id =='')
            redirect(base_url());
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
        $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id));
        if(count($hospital_info)<=0)
        {
            $this->session->set_flashdata('error','No hospital available');
            redirect(base_url().'exam');
        }

        if(isset($_REQUEST['res']) && $_REQUEST['res']=="success" && $_REQUEST['token']!="")
        {
            $getSess = $this->session->userdata('register_session');
            $trans_date = date('Y-m-d H:i:s');
            $currencyCodeType=currencyCode; //define in paypal_constant in third_party directory
            $paymentType=paymentType; //define in paypal_constant in third_party directory

            $nvpHeader          ="";
            $token              =urlencode($_REQUEST['token']);
            $nvpstr             ="&TOKEN=".$token;
            $nvpstr             = $nvpHeader.$nvpstr;
            $resArray           =$this->callerservice->hash_call("GetExpressCheckoutDetails",$nvpstr);
            
            
            $ack = strtoupper($resArray["ACK"]);
            if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING')
            {
                $trans_amount=$resArray['AMT'];
                $nvpstr='&TOKEN='.$_REQUEST['token'].'&PAYERID='.$_REQUEST['PayerID'].'&PAYMENTACTION='.$paymentType.'&AMT='.$trans_amount.'&CURRENCYCODE='.$currencyCodeType;
                $resDoDirect=$this->callerservice->hash_call("DoExpressCheckoutPayment",$nvpstr);
                
                $trans_id = $resDoDirect['TRANSACTIONID'];
                 
                    $exam_type       = $getSess['arr_exam_type'];
                    $exam_price      = $getSess['arr_price'];
                    $official_waiting_days = $getSess['arr_wait_day'];
                    $amount          = $getSess['amount'];
                   
                    for($i=0;$i<count($exam_type);$i++)
                    {
                       
                        $exam_insert_arr  = array('struct_id'               => $hospital_info[0]['id'],
                                                  'owner_id'                => $user_id,
                                                  'exam_type'               => $exam_type[$i],
                                                  'official_waiting_days'   => $official_waiting_days[$i],
                                                  'price'                   => $exam_price[$i],
                                                  'date_updated'            => date('d/m/Y')
                                                );

                        $total_clicks = 0;
                        $clicks_price = 0;
                        $budget_amount = $amount/count($exam_type);
                        if($getUser[0]['clicks_price']>0)
                        {
                            $total_clicks  = $budget_amount / $getUser[0]['clicks_price'];
                             $clicks_price = $getUser[0]['clicks_price'];
                        }

                        $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                        $getClickPrice = $this->master_model->getRecords('tbl_click_price');

                        
                        $inser_arr = array('login_id'        => $user_id,
                                           'hospital_id'     => $hospital_info[0]['id'],
                                           'examination_id'  => $exam_id,
                                           'number_of_click' => intval($total_clicks),
                                           'budget_amount'   => $budget_amount,
                                           'click_price'     => $clicks_price,
                                           'payment_status'  => "active",
                                           'exp_date'        => date('Y-m-d', strtotime('+1 month')),
                                           'payment_type'    => 'paypal',
                                           'payment_method'  => "non_recurring"
                                           );
                        $this->master_model->insertRecord('tbl_ads_users',$inser_arr);
                        $exam_pay_arr = array('exam_id'          => $exam_id,
                                              'login_id'         => $user_id,
                                              'amount'           => $budget_amount,
                                              'payment_type'     => "paypal",
                                              'payment_method'   => "non_recurring",
                                              'transaction_date' => date('Y-m-d'),
                                              'transaction_id'   => $trans_id 
                                            );
                        $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
                    }
                    
                    $trans_data = array('login_id'       => $user_id,
                                        'transaction_id' => $trans_id,
                                        'amount'         => $trans_amount,
                                        'type'           => 'paypal',
                                        'payment_method' => 'non_recurring',
                                        'status'          => 'active',
                                        'transaction_date'=> date('Y-m-d H:i:s')
                                        );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);
                    
               
                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'pay_type'   => 'Paypal',
                                       'pay_method' => 'manual',
                                       'exp_date'   => $exp_date,
                                       'amount'     => $trans_amount,
                                       'msg'        => "add_csv",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Paypal',
                                        'pay_method'   => 'manual',
                                        'amount'    => $trans_amount,
                                        'email'     => $user_email,
                                        'msg'       => "add_csv",
                                        'message'    => " added new examination by file.",
                                        'hospital'   => $hospital_info[0]['hospital']
                                        );  
                                        $exam_file = '';
                                        $exam_file = $getSess['file_csv']; 
                    
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail_attach($info_arr1,$other_arr1,$exam_file))
                    {
                        $this->session->set_flashdata('success','Your exam added successfully with payment');
                        redirect(base_url().'exam');    
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail !!!');
                        redirect(base_url().'exam');
                    }
                          
            }
            else
            {
                $this->session->set_flashdata('error', "Something went wrong. Please try after some time.");
                redirect(base_url().'exam');
            }
        }
            
    }

// Paypal recurring payment by csv upload

public function chk_rec_profile_csv()
{
        $user_id       = $this->session->userdata('user')->id;
        if($user_id =='')
            redirect(base_url());
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
        $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id));
        if(count($hospital_info)<=0)
        {
            $this->session->set_flashdata('error','No hospital available');
            redirect(base_url().'exam');
        }

        $recurring_start_date =  urlencode(date('Y-m-d')."T0:0:0");
        $getSess = $this->session->userdata('register_session');

        $exam_type       = $getSess['arr_exam_type'];
        $exam_price      = $getSess['arr_price'];
        $official_waiting_days = $getSess['arr_wait_day'];
        $trans_amount          = $getSess['amount'];
        //$trans_amount          = $getSess['amount'];
        
        $environment='sandbox';
        $this->paypal_recurring_express->environment = $environment;    // or 'beta-sandbox' or 'live'
        $this->paypal_recurring_express->paymentType = paymentType;             // or 'Sale' or 'Order' or 'Authorization'
        // Set request-specific fields.
        $this->paypal_recurring_express->startDate = $recurring_start_date;
        $this->paypal_recurring_express->billingPeriod = urlencode("Day");              // or "Day", "Week", "SemiMonth", "Year","Month"
        $this->paypal_recurring_express->billingFreq = urlencode("1");  
        $this->paypal_recurring_express->billingDes = "Test description";                   // combination of this and billingPeriod must be at most a year
        $this->paypal_recurring_express->paymentAmount = number_format(urlencode($trans_amount),2);
        $this->paypal_recurring_express->currencyID = urlencode(currencyCode);                          // or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
    
        /* PAYPAL API  DETAILS */
        $this->paypal_recurring_express->API_UserName  = API_USERNAME;
        $this->paypal_recurring_express->API_Password  = API_PASSWORD;
        $this->paypal_recurring_express->API_Signature = API_SIGNATURE;
        $this->paypal_recurring_express->API_Endpoint = API_ENDPOINT;


        /*SET SUCCESS AND FAIL URL*/
        $this->paypal_recurring_express->returnURL = urlencode(base_url()."exam/chk_rec_profile_csv/getExpressCheckout");
        $this->paypal_recurring_express->cancelURL = urlencode(base_url()."exam/paypal_cancel_add_exam");
        if($this->uri->segment(3)=="")
        {$n_task="setExpressCheckout";}
        else
        {   
            $_REQUEST['token'];
            if(isset($_REQUEST['token']))
            {
                $result=json_decode($this->paypal_recurring_express->getExpressCheckout());
                $resultAtatus=urldecode($result->ACK);

                if($resultAtatus=='Failure')
                {
                    redirect(base_url('exam'));
                }
                $profileId = urldecode($result->PROFILEID);
                $trans_id = urldecode($result->CORRELATIONID);
                
                $trans_date = date('Y-m-d H:i:s');
               
                
                
                    $exam_type       = $getSess['arr_exam_type'];
                    $exam_price      = $getSess['arr_price'];
                    $official_waiting_days = $getSess['arr_wait_day'];
                    $exam_budget     = $getSess['amount'];
                    
                    for($i=0;$i<count($exam_type);$i++)
                    {
                        $exam_insert_arr  = array('struct_id'               => $hospital_info[0]['id'],
                                                  'owner_id'                => $user_id,
                                                  'exam_type'               => $exam_type[$i],
                                                  'official_waiting_days'   => $official_waiting_days[$i],
                                                  'price'                   => $exam_price[$i],
                                                  'date_updated'            => date('d/m/Y'),
                                                );
                        $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                       
                        $total_clicks = 0;
                        $clicks_price = 0;
                        $budget_amount = $trans_amount/count($exam_type);
                        if($getUser[0]['clicks_price']>0)
                        {
                            $total_clicks  = $budget_amount / $getUser[0]['clicks_price'];
                            $clicks_price = $getUser[0]['clicks_price'];
                        }
                        
                        $inser_arr = array('login_id'        => $user_id,
                                           'hospital_id'     => $hospital_info[0]['id'],
                                           'examination_id'  => $exam_id,
                                           'number_of_click' => intval($total_clicks),
                                           'budget_amount'   => $budget_amount,
                                           'click_price'     => $clicks_price,
                                           'payment_status'  => "active",
                                           'profile_id'      => $profileId,
                                           'payment_method'  => 'recurring',
                                           'payment_type'    => 'paypal'
                                           );
                        $this->master_model->insertRecord('tbl_ads_users',$inser_arr);
                        $exam_pay_arr = array('exam_id'          => $exam_id,
                                              'login_id'         => $user_id,
                                              'amount'           => $budget_amount,
                                              'payment_type'     => "paypal",
                                              'payment_method'   => "recurring",
                                              'transaction_date' => date('Y-m-d'),
                                              'profile_id'       => $profileId,
                                              'transaction_id'   => $trans_id 
                                            );
                        $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
                    }
                    $trans_data = array('login_id'       => $user_id,
                                        'transaction_id' => $trans_id,
                                        'amount'         => $trans_amount,
                                        'type'           => 'paypal',
                                        'payment_method' => 'recurring',
                                        'status'         => 'active',
                                        'transaction_date'=> date('Y-m-d H:i:s'),
                                        'profile_id'      => $profileId 
                                        );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);
                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'pay_type'   => 'Paypal',
                                       'pay_method' => 'Automatic',
                                       'amount'     => $trans_amount,
                                       'msg'        => "add_csv",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Paypal',
                                        'pay_method'   => 'Automatic',
                                        'amount'    => $trans_amount,
                                        'email'     => $user_email,
                                        'msg'       => "add_csv",
                                        'message'    => " added new examination by file.",
                                        'hospital'   => $hospital_info[0]['hospital']
                                        );  
                                        $exam_file = '';
                                        $exam_file = $getSess['file_csv']; 
                    
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail_attach($info_arr1,$other_arr1,$exam_file))
                    {
                        $this->session->set_flashdata('success','Your exam added successfully with payment');
                        redirect(base_url().'exam');    
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail !!!');
                        redirect(base_url().'exam');
                    }
                    
            }
            else
            {
                $$this->session->set_flashdata("error","Error while payment.");
                redirect(base_url().'exam');
            }
            
            
        }
    
        $task=$n_task; //set initial task as Express Checkout
    
        switch($task)
        {
            case "setExpressCheckout":
            $this->paypal_recurring_express->setExpressCheckout();

            exit;
            case "getExpressCheckout":
            $this->paypal_recurring_express->getExpressCheckout();
            exit;
            case "error":
            echo "setExpress checkout failed";
            exit;
        }
 
} 

// Credit card Recurring payment by csv upload

    public function create_rec_cardPay_csv()
    {   
         

        $user_id       = $this->session->userdata('user')->id;
        if($user_id =='')
            redirect(base_url());
        $user_email    = $this->session->userdata('user')->email;
        $user_fname    = $this->session->userdata('user')->firstname;
        $user_lname    = $this->session->userdata('user')->lastname;
        $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
        $hospital_info = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id));
        if(count($hospital_info)<=0)
        {
            $this->session->set_flashdata('error','No hospital available');
            redirect(base_url().'exam');
        }


        if($this->session->userdata('register_session')!='')
        {
            $recurring_start_date = date('Y-m-d')."T0:0:0";

            $getSess = $this->session->userdata('register_session');
            
            //$profile=$card_details['ccName'];
            $cardTypes    = $getSess['card_type'];
            $creditCard   = $getSess['card_number'];
            $cc_exp       = $getSess['cc_exp'];

            $cc_exp_arr   = explode('/', $cc_exp);
            $expDateMonth = trim($cc_exp_arr[0]);
            $expDateYear  = trim($cc_exp_arr[1]);
            $expDate    = intval($expDateMonth.$expDateYear);
            $cvv2Number = intval($getSess['cvv']);
            $start      = $recurring_start_date;
            $desc       = 'Medscanner Advertise';
            $period     = urlencode("Month");
            $freq       = urlencode("1");
            $amt = $getSess['amount'];
            $currency=currencyCode;
            
            $street='';
            $city='';
            $state='';
            $code='';
            $zip='';
            $email=$user_email;
            //exit();
            
        }
        $dollarValue=(float)number_format($amt,2);
        //require_once('credentials.php');
        // Include and instantiate the API
        require_once('PayPal.class.php');
        $username  = API_USERNAME;
        $password  = API_PASSWORD;
        $signature = API_SIGNATURE;
        
        $paypal = new PayPal('SANDBOX', $username, $password, $signature);
        $paypal->setCardDetails($cardTypes, $creditCard, $expDate, $cvv2Number);
        $paypal->setCurrencyCode($currency);
        $paypal->setPayerDetails($email, $street, $city, $state, $code, $zip);
        $paypal->setProfileDetails($start, $desc, $period, $freq, number_format($dollarValue,2), $initAmt = 0.00);
       
        $profile = $paypal->createRecurringPaymentsProfile();
        if($profile['ACK']=="Success" && $profile['PROFILEID']!='')
        {
                $profileId = urldecode($profile['PROFILEID']);

                $trans_id = urldecode($profile['CORRELATIONID']);
                
                $trans_date = date('Y-m-d H:i:s');
                    $exam_type       = $getSess['arr_exam_type'];
                    $exam_price      = $getSess['arr_price'];
                    $official_waiting_days = $getSess['arr_wait_day'];
                    
                    for($i=0;$i<count($exam_type);$i++)
                    {
                       
                        $exam_insert_arr  = array('struct_id'               => $hospital_info[0]['id'],
                                                  'owner_id'                => $user_id,
                                                  'exam_type'               => $exam_type[$i],
                                                  'official_waiting_days'   => $official_waiting_days[$i],
                                                  'price'                   => $exam_price[$i],
                                                  'date_updated'            => date('d/m/Y'),
                                                );

                        $total_clicks = 0;
                        $clicks_price = 0;
                        $budget_amount = $amt/count($exam_type);
                        if($getUser[0]['clicks_price']>0)
                        {
                            $total_clicks  = $budget_amount / $getUser[0]['clicks_price'];
                             $clicks_price = $getUser[0]['clicks_price'];
                        }

                        $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                        $inser_arr = array('login_id'        => $user_id,
                                           'hospital_id'     => $hospital_info[0]['id'],
                                           'examination_id'  => $exam_id,
                                           'number_of_click' => intval($total_clicks),
                                           'budget_amount'   => $budget_amount,
                                           'click_price'     => $clicks_price, 
                                           'payment_status'  => "active",
                                           'profile_id'      => $profileId,
                                           'payment_method'  => 'recurring',
                                           'payment_type'    => 'credit'
                                           );
                        $this->master_model->insertRecord('tbl_ads_users',$inser_arr);
                        $exam_pay_arr = array('exam_id'          => $exam_id,
                                              'login_id'         => $user_id,
                                              'amount'           => $budget_amount,
                                              'payment_type'     => "credit",
                                              'payment_method'   => "recurring",
                                              'transaction_date' => date('Y-m-d'),
                                              'profile_id'       => $profileId,
                                              'transaction_id'   => $trans_id 
                                            );
                        $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
                    }
                    
                    $trans_data = array('login_id'       => $user_id,
                                        'transaction_id' => $trans_id,
                                        'amount'         => $amt,
                                        'type'           => 'credit card',
                                        'payment_method' => 'recurring',
                                        'transaction_date'=> date('Y-m-d H:i:s'),
                                        'status'          =>'active',
                                        'profile_id'      => $profileId 
                                        );
                    $this->master_model->insertRecord('tble_transaction',$trans_data);
                    
                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user_email,'subject'=>'Examination added successfull','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user_fname." ".$user_lname,
                                       'pay_type'   => 'Credit card',
                                       'pay_method' => 'Automatic',
                                       'amount'     => $amt,
                                       'msg'        => "add_csv",
                                       'message'    => "Examination added successfully with  payment.",
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    $info_arr1 = array('from'=> $info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User added examination','view'=>'admin_user_exam_budget');
                    $other_arr1 = array('user_name' => $user_fname." ".$user_lname,
                                        'pay_type'  => 'Credit card',
                                        'pay_method'   => 'Automatic',
                                        'amount'    => $amt,
                                        'email'     => $user_email,
                                        'msg'       => "add_csv",
                                        'message'    => " added new examination by file.",
                                        'hospital'   => $hospital_info[0]['hospital']
                                        );  
                                        $exam_file = '';
                                        $exam_file = $getSess['file_csv']; 
                    
                    if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail_attach($info_arr1,$other_arr1,$exam_file))
                    {
                        $this->session->set_flashdata('success','Your exam added successfully with payment');
                        redirect(base_url().'exam');    
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail !!!');
                        redirect(base_url().'exam');
                    }
       
        }
        if($profile['ACK']!="Success")
        {
            $this->session->set_flashdata("error",'Invalid card information provided.');
            redirect(base_url().'exam');    
        }
    }




}
?>