<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends MY_Controller {

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
		$this->load->model('master_model');
		$this->load->model('callerservice');
		$this->load->model('email_sending');
		$this->load->library('form_validation');
		$this->load->library('paypal_recurring_express');
		$this->load->library('pagination');

	}

	public function index()
	{
		
		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Google ads";
		$this->render('ads_main',$data);
	}
	
	public function dashboard()
	{
		/*print_r($_POST);
		exit();*/
		$user_id 		= $this->session->userdata('user')->id;
		
		if($user_id == "")
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

		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Dashboard";


        $this->db->select_sum('impresion'); 
        $this->db->select_sum('used_amount'); 
        $this->db->select_sum('clicks'); 
		$impresion  = $this->master_model->getRecords('tbl_ads_users',array('login_id'=>$user_id));

	     $data['date_range']=$mm;
		 $data['impresion'] = $impresion;
		 //$data['clicks'] = $clicks;
		 $this->db->select('tblexamination.*,tbl_ads_users.*,tbl_click_datewise.date');
		 $this->db->group_by('exam_id');
		 $this->db->join('tbl_ads_users','tbl_ads_users.examination_id = tblexamination.id');
		 $this->db->join('tbl_click_datewise','tbl_click_datewise.exam_id = tblexamination.id');
		 if($day !='all')
          $this->db->where('tbl_click_datewise.date BETWEEN DATE_SUB(NOW(), INTERVAL '.$day.' DAY) AND NOW()');
         $getExam = $this->master_model->getRecords('tblexamination',array('tblexamination.owner_id'=>$this->session->userdata('user')->id));
         $data['result'] = $getExam;

         $res = $this->master_model->getRecords('users',array('id'=>$user_id));
         if(count($res)>0)
         	$data['price'] = $res[0]['clicks_price'];
         else
         	$data['price'] = 0.00;
     
		 $this->render('dashboard',$data);
	}



	public function examination()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == "")
		{
			redirect(base_url());
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
		$examination = $this->master_model->getRecords('tblexamination',array('owner_id'=>$user_id));

		if(isset($_POST['exam_id']) && $_POST['exam_id']!=='')
			$exam_id = $_POST['exam_id'];
		else
		{ if(count($examination)>0)
			$exam_id = $examination[0]['examination_id'];
		  else
		  	$exam_id = '';

		}

		           
		$exam_name = $this->master_model->getRecords('tblexamination',array('owner_id'=>$user_id,'id'=>$exam_id));
		 if(count($exam_name)>0)
	        $common_name = $exam_name[0]['exam_type'];
	  	 else
	  	 	$common_name = "";
		


		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Examination";
		$data['common_name']=$common_name;

		$data['examination'] = $examination;
		$data['date_range']=$mm;
	    $data['exam_id']=$exam_id;
	   /* $getClickPrice = $this->master_model->getRecords('tbl_click_price');
        $data['getClickPrice'] = $getClickPrice;*/
		$this->render('examination-click-report',$data);
	}

	public function analytics()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == "")
		{
			redirect(base_url());
		}
						

					   $this->db->join('tbl_ads_users','tbl_ads_users.examination_id = tblexamination.id');
		$examination = $this->master_model->getRecords('tblexamination',array('owner_id'=>$user_id));

		

		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Analytics";
		

		$data['examination'] = $examination;
		$this->render('examination-analytics',$data);
	}


  
	public function business(){
		$data = array();
		$data['scripts'] = array();
		$sess 		 = $this->session->userdata('reg_arr');
		if(isset($_GET['btn_step1']))
		{
			$email = $this->input->get('user_email');

			if($email=="")
			{
				redirect(base_url()."ads/business");
			}
			else
			{

				$userid 	 = $sess['userid'];
				$logouturl 	 = $sess['logout_url'];
				$register_type = $sess['register_type'];
				$chk_user = $this->master_model->getRecords('users',array('email'=>$email));
				if(count($chk_user)>0)
				{   $this->session->set_flashdata('error',"Your email already exist. Please login your account.");
					redirect(base_url()."ads/business");
				}
				$reg_arr = array('email'=>$email,'userid'=>$userid,'logout_url'=>$logouturl,'register_type'=>$register_type);
				$this->session->set_userdata('reg_arr',$reg_arr);
				redirect(base_url()."ads/advertise");
			}
		}
		$this->data['title']="Registration";
		$this->render('ads_reg_step1',$data); 
       
	}

	public function advertise(){
		$data 		 = array();
		$sess 		 = $this->session->userdata('reg_arr');
		$email 		 = $sess['email'];
		$userid 	 = $sess['userid'];
		$logouturl   = $sess['logout_url'];
		$register_type = $sess['register_type'];
		if($email =='')
			redirect(base_url()."ads/business");

		$data['scripts'] = array();
		if(isset($_POST['btn_step2']))
		{
			$this->form_validation->set_rules('ads_hospital','Hospital','required|trim|xss_clean');
			$this->form_validation->set_rules('ads_address','Address','required|trim|xss_clean');
			$this->form_validation->set_rules('ads_city','City','required|trim|xss_clean');
			$this->form_validation->set_rules('ads_province','Province','required|trim|xss_clean');
			$this->form_validation->set_rules('ads_telephone','Telephone','required|trim|xss_clean');
			$this->form_validation->set_rules('ads_website','Website','required|trim|xss_clean');
			

			if($this->form_validation->run())
			{
				if(isset($_FILES['ads_image']) && $_FILES['ads_image']['error']==0)
                {
                    $config['upload_path']   = 'uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png|jpeg|gif';
                    $config['file_name']=time().basename($_FILES['ads_image']['name']);
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('ads_image'))
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
				$hospital 	  	= $this->input->post('ads_hospital');
				$address 		= $this->input->post('ads_address');
				$city   		= $this->input->post('ads_city');
				$province 	  	= $this->input->post('ads_province');
				//$address_format = $this->input->post('ads_address_format');'address_format'  => $address_format,
				$telephone  	= $this->input->post('ads_telephone');
				$fax       		= $this->input->post('ads_fax');
				$website     	= $this->input->post('ads_website');
				$image     		= $fileupload;
				$exam_type 		= $this->input->post('exam_type');
				//$common_name 	= $this->input->post('common_name');
				$exam_price 	= $this->input->post('exam_price');
				$official_waiting_days = $this->input->post('official_waiting_days');
				//$reporting_waiting_days= $this->input->post('reporting_waiting_days');
				$amount  		= $this->input->post('amount');
				$currency 		= $this->input->post('currency');
				$exam_budget 	= $this->input->post('exam_budget');
				$budget_type 	= $this->input->post('budget_type');
				$add_type       = $this->input->post('add_type');
				$file_name      = 'test' ;

				if($add_type == 'by_file')
				{
					if($exam_type[0]==' ' || $official_waiting_days[0] == ' ' || $exam_price[0] == ' ' || $budget_type == 'multiple_budget' )
					{
						$msg = "You select examination add by file then please select file.";
						$this->session->set_flashdata('error',$msg);
						redirect(base_url().'ads/business');
					}
					//exit();

					if(isset($_FILES['ads_file']) && $_FILES['ads_file']['error']==0)
	                {
				        {

			                $config['upload_path']   = 'uploads/exam_files';
			                $config['allowed_types'] = '*';
			                $config['file_name']=time().basename($_FILES['ads_file']['name']);
			                $this->load->library('upload',$config);
			                $this->upload->initialize($config);
			                if ($this->upload->do_upload('ads_file'))
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
			                                redirect(base_url().'ads/business');
			                            }
			                            $i++;
			                            continue;

			                        }
			                        $i++;
			                        if(!is_numeric($examData[2]))
			                        {
			                            $this->session->set_flashdata('error',"Your file price column contain invalid value.");
			                            redirect(base_url().'ads/business');
			                        }
			                        if(!is_numeric($examData[1]))
			                        {
			                            $this->session->set_flashdata('error',"Your file official waiting days column contain invalid value.");
			                            redirect(base_url().'ads/business');
			                        }
			                        array_push($exam_type,$examData[0]);
			                        array_push($official_waiting_days,$examData[1]);
			                        array_push($exam_price,$examData[2]);
			                    }

			                }
			                else
			                {
			                    $this->session->set_flashdata('error', $this->upload->display_errors());
			                    redirect(base_url().'ads/business');
			                }
			            }
	                }
	                else
	                {
	                	$msg = "You select examination add by file then please select file.";
						$this->session->set_flashdata('error',$msg);
						redirect(base_url().'ads/business');
	                }
					

				}
				 $image_url = base_url().'uploads/'.$image;

				$register_session = array('email' 			=> $email,
										  'hospital'    	=> $hospital,
										  'address'   		=> $address,
										  'city' 			=> $city,
										  'province'  		=> $province,
										  'telephone'		=> $telephone,
										  'fax'     		=> $fax,
										  'website'   		=> $website,
										  'image'			=> $image_url,
										  'amount'			=> $amount,
										  'currency'		=> $currency,
										  'exam_type'		=> $exam_type,
										  'exam_price'		=> $exam_price,
										  'official_waiting_days'=>$official_waiting_days,
										  'exam_budget'		=> $exam_budget,
										  'budget_type' 	=> $budget_type,
										  'userid'			=> $userid,
										  'logout_url'		=> $logouturl,
										  'register_type'	=> $register_type,
										  'add_type'        => $add_type,
										  'file_name'       => $file_name
									);
				
				$this->session->set_userdata('register_session',$register_session);
				redirect(base_url()."ads/billing");
				
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
			}

		}
		/*$getCurrency = $this->master_model->getRecords('tbl_currency');
		$data['getCurrency'] = $getCurrency;*/
		//print_r($this->data['getCurrency'] );

		$this->data['title']="Registration";
		$this->render('first-campaign',$data); 
       
	}

	public function billing()
	{
		$register_session = $this->session->userdata('register_session');
		
		if($register_session['email']=='')
		  redirect(base_url()."ads/business");
		
		
		$data = array();
		if(isset($_POST['btn_register_user']))
		{
			$this->form_validation->set_rules('country','Country','required|trim|xss_clean');
			$this->form_validation->set_rules('state','State','required|trim|xss_clean');
			$this->form_validation->set_rules('city','City information','required|trim|xss_clean');
			$this->form_validation->set_rules('pay_method','Pay method','required|trim|xss_clean');
			$this->form_validation->set_rules('postal_code','Postal code','required|trim|xss_clean');
			$this->form_validation->set_rules('name','Name','required|trim|xss_clean');
			$this->form_validation->set_rules('bill_address','Name','required|trim|xss_clean');
			
			if($this->form_validation->run())
			{
					$register_session = $this->session->userdata('register_session');
					$country     = $this->input->post('country');
					$state       = $this->input->post('state');
					$city        = $this->input->post('city');
					$pay_method  = $this->input->post('pay_method');
					$postal_code = $this->input->post('postal_code');
					$pay_type    = $this->input->post('pay_type');
					$name        = $this->input->post('name');
					$email 		     = $register_session['email'];
					$hospital 		 = $register_session['hospital'];
					$address 		 = $register_session['address'];
					$bill_address 	 = $this->input->post('bill_address');

					$latitude = '';
					$longitude ='';
					$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
		            $geo = json_decode($geo, true);
		            if ($geo['status'] == 'OK') 
		            {
		              $latitude = $geo['results'][0]['geometry']['location']['lat'];
		              $longitude = $geo['results'][0]['geometry']['location']['lng'];
		            } 

					$city 		 	 = $city;
					$province 	 	 = $register_session['province'];
					$amount 		 = $register_session['amount'];
					$currency 		 = $register_session['currency'];
					$telephone 	 	 = $register_session['telephone'];
					$fax 	 		 = $register_session['fax'];
					$website 	 	 = $register_session['website'];
					$image 	 		 = $register_session['image'];
					$exam_type 		 = $register_session['exam_type'];
					$exam_price 	 = $register_session['exam_price'];
					$official_waiting_days = $register_session['official_waiting_days'];
					$exam_budget 	 = $register_session['exam_budget'];
					$budget_type 	 = $register_session['budget_type'];
					$userid 	 	 = $register_session['userid'];
					$logouturl   	 = $register_session['logout_url'];
					$register_type 	 = $register_session['register_type'];
					$add_type		 = $register_session['add_type'];
					$file_name		 = $register_session['file_name'];
					$city_structure	 = $register_session['city'];

					if($pay_type == 'paypal')
					{
						$total_budget = array_sum($exam_budget);
						if($total_budget > 0)
					    {
					    	$amount = $total_budget;
					    }
					    else 
					    {
					    	$amount = $amount;
					    }

						$register_session = array('email'      => $email,
												  'country'    => $country,
												  'state'      => $state,
												  'city'       => $city,
												  'pay_method' => $pay_method,
												  'pay_type'   => $pay_type,
												  'name'       => $name,
												  'postal_code'=> $postal_code,
												  'hospital'   => $hospital,
												  'address'	   => $address,
												  'province'   => $province,
												  'telephone'  => $telephone,
												  'fax'		   => $fax,
												  'website'    => $website,
												  'image'	   => $image,
												  'exam_type'  => $exam_type,
												  'exam_price' => $exam_price,
												  'official_waiting_days'=>$official_waiting_days,
												  'amount'     => $amount,
												  'currency'   => $currency,
												  'exam_budget'=> $exam_budget,
												  'budget_type'	=> $budget_type,
												  'userid'		=> $userid,
												  'register_type'=>$register_type,
												  'logout_url'	=> $logouturl,
												  'amount'		=> $amount,
												  'add_type'	=>$add_type,
												  'bill_address'=> $bill_address,	
												  'file_name'	=> $file_name,
												  'city_structure'	 => $city_structure	
												);
		                $this->session->set_userdata('register_session',$register_session);
		                if($pay_method == "automatic")
		                {
		                	redirect(base_url().'ads/chk_rec_profile');
		                }
		              


		    			$url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);
					    $currencyCodeType = currencyCode; //define in paypal_constant in third_party directory
					    $paymentType = paymentType; //define in paypal_constant in third_party directory
					    $returnURL = urlencode(base_url().$this->uri->segment(1).'/paypal_sucess?res=success');
					    $cancelURL = urlencode(base_url().$this->uri->segment(1)."/paypal_cancel?res=cancel");
					    

				         /*fetch the amount and membership type name */
				        $amt     = $amount;
					    $maxamt  = $amount;
					    $L_AMT0  = $amount;
					    $L_NAME0 = "Medscanner Advertise Payment";
					    $nvpstr="";
					    $nvpHeader="";
					    /*Build NVP string*/
					    $nvpstr="&L_NAME0=".$L_NAME0."&L_AMT0=".$L_AMT0."&MAXAMT=".(string)$amt."&AMT=".(string)$amt."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&CARTBORDERCOLOR=005c8d";
					    //LOGOIMG....
					    $nvpstr = $nvpHeader.$nvpstr;
					    $resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
					    $ack = strtoupper($resArray["ACK"]);

					    if($ack == "SUCCESS")
					    {
					   	    /*Redirect to paypal.com here*/
					     	$token = urldecode($resArray["TOKEN"]);
					   	    $payPalURL = PAYPAL_URL.$token;
					   	    redirect($payPalURL);
					    }
					    else
					    {
					    	if(isset($image) && $image != '' )
							{
								@unlink('uploads/'.$image);
							}
							if(isset($file_name) && $file_name != '' && $add_type == 'by_file' )
							{
								@unlink('uploads/exam_files/'.$file_name);
							}
					   	    $errorType=$resArray["L_LONGMESSAGE0"];
							$this->session->set_flashdata('error',$errorType);
						    redirect(base_url().$this->uri->segment(1)."/business");
					    }	

					}
					else if($pay_type =="credit")
					{
					  
						$this->form_validation->set_rules('card_number','Card Number','required|trim|xss_clean');
						$this->form_validation->set_rules('cvv','Cvv number','required|trim|xss_clean');
						$this->form_validation->set_rules('exp_date','Expiry date','required|trim|xss_clean');
						$this->form_validation->set_rules('holder_name','Holder name','required|trim|xss_clean');
						$this->form_validation->set_rules('cart_type','Card Invalid','required|trim|xss_clean');

						$card_number = $this->input->post('card_number');
						$cvv         = $this->input->post('cvv');
						$exp_date    = $this->input->post('exp_date');
						$holder_name = $this->input->post('holder_name');
						$card_type   = $this->input->post('cart_type');
						
						if($this->form_validation->run())
			            {

			            	$total_budget = 0;
						    $total_budget = array_sum($exam_budget);
							if($total_budget > 0)
						    {
						    	$amount = $total_budget;
						    }
						    else 
						    {
						    	$amount = $amount;
						    }

						    if($pay_method == 'automatic')
						    {
						    	$register_session = array();
						    	$register_session = array('email'      => $email,
														  'country'    => $country,
														  'state'      => $state,
														  'city'       => $city,
														  'pay_method' => $pay_method,
														  'pay_type'   => $pay_type,
														  'name'       => $name,
														  'postal_code'=> $postal_code,
														  'hospital'   => $hospital,
														  'address'	   => $address,
														  'city_structure'	 => $city_structure,
														  'province'   => $province,
														  'telephone'  => $telephone,
														  'fax'		   => $fax,
														  'website'    => $website,
														  'image'	   => $image,
														  'exam_type'  => $exam_type,
														  'exam_price' => $exam_price,
														  'official_waiting_days' => $official_waiting_days,
														  'amount'     => $amount,
														  'currency'   => $currency,
														  'exam_budget'=> $exam_budget,
														  'adv_keywords'=> $adv_keywords,
														  'budget_type'	=> $budget_type,
														  'userid'		=> $userid,
														  'register_type' => $register_type,
														  'logout_url'	=> $logouturl,
														  'add_type'	=> $add_type,
														  'file_name'   => $file_name, 
														  'card_type'	=> $card_type,
														  'card_number' => str_replace(' ', '', $card_number),
														  'cc_exp'      => $exp_date,
														  'bill_address'=> $bill_address,	
														  'cvv'			=> $cvv	
														);
								$this->session->set_userdata('register_session',$register_session);
								redirect(base_url().'ads/create_rec_cardPay');

						    }

     						$paymentType 		= (paymentType);
							$creditCardType 	= $card_type;
							$creditCardNumber 	= $card_number;
							$creditCardNumber 	= str_replace(' ', '', $creditCardNumber);
							$cc_exp 			= $exp_date;
							$cvv2Number 		= $cvv;
							$amount 			= $amount;
							$cc_exp_arr 		= explode('/', $cc_exp);
							$currencyCode 		= currencyCode;
							
						     $nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".trim($cc_exp_arr[0]).trim($cc_exp_arr[1])."&CVV2=$cvv2Number&CURRENCYCODE=$currencyCode";
						    
						    if($budget_type == 'single_budget' || $add_type == 'by_file')
						    {
						    	$single_amt 	  = $amount / count($exam_type);
						    	$number_of_clicks  = 0;
						    }
						    else 
						    {
						    	$number_of_clicks 	= 0;	
						    }
						    

						    
							$resArray=$this->callerservice->hash_call("doDirectPayment",$nvpstr);
							/*echo "<pre>";
							print_r($resArray);
							exit();*/
							$ack = strtoupper($resArray["ACK"]);
							if($ack=="SUCCESS")
							{
								$trans_amount=$resArray['AMT'];
								$trans_id=$resArray['TRANSACTIONID'];
								$register_type = 'normal';
								$num = rand(111111,999999);
								$pass = md5($num);
								
								$name_arr = explode(" ", $name);
								$fname = '';
								$lname = '';
								if(count($name_arr)>1)
								{
									$fname = $name_arr[0];
								    $lname = $name_arr[1];
								}
								else
									$fname =$name;

								$user_arr = array('email'     => $email,
												  'password'  => $pass,
												  'firstname' => $fname,
												  'lastname'  => $lname,
												  'register_type' => $register_type,
												  'balance_amount' => $trans_amount,
												  'role'=>'2'	
									            );	
							
								
								$last_id = $this->master_model->insertRecord('users',$user_arr,TRUE);
					         	if($last_id)
					         	{

						    		$structure_insert_arr = array('owner_id' 		=> $last_id,
						    									 'hospital'			=> $hospital,
						    									 'address'			=> $address,
						    									 'city'				=> $city_structure,
						    									 'province'			=> $province,
						    									 'telephone'		=> $telephone,
						    									 'fax'				=> $fax,
						    									 'email'			=> $email,
						    									 'website'			=> $website,
						    									 'budget_amount' 	=> $amount,
						    									 'latitude'         => $latitude,
						    									 'longitude'        => $longitude,
						    									 'image_url'		=> $image
						    									);
						    		$structure_id = $this->master_model->insertRecord('tblstructure',$structure_insert_arr,true);

						    		$trans_data = array('login_id'         => $last_id,
										                'transaction_id'   => $trans_id,
														'amount'           => $trans_amount,
														'type'             => 'credit card',
														'status'           => 'active',
														'payment_method'   => 'non_recurring',
														'transaction_date' => date('Y-m-d H:i:s')
														);
									$user_transaction_id =  $this->master_model->insertRecord('tble_transaction',$trans_data,true);
									
						    		$business_data = array('login_id' 	   => $last_id,
						    							   'country' 	   => $country,
						    							   'state'	  	   => $state,
						    							   'city'          => $city,
						    							   'postal_code'   => $postal_code,
						    							   'pay_method'    => $pay_method,
						    							   'pay_type'      => $pay_type,
						    							   'address'       => $bill_address
						    							);

						    		for($i=0;$i<count($exam_type);$i++)
						    		{
						    			if($budget_type == 'single_budget' || $add_type == 'by_file')
						    			{
						    				$total_clicks = 0;
						    				$budget_amount = $single_amt;
						    			}
						    			else 
						    			{
						    				$total_clicks = 0;	
						    				$budget_amount = $exam_budget[$i];
						    			}
						    			$exam_insert_arr  = array('struct_id' 				=> $structure_id,
						    									  'owner_id'				=> $last_id,
						    									  'exam_type'				=> $exam_type[$i],
						    									  'official_waiting_days'	=> $official_waiting_days[$i],
						    									  'price'					=> $exam_price[$i],
						    									  'date_updated'			=> date('d/m/Y'),
						    									);
						    			$exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
						    			$inser_arr = array('login_id'        	=> $last_id,
						    							   'hospital_id'     	=> $structure_id,
						    							   'examination_id'  	=> $exam_id,
						    							   'number_of_click' 	=> $total_clicks,
						    							   'budget_amount'   	=> $budget_amount,
						    							   'used_amount'   	 	=> 0,
						    							   'remianing_amount'   => $budget_amount
						    							   );
						    			
						    			$this->master_model->insertRecord('tbl_ads_users',$inser_arr);
						    			$exam_pay_arr = array('exam_id'=> $exam_id,
						    								  'login_id' => $last_id,
						    								  'amount'	 => $budget_amount,
						    								  'payment_type' => "credit",
						    								  'payment_method' => "non_recurring",
						    								  'transaction_date' => date('Y-m-d'),
						    								  'transaction_id'   => $trans_id,
						    								  'order_id'         => $user_transaction_id	
					    									);
						    			$this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
						    		}
						    	    $this->master_model->insertRecord('tble_user_billing_details',$business_data);
									
				               
					                $admin_email = $this->master_model->getRecords('users',array('id'=>12));
					                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
					                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$email,'subject'=>'Registration successfull.','view'=>'user_registration');
					                $other_arr = array('user_name'  => $name,
					                				   'pay_type'   => 'Credit card',
					                				   'amount'     => $trans_amount,
					                				   'email'      => $email,
					                				   'password'   => $num,
					                				   'register_type' => 'Advertiser',
					                				   'pay_method'	   => 'Manual'	
	                				    			   );
				                  
				                    $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New user register.','view'=>'admin_user_registration');
					                $other_arr1 = array('user_name' => $name,
					                					'pay_type'	=> 'Credit card',
					                					'amount'    => $trans_amount,
					                					'email'     => $email,
					                					'register_type'    => 'Advertiser',
					                					'pay_method'	   => 'Manual'	
					                					);
				               
				                	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
				                	{
				                		$this->session->set_flashdata('success','Your registration successfull with payment !!!');
				                    	redirect(base_url().'ads/thankyou');	
				                	}
				                	else 
				                	{
				                		$this->session->set_flashdata('error','Failed to send mail !!!');
				                    	redirect(base_url().'ads/business');
				                	}
				                }
				                else
				                {
				                	$this->session->set_flashdata('error','Error while registering user !!!');
				                    redirect(base_url().'ads/business');
				                }
							}
							else
							{	
								if(isset($image) && $image != '')
								{
									@unlink('uploads/'.$image);
								}
								$errorType=$resArray["L_LONGMESSAGE0"];
								$this->session->set_flashdata('error',$errorType);
					  	     	redirect(base_url().'ads/business');
							}
							//exit();
						}
						else
						{
							$this->session->set_flashdata('error',$this->form_validation->error_string());
						}	
					}
			}
			else
			{
				//echo $this->form_validation->error_string();exit;
				$this->session->set_flashdata('error',$this->form_validation->error_string());
			}	

	    }

		$data['scripts'] = array();
		$this->data['title']="Registration";
		$countries = $this->master_model->getRecords('countries');
		$data['countries'] = $countries;
		$this->render('ads_reg_step3',$data); 
	}


	public function paypal_sucess()
	{

		if(isset($_REQUEST['res']) && $_REQUEST['res']=="success" && $_REQUEST['token']!="")
		{
			$getSess = $this->session->userdata('register_session');
			$trans_date = date('Y-m-d H:i:s');
			$currencyCodeType=currencyCode; //define in paypal_constant in third_party directory
		    $paymentType=paymentType; //define in paypal_constant in third_party directory

			$nvpHeader 			="";
			$token 				=urlencode($_REQUEST['token']);
			$nvpstr				="&TOKEN=".$token;
			$nvpstr 			= $nvpHeader.$nvpstr;
			$resArray 			=$this->callerservice->hash_call("GetExpressCheckoutDetails",$nvpstr);
			//$register_type 		= $getSess['register_type'];
			$userid 			= $getSess['userid'];
			
			$ack = strtoupper($resArray["ACK"]);
			if($ack == "SUCCESS" || $ack == 'SUCCESSW ITHWARNING')
			{
				$trans_amount=$resArray['AMT'];
				$number_of_clicks 	= 0;

				$nvpstr='&TOKEN='.$_REQUEST['token'].'&PAYERID='.$_REQUEST['PayerID'].'&PAYMENTACTION='.$paymentType.'&AMT='.$trans_amount.'&CURRENCYCODE='.$currencyCodeType;
				$resDoDirect=$this->callerservice->hash_call("DoExpressCheckoutPayment",$nvpstr);
				
	         	$trans_id = $resDoDirect['TRANSACTIONID'];

	         	$name_arr = explode(" ", $getSess['name']);
				$fname = '';
				$lname = '';
				if(count($name_arr)>1)
				{
					$fname = $name_arr[0];
				    $lname = $name_arr[1];
				}
				else
					$fname = $getSess['name'];
	         	

	         	$num = rand(111111,999999);
				$pass = md5($num);
				$register_type = 'normal';
				
				$user_arr = array('email'     		=> $getSess['email'],
								  'password'  		=> $pass,
								  'firstname'		=> $fname,
								  'lastname'  		=> $lname,
								  'register_type' 	=> $register_type,
								  'balance_amount' => $trans_amount,
								  'role'			=> '2'	
					            );	
				
				$last_id = $this->master_model->insertRecord('users',$user_arr,TRUE);
	         	if($last_id)
	         	{
	         		$hospital 		 = $getSess['hospital'];
					$address 		 = $getSess['address'];


					$latitude = '';
		            $longitude ='';
		            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
	                $geo = json_decode($geo, true);
	                if ($geo['status'] == 'OK') 
	                {
	                  $latitude = $geo['results'][0]['geometry']['location']['lat'];
	                  $longitude = $geo['results'][0]['geometry']['location']['lng'];
	                } 


					$city 		 	 = $getSess['city'];
					$province 	 	 = $getSess['province'];
					$amount 		 = $getSess['amount'];
					$currency 		 = $getSess['currency'];
					$telephone 	 	 = $getSess['telephone'];
					$fax 	 		 = $getSess['fax'];
					$website 	 	 = $getSess['website'];
					$image 	 		 = $getSess['image'];
					$exam_type 		 = $getSess['exam_type'];
					$exam_price 	 = $getSess['exam_price'];
					$official_waiting_days = $getSess['official_waiting_days'];
					$exam_budget 	 = $getSess['exam_budget'];
		    		$budget_type     = $getSess['budget_type'];
		    		$email           = $getSess['email'];
		    		$add_type        = $getSess['add_type'];
			        $file_name       = $getSess['file_name'];
			        $bill_address    = $getSess['bill_address'];
			        $city_structure  = $getSess['city_structure'];

		    		if($budget_type == 'single_budget' || $add_type == 'by_file')
				    {
				    	$single_amt 	  = $amount / count($exam_type);
				    	$number_of_clicks = 0;
				    }
				    else 
				    {
				    	$number_of_clicks 	= 0;	
				    }
		    		$structure_insert_arr = array('owner_id' 		=> $last_id,
		    									 'hospital'			=>	$hospital,
		    									 'address'			=> $address,
		    									 'city'				=> $city_structure,
		    									 'province'			=> $province,
		    									 'telephone'		=> $telephone,
		    									 'fax'				=> $fax,
		    									 'email'			=> $email,
		    									 'website'			=> $website,
		    									 'budget_amount'	=> $trans_amount,
		    									 'latitude'			=> $latitude,
		    									 'longitude'		=> $longitude,
		    									 'image_url'		=> $image
		    									  );
		    		$structure_id = $this->master_model->insertRecord('tblstructure',$structure_insert_arr,true);
		    		$trans_data = array('login_id'       => $last_id,
										'transaction_id' => $trans_id,
										'amount'         => $trans_amount,
										'type'           => 'paypal',
										'payment_method' => 'non_recurring',
										'status'         => 'active',
										'transaction_date'=> date('Y-m-d H:i:s')
										);
					$user_transaction_id = $this->master_model->insertRecord('tble_transaction',$trans_data,true);
		    		for($i=0;$i<count($exam_type);$i++)
		    		{
		    			if($budget_type == 'single_budget' || $add_type == 'by_file')
		    			{
		    				$total_clicks = 0;
		    				$budget_amount = $single_amt;
		    			}
		    			else 
		    			{
		    				$total_clicks = 0;	
		    				$budget_amount = $exam_budget[$i];
		    			}
		    			$exam_insert_arr  = array('struct_id' 				=> $structure_id,
		    									  'owner_id'				=> $last_id,
		    									  'exam_type'				=> $exam_type[$i],
		    									  'official_waiting_days'	=> $official_waiting_days[$i],
		    									  'price'					=> $exam_price[$i],
		    									  'date_updated'			=> date('d/m/Y')
		    									);
		    			$exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
		    			$getClickPrice = $this->master_model->getRecords('tbl_click_price');

		    			
						$inser_arr = array('login_id'        	=> $last_id,
										   'hospital_id'     	=> $structure_id,
										   'examination_id'  	=> $exam_id,
										   'number_of_click' 	=> $total_clicks,
										   'budget_amount'   	=> $budget_amount,
										   'used_amount'   	 	=> 0,
						    			   'remianing_amount'   => $budget_amount
										   );
		    			$this->master_model->insertRecord('tbl_ads_users',$inser_arr);

		    			$exam_pay_arr = array('exam_id'          => $exam_id,
		    								  'login_id'         => $last_id,
		    								  'amount'	         => $budget_amount,
		    								  'payment_type'     => "paypal",
		    								  'payment_method'   => "non_recurring",
		    								  'transaction_date' => date('Y-m-d'),
		    								  'transaction_id'   => $trans_id,
		    								  'order_id'		 => $user_transaction_id		
	    									);
		    			$this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);

		    		}
		    		$business_data = array('login_id' 	   => $last_id,
		    							   'country' 	   => $getSess['country'],
		    							   'state'	  	   => $getSess['state'],
		    							   'city'          => $getSess['city'],
		    							   'postal_code'   => $getSess['postal_code'],
		    							   'pay_method'    => $getSess['pay_method'],
		    							   'pay_type'      => $getSess['pay_type'],
		    							   'address'       => $bill_address
		    			);
		    	    $this->master_model->insertRecord('tble_user_billing_details',$business_data);
					
					
               
	                $admin_email = $this->master_model->getRecords('users',array('id'=>12));
	                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
	                $other_arr = array('user_name'   => $getSess['name'],
	                				    'pay_type'   => 'Paypal',
	                				    'amount'     => $trans_amount,
	                				    'email'      => $getSess['email'],
	                				    'password'   => $num,
	                				    'register_type' => 'Advertiser',
	                				    'pay_method'    => 'Manual'
	                				    );

	                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$getSess['email'],'subject'=>'Registration successfull.','view'=>'user_registration');
	               // $other_arr = array('user_name'=>$getSess['name'],'pay_type'=>'paypal','amount'=>$trans_amount,'email'=>$getSess['email'],'password'=>$num,'register_type'=>$register_type);
                  
                    $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New user register.','view'=>'admin_user_registration');
	                $other_arr1 = array('user_name' => $getSess['name'],
	                					'pay_type'  => 'paypal',
	                					'amount'    => $trans_amount,
	                					'email'     => $getSess['email'],
	                					'register_type' => 'Advertiser',
	                					'pay_method'    => 'Manual'
	                					);
               
                	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                	{
                		$this->session->set_flashdata('success','Your registration successfull with payment !!!');
                    	redirect(base_url().'ads/thankyou');	
                	}
                	else 
                	{
                		$this->session->set_flashdata('error','Failed to send mail !!!');
                    	redirect(base_url().'ads/business');
                	}
               
       
				}
				else
				{
					$this->session->set_flashdata('error','Error white adding record !!!');
                    redirect(base_url().'ads/business');
				}
	        }
	        else
			{
				$this->session->set_flashdata('error', "Something went wrong. Please try after some time.");
				redirect(base_url().'ads/business');
			}
		}
	        
	}


	public function paypal_cancel()
	{
		$getSess = $this->session->userdata('register_session');
		$image = $getSess['image'];
		if(isset($image) && $image != '')
		{
			@unlink('uploads/'.$image);
		}
		$this->session->set_flashdata('error', "Sorry you cancel your payment request.");
		redirect(base_url().'ads/business');
	}




