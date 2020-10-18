<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

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
        $this->load->model('exam_model','emod');
		$this->load->model('users_model','umod');
        $this->load->model('master_model');
		$this->load->library('pagination');
        $this->load->model('email_sending');
        is_admin_login();
        $this->load->library(array( 'form_validation'));
	}

	public function index()
	{
		
		$this->users();
		
	}
	public function structures(){
		$data = array();

		$limit = 15;
		$offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);
		$this->data['title']="Hospital list";
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
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
		$config['per_page'] = $limit;
		$config['base_url'] = base_url(). 'admin/structures/';
		$config['uri_segment'] = 3;	
		$config['num_links'] = 9;
		$config['use_page_numbers'] = TRUE;		
		$config['total_rows'] =  $this->smod->get_hospitals($limit, $offset,'total_results'); // Total results only.
		
		$this->pagination->initialize($config);
		$data['structures'] = $this->smod->get_hospitals($limit, $offset);
		
		$data['pagination_links'] = $this->pagination->create_links();
		if($this->input->is_ajax_request()){
			echo json_encode($data);
		}else{
            $data['menu'] = 'structures';
			$data['scripts'] = array('admin.js');
			$this->render('admin/structures-view',$data);
		}
	}

    /*Function To Add Hospital*/
    public function add_structures()
    {
        $this->load->library(array( 'form_validation'));
        //echo '<pre>';print_r($_POST);
        if(isset($_POST['add_hospital']))
        {
            
            $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('province', 'Province', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address_formatted', 'Address Formatted', 'trim|required|xss_clean');
            $this->form_validation->set_rules('website', 'website', 'trim|prep_url');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            if($this->form_validation->run())
            {
                if(isset($_FILES['fileupload']) && $_FILES['fileupload']['error']==0)
                {
                    $config['upload_path']   = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|jpeg|gif';
                    $config['file_name']=time().basename($_FILES['fileupload']['name']);
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('fileupload'))
                    {
                        $upload_data = $this->upload->data();
                        $fileupload=$upload_data['file_name'];
                        $image_url = base_url().'uploads/'.$fileupload;
                    }
                    else
                    {
                        $data['error'] =    $this->upload->display_errors();
                    }
                }
                $insert_array  = array(
                    'hospital' => $this->input->post('hospital'),
                    'search_keyword' => $this->input->post('search_keyword'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'province' => $this->input->post('province'),
                    'address_formatted' => $this->input->post('address_formatted'),
                    'telephone' => $this->input->post('telephone'),
                    'structure_parent_id' => $this->input->post('structure_parent_id'),
                    'fax' => $this->input->post('fax'),
                    'website' => $this->input->post('website'),
                    'email'=>$this->input->post('email'),
                    'image_url'=>$image_url
                );
                /*Insert Record in database*/
                if($this->master_model->insertRecord('tblstructure',$insert_array))
                {
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Hospital is Successfully added !!!</div>');
                    redirect(base_url().'admin/add_structures');
                }
                else 
                {
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later !!!</div>');
                    redirect(base_url().'admin/add_structures');
                }
            }
        }
        $this->data['title']="Add Hospital";
        $data['scripts'] = array();
        $this->render('admin/hospital-add',$data);
    }
    public function edit_structures($id)
    {

        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
       
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
        $this->form_validation->set_rules('province', 'Province', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_formatted', 'Address Formatted', 'trim|required|xss_clean');
        $this->form_validation->set_rules('website', 'website', 'trim|prep_url');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean');
	    $this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean');

        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['hospital'] = $this->smod->get_hospital($id);

            $this->data['title']="Edit Hospital";
            $data['scripts'] = array();
            $this->render('admin/structure-form-view',$data);

        }
        else
        {
           // echo '<pre>';print_r($_POST);
             $data = array(
                'hospital' => $this->input->post('hospital'),
                'search_keyword' => $this->input->post('search_keyword'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'province' => $this->input->post('province'),
                'address_formatted' => $this->input->post('address_formatted'),
                'telephone' => $this->input->post('telephone'),
                'structure_parent_id' => $this->input->post('structure_parent_id'),
                'fax' => $this->input->post('fax'),
                'website' => $this->input->post('website'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude')
            );
             if(isset($_FILES['fileupload']) && $_FILES['fileupload']['error']==0)
                {
                    $config['upload_path']   = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|jpeg|gif';
                    $config['file_name']=time().basename($_FILES['fileupload']['name']);
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('fileupload'))
                    {
                        $upload_data = $this->upload->data();
                        $fileupload=$upload_data['file_name'];
                        $image_url=base_url().'uploads/'.$fileupload;
                        $data['image_url']=$image_url;
                    }
                    else
                    {
                        $data['error'] =    $this->upload->display_errors();
                    }
                }

            /*if($_FILES['fileupload']['size']>0){
                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
                $filename =time().basename($_FILES['fileupload']['name']);
                $uploadfile = $uploaddir.$filename ;

                if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $uploadfile)) {
                  $image_url=base_url().'uploads/'.$filename;
                  $data['image_url']=$image_url;
                } 
            }*/
       
            // insert form data into database
            if ($this->smod->update_hospital($data,$id))
            {
			
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Hospital are Successfully update!!!</div>');
                redirect(base_url().'admin/edit_structures/'.$id);
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect(base_url().'admin/edit_structures/'.$id);
            }
        }
    }
    function remove_structure(){
        $post = $this->input->post();
        if(!empty($post)){
            echo $this->smod->remove_hospital($post['id']);
        }else{
            echo 0;
        }
    }
    function remove_exam(){
        $post = $this->input->post();
        if(!empty($post)){
            echo $this->emod->remove_exam($post['id']);
        }else{
            echo 0;
        }
    }
	
    public function exams(){
        $data = array();
        $data['users'] = $this->master_model->getRecords('users',array('role'=>2,'status'=>1));

        $hospital_id = $this->input->get('structure') ? $this->input->get('structure') :0;
        $limit = 15;
        $offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);
        $this->data['title']="Exam list";
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
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
        $config['per_page'] = $limit;
        $config['base_url'] = base_url(). 'admin/exams/';
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] =  $this->emod->get_exams($hospital_id,$limit, $offset,'total_results'); // Total results only.

        $this->pagination->initialize($config);
        $data['exams'] = $this->emod->get_exams($hospital_id,$limit, $offset);
        $data['pagination_links'] = $this->pagination->create_links();
        if($this->input->is_ajax_request()){
            echo json_encode($data);
        }else{
            $data['menu'] = 'exam';
            $data['common_names'] =  $this->emod->get_exam_common_name();
            $data['scripts'] = array('admin.js');
            $this->render('admin/exam-view',$data);
        }
    }
	
    public function add_public_exam(){
		$data = array();
		$this->load->library(array( 'form_validation'));
		
		
		if(isset($_POST['btn_add_exam']))
		{
		
			$this->load->library(array( 'form_validation'));
			$this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
			$this->form_validation->set_rules('exam_type', 'Exam Type', 'trim|required|xss_clean');
		   //$this->form_validation->set_rules('common_name', 'Search Keyword', 'trim|xss_clean');
			$this->form_validation->set_rules('official_waiting_days', 'Official waiting days', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('reported_waiting_days', 'Reported waiting days', 'trim|required|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('user', 'Advertiser', 'trim|required|xss_clean');
			if($this->form_validation->run())
			{
				$hospital     = $this->input->post('hospital');
				$exam_type    = $this->input->post('exam_type');
				$common_name  = $this->input->post('common_name');
				$price        = $this->input->post('price');
				//$user_id      = $this->input->post('user');
				$user_id = 0;
				$official_waiting_days = $this->input->post('official_waiting_days');
				$reported_waiting_days = $this->input->post('reported_waiting_days');
		
				$insert_arr = array('struct_id'             => $hospital,
									'exam_type'             => $exam_type,
									'owner_id'              => $user_id,
									'common_name'           => $common_name,
									'official_waiting_days' => $official_waiting_days,
									'reported_waiting_days' => $reported_waiting_days,
									'price'                 => $price,
									'lastupdated'           => date('Y-m-d H:i:s'),
									'date_updated'          => date('Y-m-d'),
									'status'=>'1'
									);
					$exam_id = $this->master_model->insertRecord('tblexamination',$insert_arr,TRUE);
			
					/*$insert_ads = array('examination_id'    => $exam_id,
										'login_id'          => $user_id,
										'hospital_id'       => $hospital,
										'budget_amount'     => 0,
										'number_of_click'   => 0,
										);
					$this->master_model->insertRecord('tbl_ads_users',$insert_ads);
					$exam_pay_arr = array('exam_id'          => $exam_id,
										  'login_id'         => $user_id,
										  'amount'           => 0,
										  );
					$this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
					$user     = $this->master_model->getRecords('users',array('id'=>$user_id));
					$hospital_info = $this->master_model->getRecords('tblstructure',array('id'=>$hospital));
		
					$admin_email = $this->master_model->getRecords('users',array('id'=>12));
					$info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
					$info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Admin added examination','view'=>'user_exam_budget');
					$other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
									   'exam'       => $exam_type,
									   'msg'        => "add",
									   'message'    => 'Admin added examination for your hospital.',
									   'hospital'   => $hospital_info[0]['hospital']
									   );
				  
					if($this->email_sending->sendmail($info_arr, $other_arr))
					{
						 $this->session->set_flashdata('success','Exam added successfully.');
					}
					else 
					{
						$this->session->set_flashdata('error','Failed to send mail');
					}*/
					$this->session->set_flashdata('success','Exam added successfully.');
					 redirect(base_url().'admin/exams'); 
		
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
			}
		}
		
		
		$this->db->select('id,email,firstname,lastname');
		$users = $this->master_model->getRecords('users',array('status'=>1,'role'=>2,'is_approved'=>1));
		
		$data['users'] = $users;
		
		$this->data['title']="Add Exam";
		$data['scripts'] = array('admin.js');
		$getHospital = $this->master_model->getRecords('tblstructure',array('status'=>1,'owner_id'=>0),'id,hospital');
		//echo "<pre>"; print_r($getHospital);
		//exit();
		$data['hospital'] = $getHospital;
		$this->render('admin/exam-public-add-view',$data);
  }
	

    public function add_exam(){
    $data = array();
    $this->load->library(array( 'form_validation'));


    if(isset($_POST['btn_add_exam']))
    {

        $this->load->library(array( 'form_validation'));
        $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
        $this->form_validation->set_rules('exam_type', 'Exam Type', 'trim|required|xss_clean');
       //$this->form_validation->set_rules('common_name', 'Search Keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('official_waiting_days', 'Official waiting days', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('reported_waiting_days', 'Reported waiting days', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user', 'Advertiser', 'trim|required|xss_clean');
        if($this->form_validation->run())
        {
            $hospital     = $this->input->post('hospital');
            $exam_type    = $this->input->post('exam_type');
            $common_name  = $this->input->post('common_name');
            $price        = $this->input->post('price');
            $user_id      = $this->input->post('user');
            $official_waiting_days = $this->input->post('official_waiting_days');
            $reported_waiting_days = $this->input->post('reported_waiting_days');

            $insert_arr = array('struct_id'             => $hospital,
                                'exam_type'             => $exam_type,
                                'owner_id'              => $user_id,
                                'common_name'           => $common_name,
                                'official_waiting_days' => $official_waiting_days,
                                'reported_waiting_days' => $reported_waiting_days,
                                'price'                 => $price,
                                'lastupdated'           => date('Y-m-d H:i:s'),
                                'date_updated'          => date('Y-m-d'),
                                'status'=>'1'
                                );
                $exam_id = $this->master_model->insertRecord('tblexamination',$insert_arr,TRUE);
        
                $insert_ads = array('examination_id'    => $exam_id,
                                    'login_id'          => $user_id,
                                    'hospital_id'       => $hospital,
                                    'budget_amount'     => 0,
                                    'number_of_click'   => 0,
                                    );
                $this->master_model->insertRecord('tbl_ads_users',$insert_ads);
                $exam_pay_arr = array('exam_id'          => $exam_id,
                                      'login_id'         => $user_id,
                                      'amount'           => 0,
                                      );
                $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
                $user     = $this->master_model->getRecords('users',array('id'=>$user_id));
                $hospital_info = $this->master_model->getRecords('tblstructure',array('id'=>$hospital));

                $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Admin added examination','view'=>'user_exam_budget');
                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                                   'exam'       => $exam_type,
                                   'msg'        => "add",
                                   'message'    => 'Admin added examination for your hospital.',
                                   'hospital'   => $hospital_info[0]['hospital']
                                   );
              
                if($this->email_sending->sendmail($info_arr,$other_arr))
                {
                     $this->session->set_flashdata('success','Exam added successfully.');
                }
                else 
                {
                    $this->session->set_flashdata('error','Failed to send mail');
                }

                 redirect(base_url().'admin/add_exam'); 

        }
        else
        {
            $this->session->set_flashdata('error',$this->form_validation->error_string());
        }
        
    }


            $this->db->select('id,email,firstname,lastname');
    $users = $this->master_model->getRecords('users',array('status'=>1,'role'=>2,'is_approved'=>1));

    $data['users'] = $users;

    $this->data['title']="Add Exam";
    $data['scripts'] = array('admin.js');
    $getHospital = $this->master_model->getRecords('tblstructure',false,'id,hospital');
   //echo "<pre>"; print_r($getHospital);
    //exit();
    $data['hospital'] = $getHospital;
    $this->render('admin/exam-add-view',$data);
  }



    public function update_exam_common_name(){
       $exam_id= $this->input->post('exam_id');
       $common_name= $this->input->post('common_name');
       echo  $this->emod->update_exam_common_name($common_name,$exam_id);


    }
    public function edit_exam($id){

        $this->load->library(array( 'form_validation'));
        $this->form_validation->set_rules('exam_type', 'Exam Type', 'trim|required|xss_clean');
       // $this->form_validation->set_rules('common_name', 'Search Keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('official_waiting_days', 'Official waiting days', 'trim|required|xss_clean');
       // $this->form_validation->set_rules('reported_waiting_days', 'Reported waiting days', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');

        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['exam'] = $this->emod->get_exam_by_id($id);
           // echo"<pre>"; print_r($data['exam']); exit();
            $this->data['title']="Edit Exam";
            $data['scripts'] = array();
            $this->render('admin/exam-form-view',$data);

        }
        else
        { 
            $rep_wait_day = $this->input->post('reported_waiting_days');
            if($rep_wait_day == '')
                $dd =0;
            else
                $dd = $rep_wait_day;

            //insert the user registration details into database
            $data = array(
                'price' => $this->input->post('price'),
                'exam_type' => $this->input->post('exam_type'),
                'common_name' => $this->input->post('common_name'),
                'official_waiting_days' => $this->input->post('official_waiting_days'),
                'reported_waiting_days' => $dd,
                'price' => $this->input->post('price')
            );


            // insert form data into database
            if ($this->emod->update_exam($data,$id))
            {
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Exam are Successfully update!!!</div>');
                redirect(base_url().'admin/edit_exam/'.$id);
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect(base_url().'admin/edit_exam/'.$id);
            }
        }
    }
	public function users(){

		$data = array();

		$limit = 15;
		 $offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);
		$this->data['title']="Users list";
		$config = array();
		$config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
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
		$config['per_page'] = $limit;
		$config['base_url'] = base_url(). 'admin/users/';
		$config['uri_segment'] = 3;	
		$config['use_page_numbers'] = TRUE;		
		$config['total_rows'] =  $this->umod->get_users('2',$limit, $offset,'total_results'); // Total results only.
		//echo"<pre>";print_r($config['total_rows']); exit();
		$this->pagination->initialize($config);

    	$data['users'] = $this->umod->get_users('2',$limit, $offset);
       /* echo $this->db->last_query(); 
	    echo"<pre>";print_r($data['users']); exit();*/


		$data['pagination_links'] = $this->pagination->create_links();
		if($this->input->is_ajax_request()){
			echo json_encode($data);
		}else{
            $data['menu'] = 'users';
			$data['scripts'] = array('admin.js');
			$this->render('admin/users-view',$data);
		}
	}
	public function edit_user($id){
	   $this->load->library(array( 'form_validation'));
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['user'] = $this->umod->getUserById($id);
			$this->data['title']="Edit User";
			$data['scripts'] = array();
			$this->render('admin/users-update-view',$data);
          
        }
        else
        {
            //insert the user registration details into database
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'middlename' => $this->input->post('middlename'),
                'role'=>2,
                'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
                'gender' => $this->input->post('gender')
            );
            
            // insert form data into database
            if ($this->umod->updateUser($data,$id))
            {
                 $this->session->set_flashdata('msg','<div class="alert alert-success text-center">User are Successfully update!!!</div>');
                redirect(base_url().'admin/edit_user/'.$id);
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                 redirect(base_url().'admin/edit_user/'.$id);
            }
        }
	}
    public function normal_users(){

        $data = array();

        $limit = 15;
         $offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);
        $this->data['title']="Users list";
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
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
        $config['per_page'] = $limit;
        $config['base_url'] = base_url(). 'admin/normal_users/';
        $config['uri_segment'] = 3; 
        $config['use_page_numbers'] = TRUE;     
        $config['total_rows'] =  $this->umod->get_users(3,$limit, $offset,'total_results'); // Total results only.
        
        $this->pagination->initialize($config);
        //$this->db->where('role',3);
        $data['users'] = $this->umod->get_users(3,$limit, $offset);
        //echo"<pre>";print_r($data['users']); exit();


        $data['pagination_links'] = $this->pagination->create_links();
        if($this->input->is_ajax_request()){
            echo json_encode($data);
        }else{
            $data['menu'] = 'normal';
            $data['scripts'] = array('admin.js');
            $this->render('admin/normal-users-view',$data);
        }
    }
    public function edit_normal_user($id){
       $this->load->library(array( 'form_validation'));
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['user'] = $this->umod->getUserById($id);
            $this->data['title']="Edit Normal User";
            $data['scripts'] = array();
            $this->render('admin/users-update-view',$data);
          
        }
        else
        {
            //insert the user registration details into database
            $data = array(
                            'firstname' => $this->input->post('firstname'),
                            'lastname' => $this->input->post('lastname'),
                            'middlename' => $this->input->post('middlename'),
                            'role'=>3,
                            'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
                            'gender' => $this->input->post('gender')
                        );
            
            // insert form data into database
            if ($this->umod->updateUser($data,$id))
            {
                 $this->session->set_flashdata('msg','<div class="alert alert-success text-center">User are Successfully update!!!</div>');
                redirect(base_url().'admin/edit_normal_user/'.$id);
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                 redirect(base_url().'admin/edit_normal_user/'.$id);
            }
        }
    }

	function approve_user(){
		$post = $this->input->post();
		if(!empty($post))
        {
			echo $this->umod->approve_user($post['id']);
            $email_info = $this->master_model->getRecords('users',array('id'=>$post['id'])) ;
            if((isset($email_info)) && (count($email_info)>0))
            {
                $email = $email_info[0]['email'];
                $fname = $email_info[0]['firstname'];
                $lname = $email_info[0]['lastname'];
            }
            $admin_email = $this->master_model->getRecords('users',array('id'=>12));
            $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));

            $info_arr = array('from'=>$info_email[0]['info_email'],
                              'to'=>$email,
                              'subject'=>'Approved successfull.',
                              'view'=>'user_approval');

            $other_arr = array('user_name'  => $fname.' '.$lname );
                    
            if($this->email_sending->sendmail($info_arr,$other_arr))
            {
                $this->session->set_flashdata('success','Approved successfully !!!');
                redirect(base_url().'admin/users');    
            }
            else 
            {
                $this->session->set_flashdata('error','Failed to send mail !!!');
                redirect(base_url().'admin/users');
            }
		}
        else
        {
			echo 0;
		}
	}
	function remove_user(){
		$post = $this->input->post();
		if(!empty($post)){
			echo $this->umod->remove_user($post['id']);
		}else{
			echo 0;
		}
	}
    public function exam_reviews(){

        $data = array();

        $limit = 15;
        $offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);
        $this->data['title']="Exam Review List";
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
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
        $config['per_page'] = $limit;
        $config['base_url'] = base_url(). 'admin/exam_reviews/';
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] =  $this->emod->get_exam_reviews($limit, $offset,'total_results'); // Total results only.

        $this->pagination->initialize($config);
        $data['reviews'] = $this->emod->get_exam_reviews($limit, $offset);

        $data['pagination_links'] = $this->pagination->create_links();
        if($this->input->is_ajax_request()){
            echo json_encode($data);
        }else{
            $data['menu'] = 'reviews';
            $data['scripts'] = array('admin.js');
            $this->render('admin/exam-review-view',$data);
        }
    }
    function update_exam_review(){
        $post = $this->input->post();
        echo $this->emod->update_review($post);

    }
    function approve_exam_review(){
        $post = $this->input->post();
        if(!empty($post)){
            echo $this->emod->approve_review($post['id']);
        }else{
            echo 0;
        }
    }
    function remove_exam_review(){
        $post = $this->input->post();
        if(!empty($post)){
            echo $this->emod->remove_review($post['id']);
        }else{
            echo 0;
        }
    }
    public function get_exam_review($id){
        echo json_encode($this->emod->get_exam_review($id));
    }
    public function setting()
    {   
        $data=array();
        $data['title']="Click price";
        $data['menu']="setting";
        
        if(isset($_POST['btn_click_price']))
        {
            $this->form_validation->set_rules('price','Price','trim|required');
            if($this->form_validation->run())
            {
                $price = $this->input->post('price');
                if($this->master_model->updateRecord('tbl_click_price',array('price'=>$price),array('id'=>"1")))
                {
                    $this->session->set_flashdata('success1','Price update successfully');
                    redirect(base_url()."admin/setting");
                }
                else
                {
                    $this->session->set_flashdata('error1','Error while updating price');
                    redirect(base_url()."admin/setting");
                }

            }
            else
            {
                $this->session->set_flashdata('error',$this->form_validation->error_string());
            }

        }

         if(isset($_POST['btn_emails']))
        {
            $this->form_validation->set_rules('info_email','Info email','trim|required');
            $this->form_validation->set_rules('contact_email','Contact email','trim|required');
            if($this->form_validation->run())
            {
                $info_email    = $this->input->post('info_email');
                $contact_email = $this->input->post('contact_email');
                if($this->master_model->updateRecord('tbl_email_master',array('info_email'=>$info_email,'contact_email'=>$contact_email),array('id'=>"1")))
                {
                    $this->session->set_flashdata('success2','Email update successfully');
                    redirect(base_url()."admin/setting");
                }
                else
                {
                    $this->session->set_flashdata('error2','Error while updating Email');
                    redirect(base_url()."admin/setting");
                }

            }
            else
            {
                $this->session->set_flashdata('error',$this->form_validation->error_string());
            }

        }
        $price = $this->master_model->getRecords('tbl_click_price',array('id'=>1));
        $emails = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
        $data['emails'] = $emails;
        $data['price'] = $price;
        $data['scripts'] = array();
        $this->render('admin/admin-setting',$data);
    }

    public function contactenquiries()
    {
       $contact_details = $this->master_model->getRecords('tblcontattaci_request');
       $query = $this->db->last_query();
        $config = array();
        $config['full_tag_open'] = '<ul class="pagination" style="margin-bottom: 0;">';
        $config['full_tag_close'] = '</ul></div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
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
        $config['base_url'] = base_url(). 'admin/contactenquiries/';
        $config['uri_segment'] = 3; 
        $config['total_rows'] =  count($contact_details); 
        
        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3)?$this->uri->segment(3):0;
        $query.=" LIMIT ".$offset.', '.$config["per_page"];
        $result = $this->db->query($query);
        $contact_details = $result->result_array();
        $links=$this->pagination->create_links();
        $data['contact_details'] = $contact_details;
        $data['pagination_links'] = $links;
        $data['scripts'] = array();
        $data['menu']     = 'contactenquiries';
        $data['title'] = 'Contact Enquiries';
        if($this->input->is_ajax_request())
        {
            echo json_encode($data);
        }
        else 
        {
            $this->render('admin/contact-enquiries',$data);    
        }
    }

    /*Function for reply to contact enquiry*/
    public function replytocontact()
    {
        $id = $this->uri->segment(3);
        if($id == '')
        {
            redirect(base_url().'admin/contactenquiries');
        }

        if(isset($_POST['btn_reply']))
        {
            $this->form_validation->set_rules('reply_message','Message','required');
            if($this->form_validation->run())
            {
                $reply_message = $this->input->post('reply_message');
                $email         = $this->input->post('email');
                $contact_inf   = $this->master_model->getRecords('tblcontattaci_request',array('id'=>$id));
                $admin_info    = $this->master_model->getRecords('users',array('id'=>12));
                $info_email    = $this->master_model->getRecords('tbl_email_master');
                $info_arr      = array('from'=>$info_email[0]['contact_email'],'to'=>$email,'subject'=>'Contact Enquiry Reply','view'=>'contact-enquiry-reply');
                $other_arr     = array('email'=>$email,'message'=>$reply_message,'fname'=>$contact_inf[0]['nome'],'lname'=>$contact_inf[0]['cognome']);
                if($this->email_sending->sendmail($info_arr,$other_arr))
                {
                    $this->session->set_flashdata('success','Contact enquiry response sent successfully.');
                    redirect(base_url().'admin/replytocontact/'.$id);
                }
                else 
                {
                    $this->session->set_flashdata('error','Failed to send contact enquiry response');
                    redirect(base_url().'admin/replytocontact/'.$id);   
                }
            }
        }
        $contact_info = $this->master_model->getRecords('tblcontattaci_request',array('id'=>$id));
        $data['scripts'] = array();
        $data['title']   = 'Reply To Contact Enquiry';
        $data['menu'] = 'contactenquiries';
        $data['contact_info'] = $contact_info;
        $this->render('admin/reply-to-contact',$data);
    }

    /*Function to view contact enquiry*/
    public function viewcontact()
    {
        $id = $this->uri->segment(3);
        if($id == '')
        {
            redirect(base_url().'admin/contactenquiries');
        }
        $contact_details = $this->master_model->getRecords('tblcontattaci_request',array('id'=>$id));
        $data['contact_details'] = $contact_details;
        $data['title'] = 'Contact Enquiry Details';
        $data['scripts'] = array();
        $data['menu'] = 'contactenquiries';
        $this->render('admin/view-contact',$data);
    }

    public function hospital($id)
    {
         $user_id = $this->uri->segment(3);
        $this->db->join('tble_user_billing_details','tble_user_billing_details.login_id=users.id','left');
        $user_info = $this->master_model->getRecords('users',array('users.id'=>$user_id));
        $data['user_info'] = $user_info;
        $this->db->join('tblexamination','tblstructure.id=tblexamination.struct_id');
        $data['hospital_info'] = $this->master_model->getRecords('tblstructure',array('tblstructure.owner_id'=>$id));
        // echo "<pre>"; print_r($data['hospital_info']); exit();
        $data['scripts'] = array();
        $data['title']   = 'Hospital Details';
        $this->render('admin/hospital-view',$data);
    }

    public function exam_stats($exam_id)
    {

        if($exam_id == "")
        {
            redirect(base_url()."admin");
        }

        $day = '';
        if(isset($_POST['duration']) && $_POST['duration']!='')
        {
            $mm = $_POST['duration'];
            if($_POST['duration']=='last_7')
                $day =7;
            else if($_POST['duration']=='last_15')
                $day = 15;
            else if($_POST['duration']=='last_month')
                $day = 30;
            else 
                $day ="all";

        }
        else
        {
            $mm = "last_7";
            $day =7;
        }

          $this->db->join('tbl_ads_users','tbl_ads_users.examination_id = tblexamination.id');
        $examination = $this->master_model->getRecords('tblexamination',array('tblexamination.id'=>$exam_id));

        $exam_name = $this->master_model->getRecords('tblexamination',array('id'=>$exam_id));

         if(count($exam_name)>0)
          $common_name = $exam_name[0]['exam_type'];
         else
            $common_name = "";
        $data = array();
        $data['scripts'] = array();
        $this->data['title']="Stats";
        $data['common_name']=$common_name;

        $data['examination'] = $examination;
        $data['date_range']=$mm;
        $data['exam_id']=$exam_id;
        $this->render('admin/exam-click-report',$data);

    }

    public function userstats()
    {
        $user_id = $this->uri->segment(3);

        if($this->session->userdata('user')->id == '') 
        {
            redirect(base_url());
        }

        $day = '';
        if(isset($_POST['getRecords']) && $_POST['getRecords']!='')
        {
            $mm = $_POST['getRecords'];
            if($_POST['getRecords']=='last_7')
                $day =7;
            else if($_POST['getRecords']=='last_15')
                $day = 15;
            else if($_POST['getRecords']=='last_month')
                $day = 30;
            else 
                $day ="all";
        }
        else
        {
            $mm = "last_7";
            $day = 7;
        }

        $data['scripts'] = array();
        $this->data['title']="User Stats";


        $this->db->select_sum('impresion'); 
        $this->db->select_sum('budget_amount'); 
        $this->db->select_sum('clicks'); 
        $impresion  = $this->master_model->getRecords('tbl_ads_users',array('login_id'=>$user_id));

        /*$this->db->select_sum('clicks'); 
        $clicks  = $this->master_model->getRecords('tbl_ads_users',array('login_id'=>$user_id));
*/
         $data['date_range']=$mm;
         $data['impresion'] = $impresion;
         //$data['clicks'] = $clicks;
         $this->db->select('tblexamination.*,tbl_ads_users.*,tbl_click_datewise.date');
         $this->db->group_by('exam_id');
         $this->db->join('tbl_ads_users','tbl_ads_users.examination_id = tblexamination.id');
         $this->db->join('tbl_click_datewise','tbl_click_datewise.exam_id = tblexamination.id');
         if($day !='all')
          $this->db->where('tbl_click_datewise.date BETWEEN DATE_SUB(NOW(), INTERVAL '.$day.' DAY) AND NOW()');
         $getExam = $this->master_model->getRecords('tblexamination',array('tblexamination.owner_id'=>$user_id));
         $data['result'] = $getExam;
         $getUser = $this->master_model->getRecords('users',array('id'=>$user_id));
         $data['price'] = $getUser[0]['clicks_price'];
         $data['user_id'] = $user_id;
         $this->render('admin/user-stats',$data);
    }

    public function userdetails()
    {
        $user_id = $this->uri->segment(3);
        $this->db->join('tble_user_billing_details','tble_user_billing_details.login_id=users.id','left');
        $user_info = $this->master_model->getRecords('users',array('users.id'=>$user_id));
        $data['user_info'] = $user_info;
        $data['title'] = 'User Details';
        $data['scripts'] = array();
        
        $this->render('admin/user-details',$data);
        
    }

    // set click price to user by admin

    public function set_price()
    {
        $this->form_validation->set_rules('price','Price','required|trim|xss_clean');
        $this->form_validation->set_rules('user_id','User','required|trim|xss_clean');
        if($this->form_validation->run())
        {
            $user_id = $this->input->post('user_id');
            $price = $this->input->post('price');
            if($this->master_model->updateRecord('users',array('clicks_price'=>$price,'price_set_by'=>'admin'),array('id'=>$user_id)))
            {
                $this->session->set_flashdata('success','Price set successfully');
            }
            else
            {
               $this->session->set_flashdata('error','Error while set price'); 
            }
        }
        else
        {
            $this->session->set_flashdata('error',$this->form_validation->error_string());
        }
        redirect(base_url().'admin');
                            
       
    }



