<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
		$this->config->load('facebook');
		$this->load->model('email_sending');
		$this->load->library('Facebook', array('appId' => '179666462437270', 'secret' => '123368e0b1e47ea1b885213ce2ba8d78'));
		$this->gp_logout_url = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=";

	}
	public function index()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == '')
		{
			redirect(base_url());
		}

		$limit = 10;
		$hospital_id = $this->input->get('q') ? $this->input->get('q') :0;
        if($hospital_id != '')
        {
            $this->db->where('(tblstructure.hospital like"'.$hospital_id.'")');
        }
		$hospital_info	= $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id,'status'=>'1'));
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
		$config['per_page'] = $limit;
		$config['base_url'] = base_url(). 'dashboard/index/';
		$config['uri_segment'] = 3;	
		$config['total_rows'] =  count($hospital_info); // Total results only.
		
		$this->pagination->initialize($config);
		$offset = $this->uri->segment(3)?$this->uri->segment(3):0;
		$query.=" LIMIT ".$offset.', '.$config["per_page"];
	    $result = $this->db->query($query);
	    $hospital_info = $result->result_array();
	    $links=$this->pagination->create_links();
		$data['structures'] = $hospital_info;
		$data['pagination_links'] = $links;
		$data['menu'] = 'hospital';
		if($this->input->is_ajax_request())
		{
			echo json_encode($data);
		}
		else 
		{
			$data['scripts'] = array();
			$this->data['title']="Home";
			$this->render('user-dashboard',$data);	
		}
		
	}

	public function updatebillingdetails()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == '')
		{
			redirect(base_url());
		}

		if(isset($_POST['btn_update_billing_details']))
		{

			$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
           // $this->form_validation->set_rules('business_name', 'Business Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'trim|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('bill_address', 'address', 'trim|required|xss_clean');
            
            if($this->form_validation->run())
            {
                $country          = $this->input->post('country');
                $business_name    = $this->input->post('business_name');
                $state            = $this->input->post('state');
                $city             = $this->input->post('city');
                $postal_code      = $this->input->post('postal_code');
                $bill_address     = $this->input->post('bill_address');
                $update_array     = array(	'country'    	 => $country,
											'state' 		 => $state,
											'city' 	 		 => $city,
											'postal_code' 	 => $postal_code,
											'address' 	     => $bill_address
										 );
	              	
				if($this->master_model->updateRecord('tble_user_billing_details',$update_array,array('login_id'=>$user_id)))
				{
					$this->session->set_flashdata('success','Billing details updated successfully.');
					redirect(base_url().'dashboard/updatebillingdetails/');
				}
				else
				{
					$this->session->set_flashdata('error','Error while updating billing details.');
					redirect(base_url().'dashboard/updatebillingdetails/');
				}
            }
            else
            {
            	$data['error']=$this->form_validation->error_string();
            }
		}


		$data['billing_info'] = $this->master_model->getRecords('tble_user_billing_details',array('login_id'=>$user_id));
		//echo"<pre>"; print_r($data['billing_info']); exit();
		$data['countries'] = $this->master_model->getRecords('countries');
		$data['scripts'] = array();
		$data['menu'] = 'billing';
		$this->data['title']="Billing Details Update";
		$this->render('billing-details-update',$data);	
	}

	public function fb_login()
	{
		$user_email = $this->input->post('email');
		$first_name = $this->input->post('fname');
		$last_name = $this->input->post('lname');
		$user = $this->input->post('user');
		$userid 	= $this->input->post('userid');
		if($user_email != ''&& $user_email != 'undefined')
		{
			$email = $user_email;
		}
		else 
		{
			$email = '';
		}
		if($email != '')
		{
			$user_cnt = $this->master_model->getRecordCount('users',array('email'=>$user_email,'status <>'=>'3'));	
		}
		else if($email == '')
		{
			$user_cnt = $this->master_model->getRecordCount('users',array('fb_id'=>$userid,'status <>'=>'3'));
		}
		
		//echo $this->db->last_query();
		$logout_url = $this->facebook->getLogoutUrl(array('next' => base_url() . 'home/disconnessione/'));
		/*User Does not exists  and register user on website*/
		/*echo $user_cnt;
		exit();*/
		if($user_cnt == 0)
	   {
			/*$reg_arr = array('email'=>$email,'register_type'=>'fb','userid'=>$userid,'logout_url'=>$logout_url);
			$this->session->set_userdata('reg_arr',$reg_arr);*/
			$resp['result'] 	= 'success';
			$resp['message'] 	= 'success';
			$resp['logout_url'] = $logout_url;

			 $data = array(
            'firstname'  => $first_name,
            'lastname'   => $last_name,
            'role'       => 3,
            'email'      => $email,
            'is_approved' => "1",
            'status'	  => '1',
            'fb_id'   => $userid
            );
            $last_id = $this->master_model->insertRecord('users',$data,TRUE);
            if($last_id)
            {
	           	$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                if($email != '')
                {
	                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$email,'subject'=>'Registration successfull on Medscanner','view'=>'normal_user_registration');
	                $other_arr = array('user_name'  => $first_name." ".$lastname,
	                				   'email'      => $email,
	                				   'type'       => 'fb'
	                				   );
	            }
                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New normal user registered ','view'=>'admin_normal_user_registration');
                $other_arr1 = array('user_name' => $first_name." ".$last_name,
                					'email'     => $email,
                					'gender'	=> "",
                					'dob'		=> "",
                					'role'		=> "Normal",
                					'type'		=> 'fb'	
								);
              
            	if($this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		if($email != '')
            		{
            			$this->email_sending->sendmail($info_arr,$other_arr);
            		}
            		
            		$data = array('id' => $last_id);
			        $res =$this->umod->get_login($data);
			        $this->session->set_userdata('user',$res);
            		$reg_arr = array('email'=>$email,'register_type'=>'fb','userid'=>$userid,'logout_url'=>$logout_url);
            		$this->session->set_userdata('logout_url',$logout_url);
                    $this->session->set_userdata('reg_arr',$reg_arr);
            		$resp['result'] 	= 'success';
					$resp['message'] 	= 'Si sono registrati con successo';
					$this->session->set_flashdata('success','Si sono registrati con successo');
					
                }
         
            }
            else
            {
            	$resp['result'] 	= 'registration_error';
				$resp['message'] 	= 'Oops! Errore. Per favore riprova più tardi';
				
            }
		}
		else 
		{
			if($email != '')
			{
				$data =array('email'=>$email);
				$this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
		        $this->db->where('email',$data['email']);
		        $user =  $this->db->get('users')->row();
		        
			}
			else 
			{
				$data =array('email'=>$email);
				$this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
		        $this->db->where('fb_id',$userid);
		        $user =  $this->db->get('users')->row();
		        
			}
			
			if(count($user)>0)
			{
				
				if($user->status == '0')
				{
					$resp['result'] = 'error';
					$resp['message'] = 'Oooppss!! Your email is not confirmed yet.';
				}
				
				else 
				{
					$this->session->set_userdata('user',$user);
					$this->session->set_userdata('logout_url',$logout_url);
					//echo '<pre>';print_r($this->session->all_userdata());
					$resp['result'] = 'login_success';
					$resp['message'] = 'Login Successfull';
					$resp['logout_url'] = $logout_url;
				}
			}
			else 
			{
				$resp['error'] = 'error';
				$resp['message'] = 'User Not Found';
			}
			
		}
		echo json_encode($resp);exit;
	}

	/*Google  Login*/
	public function gplogin()
	{
		$email = $this->input->post('email');
		$first_name = $this->input->post('name');
		$user = $this->input->post('user');
		$userid = $this->input->post('userid');
		if($first_name != '')
		{
			$user_name = explode(' ',$first_name);
			$first_name = $user_name[0];
			$last_name = $user_name[1];	
		}
		else 
		{
			$first_name = '';
			$last_name = '';
		}
		$rec_cnt = $this->master_model->getRecordCount('users',array('email'=>$email,'status <>'=>'3'));	
		if($rec_cnt == 0)
		{
			$reg_arr = array('email'=>$email,'register_type'=>'google','userid'=>$userid,'logout_url'=>$this->gp_logout_url.base_url().'home/disconnessione');
			$this->session->set_userdata('reg_arr',$reg_arr);
			 $data = array(
            'firstname'  => $first_name,
            'lastname'   => $last_name,
            'role'       => 3,
            'email'      => $email,
            'is_approved' => "1",
            'status'	  => '1',
            'fb_id'       => $userid
            );
            $last_id = $this->master_model->insertRecord('users',$data,TRUE);
            if($last_id)
            {
	           	$admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                if($email != '')
                {
	                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$email,'subject'=>'Registration successfull on Medscanner','view'=>'normal_user_registration');
	                $other_arr = array('user_name'  => $first_name." ".$lastname,
	                				   'email'      => $email,
	                				   'type'       => 'gp'
	                				   );
	            }
                $info_arr1 = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'New normal user registered ','view'=>'admin_normal_user_registration');
                $other_arr1 = array('user_name' => $first_name." ".$last_name,
                					'email'     => $email,
                					'gender'	=> "",
                					'dob'		=> "",
                					'role'		=> "Normal",
                					'type'		=> 'gp'
								);
              
            	if($this->email_sending->sendmail($info_arr1,$other_arr1))
            	{
            		if($email != '')
            		{
            			$this->email_sending->sendmail($info_arr,$other_arr);
            		}
            		
            		$data = array('id' => $last_id);
			        $res =$this->umod->get_login($data);
			        $this->session->set_userdata('user',$res);
            		$reg_arr = array('email'=>$email,'register_type'=>'gp','userid'=>$userid,'logout_url'=>$logout_url);
            		$this->session->set_userdata('logout_url',$logout_url);
                    $this->session->set_userdata('reg_arr',$reg_arr);
            		$resp['result'] 	= 'success';
					$resp['message'] 	= 'Si sono registrati con successo';
					$this->session->set_flashdata('success','Si sono registrati con successo');
					
                }
         
            }
            else
            {
            	$resp['result'] 	= 'registration_error';
				$resp['message'] 	= 'Oops! Errore. Per favore riprova più tardi';
				
            }


		}
		else 
		{
			$data =array('email'=>$email);
			$this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
	        $this->db->where('email',$email);
	        $user =  $this->db->get('users')->row();
			if(count($user) > 0)
			{
				if($user->status == '0')
				{
					$resp['result'] = 'error';
					$resp['message'] = 'Oooppss!! Your email is not confirmed yet.';
				}
				
				else 
				{
					$this->session->set_userdata('user',$user);
					$this->session->set_userdata('logout_url',$this->gp_logout_url.base_url().'home/disconnessione');
					$resp['result'] = 'login';
					$resp['message'] = 'Login Successfull';
					$resp['logout_url'] = $this->gp_logout_url.base_url().'home/disconnessione';
				}
				
			}
			else 
			{
				$resp['error'] = 'error';
				$resp['message'] = 'User Not Found';
			}
		}
		echo str_replace('\/','/',json_encode($resp));
	}

	
} 
?>