// For paypal Recurring for registering Advertiser


public function chk_rec_profile()
{
		
		$recurring_start_date =  urlencode(date('Y-m-d')."T0:0:0");
		$getSess = $this->session->userdata('register_session');
		$trans_amount       = $getSess['amount'];
		$environment= environment;
		$this->paypal_recurring_express->environment = $environment;	// or 'beta-sandbox' or 'live'
		$this->paypal_recurring_express->paymentType = paymentType;				// or 'Sale' or 'Order' or 'Authorization'
		// Set request-specific fields.
		$this->paypal_recurring_express->startDate = $recurring_start_date;
		$this->paypal_recurring_express->billingPeriod = urlencode("Month");				// or "Day", "Week", "SemiMonth", "Year","Month"
		$this->paypal_recurring_express->billingFreq = urlencode("1");	
		$this->paypal_recurring_express->billingDes = "Test description";					// combination of this and billingPeriod must be at most a year
		$this->paypal_recurring_express->paymentAmount = number_format(urlencode($trans_amount),2);
		$this->paypal_recurring_express->currencyID = urlencode(currencyCode);	
		$this->paypal_recurring_express->initamt=0.00;// = urlencode(currencyCode);						// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
	
		/* PAYPAL API  DETAILS */
		$this->paypal_recurring_express->API_UserName  = API_USERNAME;
		$this->paypal_recurring_express->API_Password  = API_PASSWORD;
		$this->paypal_recurring_express->API_Signature = API_SIGNATURE;
		$this->paypal_recurring_express->API_Endpoint = API_ENDPOINT;

		/*SET SUCCESS AND FAIL URL*/
		$this->paypal_recurring_express->returnURL = urlencode(base_url()."ads/chk_rec_profile/getExpressCheckout");
		$this->paypal_recurring_express->cancelURL = urlencode(base_url()."ads/paypal_cancel");
				
		// var_dump($_GET);exit;
		if($this->uri->segment(3)=="")
		{$n_task="setExpressCheckout";}		
		else
		{  
			$_REQUEST['token'] = $_GET['token'];
			$_REQUEST['PayerID'] = $_GET['PayerID'];

		    if(isset($_REQUEST))
		    {
			    $result=json_decode($this->paypal_recurring_express->getExpressCheckout());
			    $resultAtatus=urldecode($result->ACK);

			    $register_type 		= $getSess['register_type'];
			   
			    if($resultAtatus=='Failure')
			    {
			    	redirect(base_url('ads/business'));
			    }
			    $profileId = urldecode($result->PROFILEID);
				$trans_id = urldecode($result->CORRELATIONID);
			   	
			    $trans_date = date('Y-m-d H:i:s');

				

	         	$name_arr = explode(" ", $getSess['name']);
				$fname = '';
				$lname = '';
				if(count($name_arr)>1)
				{
					$fname = $name_arr[0];
				    $lname = $name_arr[1];
				}
				else 
					$fname = $getSess['name'];
	         	
				$num = rand(111111,999999);
				$pass = md5($num);
				$register_type = 'normal';
				
					
				$user_arr = array('email'     => $getSess['email'],
								  'password'  => $pass,
								  'firstname' => $fname,
								  'lastname'  => $lname,
								  'register_type' => $register_type,
								  'balance_amount' => $trans_amount,
								  'role'=>'2'	
					            );	
			
				$last_id = $this->master_model->insertRecord('users',$user_arr,TRUE);
	         	if($last_id)
	         	{
	         		$hospital 		 = $getSess['hospital'];
					$address 		 = $getSess['address'];


					$latitude = '';
		            $longitude ='';
		            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
	                $geo = json_decode($geo, true);
	                if ($geo['status'] == 'OK') 
	                {
	                  $latitude = $geo['results'][0]['geometry']['location']['lat'];
	                  $longitude = $geo['results'][0]['geometry']['location']['lng'];
	                } 

					$city 		 	 = $getSess['city'];
					$province 	 	 = $getSess['province'];
					$amount 		 = $getSess['amount'];
					$currency 		 = $getSess['currency'];
					$telephone 	 	 = $getSess['telephone'];
					$fax 	 		 = $getSess['fax'];
					$website 	 	 = $getSess['website'];
					$image 	 		 = $getSess['image'];
					$exam_type 		 = $getSess['exam_type'];
					$exam_price 	 = $getSess['exam_price'];
					$official_waiting_days = $getSess['official_waiting_days'];
					$exam_budget 	 = $getSess['exam_budget'];
		    		$budget_type     = $getSess['budget_type'];
		    		$email           = $getSess['email'];
		    		$add_type        = $getSess['add_type'];
		    		$file_name       = $getSess['file_name'];
		    		$bill_address    = $getSess['bill_address'];
		    		$city_structure  = $getSess['city_structure'];

		    		if($budget_type == 'single_budget' || $add_type == 'by_file')
				    {
				    	$single_amt 	  = $amount / count($exam_type);
				    	$number_of_clicks = 0;
				    }
				    else 
				    {
				    	$number_of_clicks 	= 0;	
				    }
		    		$structure_insert_arr = array('owner_id' 		=> $last_id,
		    									 'hospital'			=>	$hospital,
		    									 'address'			=> $address,
		    									 'city'				=> $city_structure,
		    									 'province'			=> $province,
		    									 'telephone'		=> $telephone,
		    									 'fax'				=> $fax,
		    									 'email'			=> $email,
		    									 'website'			=> $website,
		    									 'budget_amount'	=> $trans_amount,
		    									 'latitude'			=> $latitude,
		    									 'longitude'		=> $longitude,
		    									 'image_url'		=> $image
						    					);
		    		$structure_id = $this->master_model->insertRecord('tblstructure',$structure_insert_arr,true);
		    		$trans_data = array('login_id'       => $last_id,
										'transaction_id' => $trans_id,
										'amount'         => $trans_amount,
										'type'           => 'paypal',
										'payment_method' => 'recurring',
										'transaction_date'=> date('Y-m-d H:i:s'),
										'status'		 => 'active',
										'profile_id'	  => $profileId	
										);
					$user_transaction_id = $this->master_model->insertRecord('tble_transaction',$trans_data,TRUE);
		    		for($i=0;$i<count($exam_type);$i++)
		    		{
		    			if($budget_type == 'single_budget' || $add_type == 'by_file')
		    			{
		    				$total_clicks = 0;
		    				$budget_amount = $single_amt;
		    			}
		    			else 
		    			{
		    				$total_clicks = 0;	
		    				$budget_amount = $exam_budget[$i];
		    			}
		    			$exam_insert_arr  = array('struct_id' 				=> $structure_id,
		    									  'owner_id'				=> $last_id,
		    									  'exam_type'				=> $exam_type[$i],
		    									  'official_waiting_days'	=> $official_waiting_days[$i],
		    									  'price'					=> $exam_price[$i],
		    									  'date_updated'			=> date('d/m/Y'),
		    									);
		    			$exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
		    			
						$inser_arr = array('login_id'        => $last_id,
										   'hospital_id'     => $structure_id,
										   'examination_id'  => $exam_id,
										   'number_of_click' => $total_clicks,
										   'budget_amount'   => $budget_amount,
										   'used_amount'   	 	=> 0,
						    			   'remianing_amount'   => $budget_amount
										   );
		    			$this->master_model->insertRecord('tbl_ads_users',$inser_arr);

		    			$exam_pay_arr = array('exam_id'          => $exam_id,
		    								  'login_id'         => $last_id,
		    								  'amount'	         => $budget_amount,
		    								  'payment_type'     => "paypal",
		    								  'payment_method'   => "recurring",
		    								  'transaction_date' => date('Y-m-d'),
		    								  'profile_id'       => $profileId,
		    								  'transaction_id'   => $trans_id,
		    								  'order_id'         => $user_transaction_id	
	    									);
		    			$this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
		    		}
		    		$business_data = array('login_id' 	   => $last_id,
		    							   'country' 	   => $getSess['country'],
		    							   'state'	  	   => $getSess['state'],
		    							   'city'          => $getSess['city'],
		    							   'postal_code'   => $getSess['postal_code'],
		    							   'pay_method'    => $getSess['pay_method'],
		    							   'pay_type'      => $getSess['pay_type'],
		    							   'address'	   => $getSess['bill_address']
		    			);
		    	    $this->master_model->insertRecord('tble_user_billing_details',$business_data);
		    	    
		    	   // $profile = $this->getProfile($profileId);
					
					$admin_email = $this->master_model->getRecords('users',array('id'=>12));
	                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
	                $other_arr = array('user_name'   => $getSess['name'],
	                				    'pay_type'   => 'Paypal',
	                				    'amount'     => $trans_amount,
	                				    'email'      => $getSess['email'],
	                				    'password'   => $num,
	                				    'register_type' => 'Advertiser',
	                				    'pay_method'    => 'Automatic'
	                				    );

	                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$getSess['email'],'subject'=>'Registration successfull.','view'=>'user_registration');
	               
                    $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New user register.','view'=>'admin_user_registration');
	                $other_arr1 = array('user_name' => $getSess['name'],
	                					'pay_type'  => 'paypal',
	                					'amount'    => $trans_amount,
	                					'email'     => $getSess['email'],
	                					'register_type' => 'Advertiser',
	                					'pay_method'    => 'Automatic'
	                				    );
               
                	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                	{
                		$this->session->set_flashdata('success','Your registration successfull with payment !!!');
                    	redirect(base_url().'ads/thankyou');	
                	}
                	else 
                	{
                		$this->session->set_flashdata('error','Failed to send mail !!!');
                    	redirect(base_url().'ads/business');
                	}
                }
				else
				{
					$this->session->set_flashdata('error','Error white adding record !!!');
                    redirect(base_url().'ads/business');
				}
			}
			else
			{
				$$this->session->set_flashdata("error","Error while payment.");
				redirect(base_url().'ads/business');
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

	// Credit card recurring for registering advertiser

	public function create_rec_cardPay()
	{  	
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
			$cvv2Number	= intval($getSess['cvv']);
			$start      = $recurring_start_date;
			$desc       = 'Medscanner Advertise Payment';
			$period     = urlencode("Month");
			$freq       = urlencode("1");
			$amt = $getSess['amount'];
			$currency=currencyCode;
			
			$street='';
			$city='';
			$state='';
			$code='';
			$zip='';
			$email=$getSess['email'];
			//exit();
			
		}
		$dollarValue=(float)number_format($amt,2);
		//require_once('credentials.php');
		// Include and instantiate the API
		require_once('PayPal.class.php');
		$username  = API_USERNAME;
		$password  = API_PASSWORD;
		$signature = API_SIGNATURE;
		
		$paypal = new PayPal('', $username, $password, $signature);
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
				
				$trans_amount       = $amt;
				$number_of_clicks 	= 0;

	         	$name_arr = explode(" ", $getSess['name']);
				$fname = '';
				$lname = '';
				if(count($name_arr)>1)
				{
					$fname = $name_arr[0];
				    $lname = $name_arr[1];
				}
				else
					$fname = $getSess['name'];
	         	
				$num = rand(111111,999999);
				$pass = md5($num);
				
					
					$user_arr = array('email'     => $getSess['email'],
									  'password'  => $pass,
									  'firstname' => $fname,
									  'lastname'  => $lname,
									  'register_type' => 'normal',
									  'balance_amount' => $trans_amount,
									  'role'=>'2'	
						            );	
				
				
				$last_id = $this->master_model->insertRecord('users',$user_arr,TRUE);
	         	if($last_id)
	         	{
	         		$hospital 		 = $getSess['hospital'];
					$address 		 = $getSess['address'];

					$latitude = '';
		            $longitude ='';
		            $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
	                $geo = json_decode($geo, true);
	                if ($geo['status'] == 'OK') 
	                {
	                  $latitude = $geo['results'][0]['geometry']['location']['lat'];
	                  $longitude = $geo['results'][0]['geometry']['location']['lng'];
	                } 

					$city 		 	 = $getSess['city'];
					$province 	 	 = $getSess['province'];
					$amount 		 = $getSess['amount'];
					$currency 		 = $getSess['currency'];
					$telephone 	 	 = $getSess['telephone'];
					$fax 	 		 = $getSess['fax'];
					$website 	 	 = $getSess['website'];
					$image 	 		 = $getSess['image'];
					$exam_type 		 = $getSess['exam_type'];
					$exam_price 	 = $getSess['exam_price'];
					$official_waiting_days = $getSess['official_waiting_days'];
					$exam_budget 	 = $getSess['exam_budget'];
		    		$budget_type     = $getSess['budget_type'];
		    		$email           = $getSess['email'];
		    		$add_type 		 = $getSess['add_type'];
		    		$file_name       = $getSess['file_name'];
		    		$city_structure  = $getSess['city_structure'];

		    		if($budget_type == 'single_budget' || $add_type == 'by_file')
				    {
				    	$single_amt 	  = $amount / count($exam_type);
				    	$number_of_clicks = 0;
				    }
				    else 
				    {
				    	$number_of_clicks 	= 0;	
				    }
		    		$structure_insert_arr = array('owner_id' 		=> $last_id,
		    									 'hospital'			=>	$hospital,
		    									 'address'			=> $address,
		    									 'city'				=> $city_structure,
		    									 'province'			=> $province,
		    									 'telephone'		=> $telephone,
		    									 'fax'				=> $fax,
		    									 'email'			=> $email,
		    									 'website'			=> $website,
		    									 'budget_amount'	=> $trans_amount,
		    									 'latitude'			=> $latitude,
		    									 'longitude'		=> $longitude,
		    									 'image_url'		=> $image
						    					);
		    		$structure_id = $this->master_model->insertRecord('tblstructure',$structure_insert_arr,true);
		    		$trans_data = array('login_id'       => $last_id,
										'transaction_id' => $trans_id,
										'amount'         => $trans_amount,
										'type'           => 'credit card',
										'payment_method' => 'recurring',
										'transaction_date'=> date('Y-m-d H:i:s'),
										'status'		  => 'active',
										'profile_id'	  => $profileId	
										);
					$user_transaction_id = $this->master_model->insertRecord('tble_transaction',$trans_data,TRUE);

		    		for($i=0;$i<count($exam_type);$i++)
		    		{
		    			if($budget_type == 'single_budget' || $add_type == "by_file")
		    			{
		    				$total_clicks = 0;
		    				$budget_amount = $single_amt;
		    			}
		    			else 
		    			{
		    				$total_clicks  = 0;	
		    				$budget_amount =  $exam_budget[$i];
		    			}
		    			//$total_clicks = $exam_budget[$i]/$click_amt[0]['price'];
		    			$exam_insert_arr  = array('struct_id' 				=> $structure_id,
		    									  'owner_id'				=> $last_id,
		    									  'exam_type'				=> $exam_type[$i],
		    									  'official_waiting_days'	=> $official_waiting_days[$i],
		    									  'price'					=> $exam_price[$i],
		    									  'date_updated'			=> date('d/m/Y'),
		    									);
		    			$exam_id = $this->master_model->insertRecord('tblexamination',$exam_insert_arr,true);
		    			$getClickPrice = $this->master_model->getRecords('tbl_click_price');

		    			
						$inser_arr = array('login_id'        => $last_id,
										   'hospital_id'     => $structure_id,
										   'examination_id'  => $exam_id,
										   'number_of_click' => $total_clicks,
										   'budget_amount'   => $budget_amount,
										   'used_amount'   	 	=> 0,
						    			   'remianing_amount'   => $budget_amount
										   );
		    			$this->master_model->insertRecord('tbl_ads_users',$inser_arr);
		    			$exam_pay_arr = array('exam_id'          => $exam_id,
		    								  'login_id'         => $last_id,
		    								  'amount'	         => $budget_amount,
		    								  'payment_type'     => "credit",
		    								  'payment_method'   => "recurring",
		    								  'transaction_date' => date('Y-m-d'),
		    								  'profile_id'       => $profileId,
		    								  'transaction_id'   => $trans_id,
		    								  'order_id'         => $user_transaction_id	
	    									);
		    			$this->master_model->insertRecord('tbl_exam_transaction',$exam_pay_arr);
		    		}
		    		$business_data = array('login_id' 	   => $last_id,
		    							   'country' 	   => $getSess['country'],
		    							   'state'	  	   => $getSess['state'],
		    							   'city'          => $getSess['city'],
		    							   'postal_code'   => $getSess['postal_code'],
		    							   'pay_method'    => $getSess['pay_method'],
		    							   'pay_type'      => $getSess['pay_type'],
		    							   'address'	   => $getSess['bill_address']
		    			);
		    	    $this->master_model->insertRecord('tble_user_billing_details',$business_data);
					
					
               		 
		    	    //$profile = $this->getProfile($profileId);
	                $admin_email = $this->master_model->getRecords('users',array('id'=>12));

	                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
	                $other_arr = array('user_name'   => $getSess['name'],
	                				    'pay_type'   => 'Credit card',
	                				    'amount'     => $trans_amount,
	                				    'email'      => $getSess['email'],
	                				    'password'   => $num,
	                				    'register_type' => "Advertiser",
	                				    'pay_method' => 'Automatic'
	                				    );

	                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$getSess['email'],'subject'=>'Registration successfull.','view'=>'user_registration');
	               
                    $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New user register.','view'=>'admin_user_registration');
	                $other_arr1 = array('user_name'=> $getSess['name'],
	                					'pay_type' => 'paypal',
	                					'amount'   => $trans_amount,
	                					'email'    => $getSess['email'],
	                					'register_type' => "Advertiser",
	                					'pay_method' => 'Automatic'
	                				    );
               
                	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
                	{
                		$this->session->set_flashdata('success','Your registration successfull with payment !!!');
                    	redirect(base_url().'ads/thankyou');	
                	}
                	else 
                	{
                		$this->session->set_flashdata('error','Failed to send mail !!!');
                    	redirect(base_url().'ads/business');
                	}
               
       
				}
				else
				{
					$this->session->set_flashdata('error','Error white adding record !!!');
                    redirect(base_url().'ads/business');
				}
		    

		}
		if($profile['ACK']!="Success")
		{
			$this->session->set_flashdata("error",'Invalid card information provided.');
			redirect(base_url().'ads/business');	
		}
	}

	public function thankyou(){
		$data = array();
		$data['scripts'] = array();
		
		$this->data['title']="Thank You";
		$this->render('thank_you',$data); 
       
	}

	public function opportunities()
	{
    	$user_id 		= $this->session->userdata('user')->id;
		if($user_id == "")
		{
			redirect(base_url());
		}

		$sql ="select * from tblexamination 
		      JOIN `users` ON `users`.`id`=`tblexamination`.`owner_id`
		 	  JOIN `tbl_ads_users` ON `tblexamination`.`id`=`tbl_ads_users`.`examination_id` 
			  where tbl_ads_users.login_id=".$user_id." AND ((tbl_ads_users.remianing_amount/users.clicks_price)<=1)";
		$examination = $this->db->query($sql)->result();
		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Opportunities";
		$data['examination'] = $examination;
		$this->render('clicks-opportunities',$data);

	}
	