// Admin add examination by csv


public function add_exam_csv()
{
    $data = array();
    $this->load->library(array( 'form_validation'));
    if(isset($_POST['btn_exam_csv']))
    {
        $this->load->library(array( 'form_validation'));
        $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user', 'Advertiser', 'trim|required|xss_clean');
        if($this->form_validation->run())
        {
            $hospital     = $this->input->post('hospital');
            $user_id      = $this->input->post('user');
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
                   // $image_url = base_url().'uploads/exam_files/'.$file_name;
                    $i = 1;
                    $exam_file = 'uploads/exam_files/'.$file_name;
                    $file = fopen($exam_file, "r");

                    $exam_type = array();
                    $exam_price   = array();
                    $official_waiting_days = array();

                    //$exam_file = $file_name;
                   
                    while (($examData = fgetcsv($file, 10000, ",")) !== FALSE)
                    {
                      
                        if($i==1)
                        {
                            if(strtolower($examData[0]) != 'exam type' ||  strtolower($examData[1]) != 'official waiting days' ||  strtolower($examData[2]) != 'price')
                            {
                                $this->session->set_flashdata('error',"Your file column name sequence must be as exam type, official waiting days and price");
                                redirect(base_url().'admin/exams');
                            }
                            $i++;
                            continue;

                        }
                        $i++;
                        if(!is_numeric($examData[2]))
                        {
                            $this->session->set_flashdata('error',"Your file price column contain invalid value.");
                            redirect(base_url().'admin/exams');
                        }
                        if(!is_numeric($examData[1]))
                        {
                            $this->session->set_flashdata('error',"Your file official waiting days column contain invalid value.");
                            redirect(base_url().'admin/exams');
                        }
                        array_push($exam_type,$examData[0]);
                        array_push($official_waiting_days,$examData[1]);
                        array_push($exam_price,$examData[2]);
                    }

                    for($i=0;$i<count($exam_type);$i++)
                    {
                        $exam_insert_arr  = array('struct_id'               => $hospital,
                                                  'owner_id'                => $user_id,
                                                  'exam_type'               => $exam_type[$i],
                                                  'official_waiting_days'   => $official_waiting_days[$i],
                                                  'price'                   => $exam_price[$i],
                                                  'date_updated'            => date('d/m/Y'),
                                                );
                        $exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
                        $inser_arr = array('login_id'        => $user_id,
                                           'hospital_id'     => $hospital,
                                           'examination_id'  => $exam_id,
                                           'number_of_click' => 0,
                                           'budget_amount'   => 0,
                                           );
                        
                        $this->master_model->insertRecord('tbl_ads_users',$inser_arr);
                        $exam_pay_arr = array('exam_id'  => $exam_id,
                                              'login_id' => $user_id,
                                              'amount'   => 0
                                              );
                        $this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
                    }

                    $user     = $this->master_model->getRecords('users',array('id'=>$user_id));
                    $hospital_info = $this->master_model->getRecords('tblstructure',array('id'=>$hospital));

                    $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                    $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                    $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Admin added examination','view'=>'user_exam_budget');
                    $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                                       'msg'        => "add_csv",
                                       'message'    => 'Admin added examination for your hospital by file.',
                                       'hospital'   => $hospital_info[0]['hospital']
                                       );
                  
                    if($this->email_sending->sendmail_attach($info_arr,$other_arr,$exam_file))
                    {
                       $this->session->set_flashdata('success','Examination added successfully.');
                    }
                    else 
                    {
                        $this->session->set_flashdata('error','Failed to send mail');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(base_url().'admin/exams');
                }
            }
        }
        else
        {
            $this->session->set_flashdata('error',$this->form_validation->error_string());
        }
    }
    redirect(base_url().'admin/exams');

  }

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>