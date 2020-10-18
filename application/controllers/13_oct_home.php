<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

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
		$this->load->model('callerservice');
		$this->load->model('users_model','umod');
        $this->load->model('exam_model','emod');
		$this->load->library('pagination');
		$this->load->model('master_model');
		$this->config->load('facebook');
		$this->load->model('email_sending');
		$this->load->library('Facebook', array('appId' => '179666462437270', 'secret' => '123368e0b1e47ea1b885213ce2ba8d78'));
		$this->load->library('form_validation');
		//$this->load->library('Facebook', array('appId' => '179666462437270', 'secret' => '123368e0b1e47ea1b885213ce2ba8d78'));
	}

	public function index()
	{
		
		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Home";

		$this->render('home/home-view',$data);
	}
    public function limitare()
	{

		$data = array();
		$data['scripts'] = array();
		$this->data['title']="Limitare";

		$this->render('limitare-view',$data);
	}

	public function search_map(){

		 $data['actual_link'] = str_replace('map-search', 'search', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		$this->data['title']="Search Map";
		$this->load->view('home/map-search-view',$data);
	}
	public function get_json_addresses(){
		$res =$this->smod->get_structure_for_map();
	
		foreach ($res as $key => $row) {
			
			$res[$key]->exams=$this->smod->get_structure_exam_for_map($row->id);
		}
		
		echo json_encode($res);
	}
	public function search()
	{

		$data = array();

		$limit = 5;
		$offset = ($this->uri->segment(3) ? ($this->uri->segment(3) - 1) * $limit : 0);

		
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
		$config['base_url'] = base_url(). 'search/page/';
		$config['uri_segment'] = 3;	
		$config['use_page_numbers'] = TRUE;		
		$config['total_rows'] =  $this->smod->get_structure_exam($limit, $offset,'total_results'); // Total results only.

		
		$this->pagination->initialize($config);
		$structure  = $this->smod->get_structure_exam($limit, $offset);
		$data['structures'] = $structure;
	
		$data['pagination_links'] = $this->pagination->create_links();
		$data['total_rows']= $config['total_rows'];
		$data['actual_link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if($this->session->userdata('impression_ids')==null)
			{
				$impression_ids = array();
				$this->session->set_userdata('impression_ids',$impression_ids);
			}
			
			$impression_ids = $this->session->userdata('impression_ids');
			if($offset == 0)
				$i = 1;
			else
				$i = (($offset-1)*$limit); 
			foreach ($structure as $hosp) 
			{
				$getAdd = $this->master_model->getRecords('tbl_ads_users',array('examination_id'=>$hosp->exam_id));

				if(count($getAdd)>0)
				{
					if(!in_array($hosp->exam_id, $impression_ids))
					{	
						array_push($impression_ids,$hosp->exam_id);
						$this->master_model->updateRecord('tbl_ads_users',array('impresion'=>$getAdd[0]['impresion']+1,'ad_rank'=>$i),array('examination_id'=>$hosp->exam_id));
					}
				}
				$i++;
			}



		
		if($this->input->is_ajax_request()){
			echo json_encode($data);
		}
		else
		{
			$this->data['title']="Search";
            $data['common_name'] =$this->input->get('common_name') ? $this->input->get('common_name') :'';
          
            $data['common_names'] =  $this->emod->get_exam_common_name();
			$data['scripts'] = array('search-hospital.js');
			
			
			$this->session->set_userdata('impression_ids',$impression_ids);

			if($this->session->userdata('click_exam_ids')==null)
			{	$click_exam_ids =array();
				$this->session->set_userdata('click_exam_ids',$click_exam_ids);
			}

			
			
			$this->render('home/search-results-view',$data);
		}
		
	}
	public function hospitals($id)
	{

		$data = array();
		$data['structure'] = $this->smod->get_data_by_id('tblstructure',$id);
		$data['exam'] = $this->smod->get_data_by_id('tblexamination',$this->input->get('exam_id'));
        $data['reviews'] = $this->emod->get_hospital_exam_review($id,$this->input->get('exam_id'));
		$this->data['title']="Hospital";
		$data['scripts'] = array('hospitals.js');

		$exam_id = $this->input->get('exam_id');
				  $this->db->join('users','users.id = tbl_ads_users.login_id');
		$getAds = $this->master_model->getRecords('tbl_ads_users',array('examination_id'=>$this->input->get('exam_id')));
		
		
		$number_of_clicks =1;	 
		$price = $getAds[0]['clicks_price'];
		
		if(count($getAds)>0)
		{
			
			if($this->session->userdata('click_exam_ids')==null)
			{	
				$click_exam_ids =array($exam_id);
				$this->session->set_userdata('click_exam_ids',$click_exam_ids);

				$up_arr = array('clicks'          => $getAds[0]['clicks']+1,
								'clicks_amount'   => $getAds[0]['clicks_amount']+$price,
								'number_of_click' => $getAds[0]['number_of_click']+$number_of_clicks,
								'remianing_amount' => $getAds[0]['remianing_amount']-$price,
								'used_amount' 	  => $getAds[0]['used_amount']+$price);
				$this->master_model->updateRecord('tbl_ads_users',$up_arr,array('examination_id'=>$this->input->get('exam_id')));

				$up_bal = array('balance_amount'=>($getAds[0]['balance_amount']-$price));
				$this->master_model->updateRecord('users',$up_bal,array('id'=>$getAds[0]['id']));
				$getdatewise = $this->master_model->getRecords('tbl_click_datewise',array('exam_id'=>$this->input->get('exam_id'),'date'=>date('Y-m-d')));
				if(count($getdatewise)>0)
					$this->master_model->updateRecord('tbl_click_datewise',array('click_count'=>$getdatewise[0]['click_count']+1),array('id'=>$getdatewise[0]['id']));
				else
					$this->master_model->insertRecord('tbl_click_datewise',array('date'=>date('Y-m-d'),'click_count'=>'1','exam_id'=>$exam_id));
			}
			else
			{
				$click_exam_ids = $this->session->userdata('click_exam_ids');

				if(!in_array($exam_id,$click_exam_ids))
				{
					$up_arr = array('clicks'          => $getAds[0]['clicks']+1,
						            'clicks_amount'   => $getAds[0]['clicks_amount']+$price,
						            'number_of_click' => $getAds[0]['number_of_click']+$number_of_clicks,
						            'remianing_amount' => $getAds[0]['remianing_amount']-$price,
						            'used_amount' 	   => $getAds[0]['used_amount']+$price
						            );

					$this->master_model->updateRecord('tbl_ads_users',$up_arr,array('examination_id'=>$this->input->get('exam_id')));
					array_push($click_exam_ids,$exam_id);
					$this->session->set_userdata('click_exam_ids',$click_exam_ids);
					$up_bal = array('balance_amount'=>($getAds[0]['balance_amount']-$price));
					$this->master_model->updateRecord('users',$up_bal,array('id'=>$getAds[0]['id']));
					
					
					$getdatewise = $this->master_model->getRecords('tbl_click_datewise',array('exam_id'=>$this->input->get('exam_id'),'date'=>date('Y-m-d')));
					if(count($getdatewise)>0)
						$this->master_model->updateRecord('tbl_click_datewise',array('click_count'=>$getdatewise[0]['click_count']+1),array('id'=>$getdatewise[0]['id']));
					else
						$this->master_model->insertRecord('tbl_click_datewise',array('date'=>date('Y-m-d'),'click_count'=>'1','exam_id'=>$exam_id));
			    }
			}

		}

		
		$this->render('home/hospitals-view',$data);
	}
	function verify($hash=NULL)
    {/*
    	echo "here";
    	exit();*/
        if ($this->umod->verifyEmailID($hash))
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Il tuo indirizzo e-mail è stato verificato con successo ! Effettua il login per accedere al tuo account</div>');
            redirect(base_url().'registration');
        }
        else
        {
            $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Scusate! Ci è errore di verificare il tuo indirizzo email!</div>');
           redirect(base_url().'registration');
        }
    }
	public function registration()
	{
	   	$this->load->library(array( 'form_validation'));
		$this->form_validation->set_rules('firstname', 'Nome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Cognome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]|md5');
        $this->form_validation->set_rules('conf_password', 'Ripeti la password', 'trim|required');
        $this->form_validation->set_rules('dob', 'Data di nascita', 'trim|required');
        
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
			$this->data['title']="Registration";
			$data['scripts'] = array();
			$this->render('registration-view',$data);
          
        }
        else
        {
            $data = array(
                'firstname'  => $this->input->post('firstname'),
                'lastname'   => $this->input->post('lastname'),
                'middlename' => $this->input->post('middlename'),
                'role'       => 3,
                'email'      => $this->input->post('email'),
                'password'   => $this->input->post('password'),
                'dob'        => date('Y-m-d',strtotime($this->input->post('dob'))),
                'gender'     => $this->input->post('gender')
            );
            $last_id = $this->master_model->insertRecord('users',$data,TRUE);
            //$this->umod->insertUser($data)
            if ($last_id)
            {
                
	           	$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$this->input->post('email'),'subject'=>'Registration successfull on Medscanner','view'=>'normal_user_registration');
                $other_arr = array('user_name'  => $this->input->post('firstname')." ".$this->input->post('lastname'),
                				   'email'      => $this->input->post('email'),
                				   'type'	 	=> 'normal'
                				   );
              	//echo $admin_email[0]['email'];

                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New normal user registered ','view'=>'admin_normal_user_registration');
                $other_arr1 = array('user_name' => $this->input->post('firstname')." ".$this->input->post('lastname'),
                					'email'     => $this->input->post('email'),
                					'gender'	=> $this->input->post('gender'),
                					'dob'		=> $this->input->post('dob'),
                					'role'		=> "Normal",
                					'type'		=> 'normal'
								);
               /*	 print_r($info_arr1);
                exit();*/
           
            	if($this->email_sending->sendmail($info_arr,$other_arr) && $this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		$this->session->set_flashdata('success','Si sono registrati con successo ! Si prega di confermare la mail inviata al vostro email - ID');
            		redirect(base_url().'registration');
                }
            	else 
            	{
            		$this->session->set_flashdata('error','Impossibile inviare e-mail di conferma');
            		redirect(base_url().'registration');
                }
       
            }
            else
            {
               $this->session->set_flashdata('error','Oops! Errore. Per favore riprova più tardi');
               redirect(base_url().'registration');
            }
        }
	}
	public function disconnessione(){
		session_destroy();
		$this->facebook->destroySession();
		$this->session->sess_destroy();
		redirect(base_url('accesso'));
	}
	public function resettalapassword(){
		$this->load->library(array( 'form_validation'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
				
		if ($this->form_validation->run() == FALSE) {
			 	echo '<div class="alert alert-danger text-center">Inserisci l\'indirizzo email</div>';
		} else {
			$email=$this->input->post('email');
			$res =$this->umod->getUserByEmail($email);
			if(!empty($res))
			{
				$token =random_characters(15);
				$this->umod->addUserResetToken($res->email,$token);
				$info_mail = $this->master_model->getRecords('users',array('id'=>12));
				$info_arr = array('from'=>$info_mail[0]['email'],'to'=>$email,'subject'=>'Forgot Password','view'=>'forgot-password-view');
				$other_arr = array('email'=>$email,'token'=>$token);
				if($this->email_sending->sendmail($info_arr,$other_arr))
				{
					echo'<div class="alert alert-success text-center">Si prega di controllare la posta elettronica per il link di reset ...</div>';	
				}
				//$this->umod->sendResetToken($res->email,$token);
			}
			else
			{
				echo '<div class="alert alert-danger text-center">E-mail non valido</div>';
				
			}
			
		}
	}
	public function new_password($token){
		$res = $this->umod->getUserByResetToken($token);
		if(!empty($res)){
			$this->load->library(array( 'form_validation'));
		    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[conf_password]|md5');
	        $this->form_validation->set_rules('conf_password', 'Ripeti la password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				 	$data = array();
					$this->data['title']="Create New Password";
					$data['scripts'] = array();
					if(!empty($_POST)){
						$data['err_msg'] ='<div class="alert alert-danger text-center">Oops! Errore. La password non corrisponde !!!</div>';
					}else{
						$data['err_msg'] ='';
					}
					
					$this->render('create-new-pass-view',$data);
			} else {

				
				  $this->umod->changePassword(array('password'=>($this->input->post('password')),'reset_pass_token'=>''),$res->id);
				  $this->session->set_flashdata('msg','<div class="alert alert-success text-center">CAMBIO PASSWORD successo</div>');
				  redirect(base_url().'accesso');
				
			}
		}
		else
		{
			  $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Errore. invalid token / Reset di token password è scaduta / !!!</div>');
				redirect(base_url().'accesso');
			
		}
	}

	public function myaccount()
	{
		$id 		= $this->session->userdata('user')->id;
		if($id =="")
		{
			redirect(base_url());
		}
		
	   	if(isset($_POST['btn_myaccount']))
	   	{	//echo "<pre>"; print_r($_POST); exit();
		   	$this->form_validation->set_rules('firstname', 'Nome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
	        $this->form_validation->set_rules('lastname', 'Cognome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
	        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
	        $this->form_validation->set_rules('dob', 'Data di nascita', 'trim|required');
	        $this->form_validation->set_rules('gender', 'gender', 'trim|required');
	    
	         //validate form input
	        if ($this->form_validation->run())
	        {
	        	$info = $this->master_model->getRecords('users',array('id'=>$id));
	        	if((isset($info)) && (count($info)>0))
	        	{
	        		
	        			$role = $info[0]['role']; 
	        		//}
	        	}
	            //insert the user registration details into database 
	           	$data = array(
				                'firstname' => $this->input->post('firstname'),
				                'lastname' => $this->input->post('lastname'),
				                'role'=>$role,
				                'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
				                'gender' => $this->input->post('gender'),
				                'email'=> $this->input->post('email')
	            			);
	            
	            // insert form data into database
	            if ($this->master_model->updateRecord('users',$data,array('id'=>$id)))
	            {
	                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Utente vengono aggiornare con successo !!!</div>');
	                redirect(base_url().'myaccount');
	            }
	            else
	            {
	                // error
	                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Errore. Per favore riprova più tardi!!!</div>');
	                redirect(base_url().'myaccount');
	            }
	        }
	        else
	        {
	        	
	          $data['error'] = $this->form_validation->error_string();         
	          
	        }

	    }  
        $data = array();
        $data['user_info'] = $this->master_model->getRecords('users',array('id'=>$id));
		$this->data['title']="Edit User";
		$data['scripts'] = array();
		$data['menu'] = 'myaccount';
		$this->render('my-account-view',$data);
	
	}
	public function accesso(){
		$this->load->library(array( 'form_validation'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			 	$data = array();
				$this->data['title']="Accesso";
				$data['scripts'] = array('login.js');
				$data['err_msg'] ='';
				$this->render('accesso-view',$data);
		} else {
			$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
			);
			$res =$this->umod->check_login($data);
			//echo "<pre>";
			/*print_r($res);
			exit();*/
			if(!empty($res)){
				
				if($res->is_approved==0){
					 $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Questo account è in attesa di approvazione da admin .</div>');
				  redirect(base_url().'accesso');
				}elseif ($res->status==0 || $res->status==null) {
					 $this->umod->sendEmail($this->input->post('email'));
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">E-mail non è ancora confermare , Si prega di confermare la mail inviata al vostro email - ID !!!</div>');
				  	redirect(base_url().'accesso');
				}elseif ($res->status==3) {
					 $this->umod->sendEmail($this->input->post('email'));
					$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Conto Respinto / eliminato da admin !!!</div>');
				  	redirect(base_url().'accesso');
				}
				else{
					$this->session->set_userdata('user',$res);
					if($res->role==1){
						redirect(base_url().'admin');
					}
					else if($res->role==2)
					{
						redirect(base_url().'ads/dashboard');
					}
					else
					{
						redirect(base_url().'myaccount');
					}
				}
			
				
			}else{
				$data = array();
				$this->data['title']="Accesso";
				$data['scripts'] = array('login.js');
				$data['err_msg'] ='<div class="alert alert-danger text-center">Non valido Email / Password</div>';
				$this->render('accesso-view',$data);
			}
			
		}
	}

	public function facebook(){
		//$fb_config= array('appId'=>'1005959409500854','secret'=>'3348e95101d30d6eb4a5a1ada4d2ea93');
		$fb_config= array('appId'=>'390046357700544','secret'=>'50adbaa0e212f6691f55c4488cc2d329');
		
		$this->load->library('facebook',$fb_config);
		$user =$this->facebook->getUser();
		if ($user) {
		  try {
		    // Proceed knowing you have a logged in user who's authenticated.
		    $user_profile = $this->facebook->api('/me');
		    pr($user_profile);
		  } catch (FacebookApiException $e) {
		    error_log($e);
		    $user = null;
		  }
		}

		if ($user) {
		  echo  $this->facebook->getLogoutUrl();
		} else {
		  echo  $this->facebook->getLoginUrl();
		}


	}
    public  function submit_review(){
        $post =$this->input->post();

       echo $this->emod->save_review($post);
    }
   
    public function first_campaign()
	{
		$data = array();
		$data['scripts'] = array('hospitals.js');
		$this->data['title']="First Campaign";
		$this->render('first-campaign',$data);
	}

	public function changepassword()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == '')
		{
			redirect(base_url());
		}
		$user = $this->master_model->getRecords('users',array('id'=>$user_id,'status'=>1,'is_approved'=>1));
		if(count($user)<=0)
			redirect(base_url());
		$flag =0;

		if(isset($_POST['btn_update_password']))
		{
			$recovery_info	=	$this->master_model->getRecords('users',array('id'=>$user_id));

			if(isset($recovery_info) && (count($recovery_info)>0))
			{
				$password	=	$recovery_info[0]['password'];
			}
			if($recovery_info[0]['password']!='')
			{
				$flag =1;
			  $this->form_validation->set_rules('currentpassword','Old Password','xss_clean|trim|required');
			}
			$this->form_validation->set_rules('newpassword','New Password','xss_clean|trim|required');
			$this->form_validation->set_rules('confirmpassword','Confirm Password','xss_clean|trim|required');

			if($this->form_validation->run())
			{
				$old_password		=	$this->input->post('currentpassword');
				$new_password		=	$this->input->post('newpassword');
				$confirm_password	=	$this->input->post('confirmpassword');
				
				if($password==md5($old_password) || $flag == 0)
				{
					$res=$this->master_model->updateRecord('users', array('password'=>md5($new_password)), array('id'=>$user_id));
					if($res)
					{
						$this->session->set_flashdata('success','Password updated successfully!');
						redirect(base_url()."home/changepassword");
					}
					else
					{
						$this->session->set_flashdata('error','Error while updating password.');
						redirect(base_url()."home/changepassword");
					}
				}
				else
				{
					$this->session->set_flashdata('error','Old password not match!');
					redirect(base_url()."home/changepassword");				
				}		
			}
			else
			{
				$data['error']=$this->form_validation->error_string();
			}
		}
		
		/*echo "<pre>";
		print_r($user);
		exit();*/
		$data['user'] = $user;
		$data['scripts'] = array();
		$data['menu'] = 'password';
		$this->data['title']="Change Password ";
		$this->render('change-password',$data);
	}

	/*Function For Contact Us*/
	/*public function contactus()
	{
		if(isset($_POST['btn_contact_us']))
		{
			$this->form_validation->set_rules('name','Name','required|trim');
			$this->form_validation->set_rules('email','Email','required|valid_email|trim');
			$this->form_validation->set_rules('mobile_num','Mobile Number','required');
			$this->form_validation->set_rules('message','Message','required');
			if($this->form_validation->run())
			{
				$name 		= $this->input->post('name');
				$email 		= $this->input->post('email');
				$mobile_num	= $this->input->post('mobile_num');
				$message 	= $this->input->post('message');
				$insert_arr = array('name');
			}
			else 
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
			}

		}
		$data['contact_info'] = $this->master_model->getRecords('tbl_email_master');
		$data['admin_info']   = $this->master_model->getRecords('users',array('id'=>12));
		$data['scripts'] = array();
		$data['title'] = 'Contact Us';
		$this->render('contact-us',$data);
	}*/






	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>