// My orders

public function myorders()
{
	$user_id = $this->session->userdata('user')->id;
	if($user_id == "")
		redirect(base_url());
					$this->db->order_by('id','DESC');
    $transaction = $this->master_model->getRecords('tble_transaction',array('login_id'=>$user_id));
    $query = $this->db->last_query();

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
        $config['base_url'] = base_url(). 'ads/myorders';
        $config['uri_segment'] = 3; 
        $config['total_rows'] =  count($transaction);

        $this->pagination->initialize($config);
        $offset = $this->uri->segment(3)?$this->uri->segment(3):0;
        $query.=" LIMIT ".$offset.', '.$config["per_page"];
        $result = $this->db->query($query);
        $transaction = $result->result_array();
        $links=$this->pagination->create_links();
        $data['transaction'] = $transaction;
        $data['pagination_links'] = $links;
        $data['scripts'] = array();
       /// $data['menu']     = 'contactenquiries';
        $data['title'] = 'My orders';
        if($this->input->is_ajax_request())
        {
        	 echo json_encode($data);
        }
        else 
        {
            $this->render('my-orders-view',$data);    
        }

}

public function order_view($order_id)
{
	$user_id = $this->session->userdata('user')->id;
	if($order_id == "" || $user_id == '')
		redirect(base_url());
				$this->db->join('tble_transaction','tble_transaction.id = tbl_recurring_payments.id_trans');
	$order = $this->master_model->getRecords('tbl_recurring_payments',array('id_trans'=>$order_id));
	if(count($order)<=0)
	{
		$this->session->set_flashdata('error',"No more orders.");
		redirect(base_url().'ads/myorders');
	}
	$data['order'] = $order;
	$data['scripts'] = array();
	$data['title'] = 'Order view';
	$this->render('orders_view',$data);   


}

public function cancel_order($order_id)
{
	$user_id = $this->session->userdata('user')->id;
	if($user_id == '' || $order_id == '')
		redirect(base_url());
	$user = $this->master_model->getRecords('users',array('id'=>$user_id,'is_approved'=>1,'status'=>1));
	if(count($user)<=0)
		redirect(base_url());

	$order = $this->master_model->getRecords('tble_transaction',array('id'=>$order_id));
	if(count($order)<=0)
	{
		$this->session->set_flashdata('error',"Order Not found.");
		redirect(base_url().'ads/myorders');
	}
	if($order[0]['payment_method'] != 'recurring')
	{
		$this->session->set_flashdata('error',"Order is manual.");
		redirect(base_url().'ads/myorders');
	}
	require_once('PayPal.class.php');
	$username=API_USERNAME;
	$password=API_PASSWORD;
	$signature=API_SIGNATURE;
	$paypal = new PayPal('SANDBOX', $username, $password, $signature);
	
    $profileID=$order[0]['profile_id'];
    //$profileID = "I-1UW3UWA7N4PL";
	$action='Cancel';
	$nvpStr="&PROFILEID=$profileID&ACTION=$action";
	/* Make the API call to PayPal, using API signature.
	The API response is stored in an associative array called $resArray */
	$resArray=$this->callerservice->hash_call("ManageRecurringPaymentsProfileStatus",$nvpStr);

	if($resArray == TRUE)
	{
		$name = $user[0]['firstname']." ".$user[0]['lastname'];
		$admin_email = $this->master_model->getRecords('users',array('id'=>12));
        $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
        $user_message = "Your automatic payment profile cancelled successfully.";
        $admin_message ="$name has cancelled his automatic payment profile.";
        $info_arr  = array('from'    => $info_email[0]['info_email'],
        	               'to'      => $user[0]['email'],
        	               'subject' => 'Automatic payment cancelled successfully.',
        	               'view'    => 'payment_get_user'
        	               );
        $other_arr = array('user_name'  => $name,
        				   'pay_type'   => $order[0]['type'],
        				   'amount'     => $order[0]['amount'],
        				   'message'	=> $user_message
        				   );

        $info_arr1  = array('from'      => $info_email[0]['info_email'],
        	                'to'        => $admin_email[0]['email'],
        	                'subject'   => 'Automatic payment cancelled by advertiser',
        	                'view'      => 'payment_get_admin'
        	                );
        $other_arr1 = array('user_name' => $name,
        					'pay_type'  => $order[0]['type'],
        					'amount'    => $order[0]['amount'],
        					'email'     => $user[0]['email'],
        					'message'	=> $admin_message
        					);
   		if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
    	{

    	}
		$this->master_model->updateRecord('tble_transaction',array('status'=>'cancelled'),array('id'=>$order_id));
		$this->session->set_flashdata('success',"Your automatic payment cancelled successfully.");
	}
	else
		$this->session->set_flashdata('error',"Error while cancelling your automatic payment");

	redirect(base_url().'ads/myorders');

}


public function balance()
{
	$user_id = $this->session->userdata('user')->id;
	if($user_id == '' )
		redirect(base_url());
	$pay_acc = $this->master_model->getRecords('tble_transaction',array('login_id'=>$user_id,'payment_method'=>'recurring','status'=>'active'));
	$user = $this->master_model->getRecords('users',array('id'=>$user_id));

	if(isset($_POST['btn_update_budget']))
	{
	
		$this->form_validation->set_rules('budget','Budget','required|trim|xss_clean');
		if($this->form_validation->run())
		{
			$budget = $this->input->post('budget');
			$payment_type = $this->input->post('payment_type');
			$payment_method = $this->input->post('payment_method');
			if($payment_type == 'paypal')
			{
				$budget_session = array('budget'  => $budget);
                $this->session->set_userdata('budget_session',$budget_session);

                if($payment_method == "automatic")
                {
                	redirect(base_url().'ads/chk_rec_profile_budget');
                }

    			$url=dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);
			    $currencyCodeType=currencyCode; //define in paypal_constant in third_party directory
			    $paymentType=paymentType; //define in paypal_constant in third_party directory
			    $returnURL = urlencode(base_url().$this->uri->segment(1).'/paypal_sucess_budget?res=success');
			    $cancelURL = urlencode(base_url().$this->uri->segment(1)."/paypal_cancel_budget?res=cancel");
			    
			    $amount = $budget;
			  
		         /*fetch the amount and membership type name */
		        $amt     = $amount;
			    $maxamt  = $amount;
			    $L_AMT0  = $amount;
			    $L_NAME0 = "Medscanner Advertise Payment";
			    $nvpstr="";
			    $nvpHeader="";
			    /*Build NVP string*/
			    $nvpstr="&L_NAME0=".$L_NAME0."&L_AMT0=".$L_AMT0."&MAXAMT=".(string)$amt."&AMT=".(string)$amt."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL ."&CURRENCYCODE=".$currencyCodeType."&PAYMENTACTION=".$paymentType."&CARTBORDERCOLOR=005c8d";
			    //LOGOIMG....
			    $nvpstr = $nvpHeader.$nvpstr;
			    $resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			    $ack = strtoupper($resArray["ACK"]);

			    if($ack == "SUCCESS")
			    {
			   	    /*Redirect to paypal.com here*/
			     	$token = urldecode($resArray["TOKEN"]);
			   	    $payPalURL = PAYPAL_URL.$token;
			   	    redirect($payPalURL);
			    }
			    else
			    {
			    	$this->session->set_flashdata('error','Error while payment');
			    }	

			}
			else if($payment_type =="credit")
			{

				$this->form_validation->set_rules('card_number','Card Number','required|trim|xss_clean');
				$this->form_validation->set_rules('cvv','Cvv number','required|trim|xss_clean');
				$this->form_validation->set_rules('exp_date','Expiry date','required|trim|xss_clean');
				$this->form_validation->set_rules('holder_name','Holder name','required|trim|xss_clean');
				$this->form_validation->set_rules('card_type','Card Invalid','required|trim|xss_clean');

				$card_number = $this->input->post('card_number');
				$cvv         = $this->input->post('cvv');
				$exp_date    = $this->input->post('exp_date');
				$holder_name = $this->input->post('holder_name');
				$card_type   = $this->input->post('card_type');
				
				if($this->form_validation->run())
	            {

				    if($payment_method == 'automatic')
				    {
				    	$budget_session = array();
				    	$budget_session = array('budget'      => $budget,
												'card_type'	  => $card_type,
											    'card_number' => str_replace(' ', '', $card_number),
											    'cc_exp'      => $exp_date,
											    'cvv'		  => $cvv	
												);
						$this->session->set_userdata('budget_session',$budget_session);
						redirect(base_url().'ads/create_rec_cardPay_budget');

				    }

					$paymentType 		= (paymentType);
					$creditCardType 	= $card_type;
					$creditCardNumber 	= $card_number;
					$creditCardNumber 	= str_replace(' ', '', $creditCardNumber);
					$cc_exp 			= $exp_date;
					$cvv2Number 		= $cvv;
					$amount 			= $budget;
					$cc_exp_arr 		= explode('/', $cc_exp);
					$currencyCode 		= currencyCode;
                    $nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".trim($cc_exp_arr[0]).trim($cc_exp_arr[1])."&CVV2=$cvv2Number&CURRENCYCODE=$currencyCode";
				
				    
					$resArray=$this->callerservice->hash_call("doDirectPayment",$nvpstr);
					
					$ack = strtoupper($resArray["ACK"]);
					if($ack=="SUCCESS")
					{
							$trans_amount=$resArray['AMT'];
							$trans_id=$resArray['TRANSACTIONID'];

			         		$user = $this->master_model->getRecords('users',array('id'=>$user_id));
			         		$this->master_model->updateRecord('users',array('balance_amount'=>$user[0]['balance_amount']+$trans_amount),array('id'=>$user_id));
			         		$trans_data = array('login_id'         => $user_id,
								                'transaction_id'   => $trans_id,
												'amount'           => $trans_amount,
												'type'             => 'credit card',
												'payment_method'   => 'non_recurring',
												'transaction_date' => date('Y-m-d H:i:s')
												);
							$this->master_model->insertRecord('tble_transaction',$trans_data);
							$admin_email = $this->master_model->getRecords('users',array('id'=>12));
			                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
			                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Account budget update successfull','view'=>'user_update_budget');
			                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
			                				   'pay_type'   => 'Credit card',
			                				   'amount'     => $trans_amount,
			                				   'pay_method' => 'Manual'
			                				   );
			              
			                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User update account budget','view'=>'user_update_budget_admin');
			                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
			                					'pay_type'  => 'Credit card',
			                					'amount'    => $trans_amount,
			                					'email'     => $user[0]['email'],
			                					'pay_method' => 'Manual'
			                				    );
			           
			            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
			            	{
			            		$this->session->set_flashdata('success','Your budget updated successfully');
			            	}
			            	else 
			            	{
			            		$this->session->set_flashdata('error','Failed to send mail');
			                }
			                redirect(base_url().'ads/balance');
		                
					}
					else
					{	
						$errorType=$resArray["L_LONGMESSAGE0"];
						$this->session->set_flashdata('error',$errorType);
			  	     	redirect(base_url().'ads/balance');
					}
					//exit();
				}
				else
				{
					$this->session->set_flashdata('error',$this->form_validation->error_string());
				}	
			}
			else
				$this->session->set_flashdata('error',"Something went wrong.");

		}
		else
		{
			$this->session->set_flashdata('error',$this->form_validation->error_string());
		}

	}

	$data['user']    = $user;
	$data['pay_acc'] = $pay_acc;
	$data['scripts'] = array();
	$data['title'] = 'Balance';
	$this->render('edit-budget',$data);  

}



public function paypal_sucess_budget()
{

	if(isset($_REQUEST['res']) && $_REQUEST['res']=="success" && $_REQUEST['token']!="")
	{
		$user_id = $this->session->userdata('user')->id;
		if($user_id == '')
			redirect(base_url());
		$getSess = $this->session->userdata('budget_session');
		$trans_date = date('Y-m-d H:i:s');
		$currencyCodeType=currencyCode; //define in paypal_constant in third_party directory
	    $paymentType=paymentType; //define in paypal_constant in third_party directory

		$nvpHeader 			="";
		$token 				=urlencode($_REQUEST['token']);
		$nvpstr				="&TOKEN=".$token;
		$nvpstr 			= $nvpHeader.$nvpstr;
		$resArray 			=$this->callerservice->hash_call("GetExpressCheckoutDetails",$nvpstr);
		$budget 			= $getSess['budget'];
		
		$ack = strtoupper($resArray["ACK"]);
		if($ack == "SUCCESS" || $ack == 'SUCCESSWITHWARNING')
		{
			$trans_amount       = $resArray['AMT'];
			$nvpstr='&TOKEN='.$_REQUEST['token'].'&PAYERID='.$_REQUEST['PayerID'].'&PAYMENTACTION='.$paymentType.'&AMT='.$trans_amount.'&CURRENCYCODE='.$currencyCodeType;
			$resDoDirect=$this->callerservice->hash_call("DoExpressCheckoutPayment",$nvpstr);
			
         	$trans_id = $resDoDirect['TRANSACTIONID'];
         	
			if($trans_id)
         	{	
         		$user = $this->master_model->getRecords('users',array('id'=>$user_id));
         		$this->master_model->updateRecord('users',array('balance_amount'=>$user[0]['balance_amount']+$trans_amount),array('id'=>$user_id));
         		$trans_data = array('login_id'         => $user_id,
					                'transaction_id'   => $trans_id,
									'amount'           => $trans_amount,
									'type'             => 'paypal',
									'payment_method'   => 'non_recurring',
									'transaction_date' => date('Y-m-d H:i:s')
									);
				$this->master_model->insertRecord('tble_transaction',$trans_data);
				$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Account budget update successfull','view'=>'user_update_budget');
                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                				   'pay_type'   => 'Paypal',
                				   'amount'     => $trans_amount,
                				   'pay_method' => 'Manual'
                				   );
              
                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User update account budget','view'=>'user_update_budget_admin');
                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
                					'pay_type'  => 'Paypal',
                					'amount'    => $trans_amount,
                					'email'     => $user[0]['email'],
                					'pay_method' => 'Manual'
                				    );
           
            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		$this->session->set_flashdata('success','Your budget updated successfully');
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
	redirect(base_url().'ads/balance');
        
}
public function paypal_cancel_budget()
{
	$this->session->set_flashdata('error', "Sorry you cancel your payment request.");
	redirect(base_url().'ads/balance');
}

public function chk_rec_profile_budget()
{
		
		$recurring_start_date =  urlencode(date('Y-m-d')."T0:0:0");
		$user_id = $this->session->userdata('user')->id;		
		$getSess = $this->session->userdata('budget_session');
	    $trans_amount       = $getSess['budget'];
		$environment= environment;
		$this->paypal_recurring_express->environment = $environment;	// or 'beta-sandbox' or 'live'
		$this->paypal_recurring_express->paymentType = paymentType;				// or 'Sale' or 'Order' or 'Authorization'
		// Set request-specific fields.
		$this->paypal_recurring_express->startDate = $recurring_start_date;
		$this->paypal_recurring_express->billingPeriod = urlencode("Month");				// or "Day", "Week", "SemiMonth", "Year","Month"
		$this->paypal_recurring_express->billingFreq = urlencode("1");	
		$this->paypal_recurring_express->billingDes = "Test description";					// combination of this and billingPeriod must be at most a year
		$this->paypal_recurring_express->paymentAmount = number_format(urlencode($trans_amount),2);
		$this->paypal_recurring_express->currencyID = urlencode(currencyCode);							// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
	
		/* PAYPAL API  DETAILS */
		$this->paypal_recurring_express->API_UserName  = API_USERNAME;
		$this->paypal_recurring_express->API_Password  = API_PASSWORD;
		$this->paypal_recurring_express->API_Signature = API_SIGNATURE;
		$this->paypal_recurring_express->API_Endpoint  = API_ENDPOINT;


		/*SET SUCCESS AND FAIL URL*/
		$this->paypal_recurring_express->returnURL = urlencode(base_url()."ads/chk_rec_profile_budget/getExpressCheckout");
		$this->paypal_recurring_express->cancelURL = urlencode(base_url()."ads/paypal_cancel_budget");
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
			    	$this->session->set_flashdata('error', "Sorry error while payment.");
			    	redirect(base_url('ads/balance'));
			    }
			    $profileId = urldecode($result->PROFILEID);
				$trans_id = urldecode($result->CORRELATIONID);
			   	
			    $trans_date = date('Y-m-d H:i:s');
			    $user = $this->master_model->getRecords('users',array('id'=>$user_id));

			    $prev_profile = $this->master_model->getRecords('tble_transaction',array('login_id'=>$user_id,'payment_method'=>'recurring','status'=>'active'));
         		$this->master_model->updateRecord('users',array('balance_amount'=>$user[0]['balance_amount']+$trans_amount),array('id'=>$user_id));
         		$trans_data = array('login_id'         => $user_id,
					                'transaction_id'   => $trans_id,
									'amount'           => $trans_amount,
									'type'             => 'paypal',
									'payment_method'   => 'recurring',
									'profile_id'	   => $profileId,
									'status'		   => 'active',	
									'transaction_date' => date('Y-m-d H:i:s')
									);
				$this->master_model->insertRecord('tble_transaction',$trans_data);

				if(count($prev_profile)>0)
				{
					if($this->cancel_profile($prev_profile[0]['profile_id'],$prev_profile[0]['id']));
				}
				$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Account budget update successfull','view'=>'user_update_budget');
                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                				   'pay_type'   => 'Paypal',
                				   'amount'     => $trans_amount,
                				   'pay_method' => 'Automatic'
                				   );
              
                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User update account budget','view'=>'user_update_budget_admin');
                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
                					'pay_type'  => 'Paypal',
                					'amount'    => $trans_amount,
                					'email'     => $user[0]['email'],
                					'pay_method' => 'Automatic'
                				    );
           
            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		$this->session->set_flashdata('success','Your budget updated successfully');
            		redirect(base_url().'ads/balance');
                }
                redirect(base_url().'ads/balance');

				
			}
			else
			{
				$$this->session->set_flashdata("error","Error while payment.");
				redirect(base_url().'ads/balance');
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


	// Credit card recurring for edit budget

	public function create_rec_cardPay_budget()
	{  	
		if($this->session->userdata('budget_session')!='')
		{
			$recurring_start_date = date('Y-m-d')."T0:0:0";
			$user_id = $this->session->userdata('user')->id;
			if($user_id == '')
				redirect(base_url());
			$getSess = $this->session->userdata('budget_session');
			$cardTypes    = $getSess['card_type'];
			$creditCard   = $getSess['card_number'];
			$cc_exp       = $getSess['cc_exp'];

			$cc_exp_arr   = explode('/', $cc_exp);
		    $expDateMonth = trim($cc_exp_arr[0]);
		    $expDateYear  = trim($cc_exp_arr[1]);
			$expDate    = intval($expDateMonth.$expDateYear);
			$cvv2Number	= intval($getSess['cvv']);
			$start      = $recurring_start_date;
			$desc       = 'Medscanner Advertise Payment';
			$period     = urlencode("Month");
			$freq       = urlencode("1");
			$amt = $getSess['budget'];
			$currency=currencyCode;
			
			$street='';
			$city='';
			$state='';
			$code='';
			$zip='';
			$email=$getSess['email'];
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
			    $trans_amount       = $amt;
				
				$user = $this->master_model->getRecords('users',array('id'=>$user_id));

			    $prev_profile = $this->master_model->getRecords('tble_transaction',array('login_id'=>$user_id,'payment_method'=>'recurring','status'=>'active'));
         		$this->master_model->updateRecord('users',array('balance_amount'=>$user[0]['balance_amount']+$trans_amount),array('id'=>$user_id));

	    		$trans_data = array('login_id'       => $user_id,
									'transaction_id' => $trans_id,
									'amount'         => $trans_amount,
									'type'           => 'credit card',
									'payment_method' => 'recurring',
									'transaction_date'=> date('Y-m-d H:i:s'),
									'status'		  => 'active',
									'profile_id'	  => $profileId	
									);
				$user_transaction_id = $this->master_model->insertRecord('tble_transaction',$trans_data,TRUE);
                
				if(count($prev_profile)>0)
				{
					if($this->cancel_profile($prev_profile[0]['profile_id'],$prev_profile[0]['id']));
				}
				$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$user[0]['email'],'subject'=>'Account budget update successfull','view'=>'user_update_budget');
                $other_arr = array('user_name'  => $user[0]['firstname']." ".$user[0]['lastname'],
                				   'pay_type'   => 'Credit Card',
                				   'amount'     => $trans_amount,
                				   'pay_method' => 'Automatic'
                				   );
              
                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'User update account budget','view'=>'user_update_budget_admin');
                $other_arr1 = array('user_name' => $user[0]['firstname']." ".$user[0]['lastname'],
                					'pay_type'  => 'Credit Card',
                					'amount'    => $trans_amount,
                					'email'     => $user[0]['email'],
                					'pay_method' => 'Automatic'
                				    );
           
            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		$this->session->set_flashdata('success','Your budget updated successfully');
            		redirect(base_url().'ads/balance');
                }
            	else 
            	{
            		$this->session->set_flashdata('error','Failed to send mail !!!');
                	redirect(base_url().'ads/business');
            	}
       
		}
		if($profile['ACK']!="Success")
		{
			$this->session->set_flashdata("error",'Invalid card information provided.');
			redirect(base_url().'ads/balance');	
		}
	}



public function cancel_profile($profile_id,$trans_id)
{
	require_once('PayPal.class.php');
	$username=API_USERNAME;
	$password=API_PASSWORD;
	$signature=API_SIGNATURE;
	$paypal = new PayPal('SANDBOX', $username, $password, $signature);
	//$this->db->group_by('profileId');
	
    $profileID= $profile_id;
    //$profileID = "I-1UW3UWA7N4PL";
	$action='Cancel';
	$nvpStr="&PROFILEID=$profileID&ACTION=$action";
	/* Make the API call to PayPal, using API signature.
	The API response is stored in an associative array called $resArray */
	$resArray=$this->callerservice->hash_call("ManageRecurringPaymentsProfileStatus",$nvpStr);

	if($resArray == TRUE)
	{
		$this->master_model->updateRecord('tble_transaction',array('status'=>'cancelled'),array('id'=>$trans_id));
		//$this->session->set_flashdata('success',"Your automatic payment cancelled successfully.");
		return true;
	}
	else
		return false;


}


//   Split Budget between examination

public function split_budget()
{
//	$data['user']    = $user;
	$user_id = $this->session->userdata('user')->id;
	if($user_id == '')
	redirect(base_url());
	$this->db->join('users','users.id = tblexamination.owner_id');
	$this->db->join('tbl_ads_users','tbl_ads_users.examination_id = tblexamination.id');
	$examination = $this->master_model->getRecords('tblexamination',array('tblexamination.owner_id'=>$user_id));
	$data['examination']   = $examination;
	$this->db->join('tbl_ads_users','tbl_ads_users.login_id=users.id');
	$data['balance']   = $this->master_model->getRecords('users',array('users.id'=>$user_id),'balance_amount,SUM(budget_amount) as budget_amount');
	$data['scripts'] = array();
	if(isset($_POST['btnUpdate']))
	{
		for($i=0;$i<count($_POST['allocated_amt']);$i++)
		{
			$up_arr=array('remianing_amount'=>$_POST['remianing_amount'][$i],'budget_amount'=>$_POST['allocated_amt'][$i]);
			$this->master_model->updateRecord('tbl_ads_users',$up_arr,array('id'=>$_POST['ad_id'][$i]));
		}
		$this->session->userdata('success','Budget updated successfully');
		redirect(base_url().'ads/split_budget/');
	}
	$data['title'] = 'Split Budget';
	$this->render('split-budget',$data);  

}



public function getProfile($profile_id)
{
	require_once('PayPal.class.php');
	$username=API_USERNAME;
	$password=API_PASSWORD;
	$signature=API_SIGNATURE;
	$paypal = new PayPal('SANDBOX', $username, $password, $signature);
	
    //$profileID=$transaction[0]['profile_id'];
     $profileID = $profile_id;
     $profile = $paypal->getRecurringPaymentsProfileDetails($profileID);
     echo "<pre>";
			print_r($profile);
			exit();
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>
