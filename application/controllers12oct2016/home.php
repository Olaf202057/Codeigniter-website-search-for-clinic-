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
		 $this->load->model('users_model','umod');
        $this->load->model('exam_model','emod');
		$this->load->library('pagination');
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

		$limit = 20;
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
		$data['structures'] = $this->smod->get_structure_exam($limit, $offset);

		$data['pagination_links'] = $this->pagination->create_links();
		$data['total_rows']= $config['total_rows'];
		$data['actual_link'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		if($this->input->is_ajax_request()){
			echo json_encode($data);
		}else{
			$this->data['title']="Search";
            $data['common_name'] =$this->input->get('common_name') ? $this->input->get('common_name') :'';
            $data['common_names'] =  $this->emod->get_exam_common_name();
			$data['scripts'] = array('search-hospital.js');
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
		$this->render('home/hospitals-view',$data);
	}
	function verify($hash=NULL)
    {
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
	public function registration(){
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
            //insert the user registration details into database
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'middlename' => $this->input->post('middlename'),
                'role'=>2,
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'dob' => strtotime($this->input->post('dob')),
                'gender' => $this->input->post('gender')
            );
            
            // insert form data into database
            if ($this->umod->insertUser($data))
            {
                // send email
        
                if ( $this->umod->sendEmail($this->input->post('email')))
                {
                    // successfully sent mail
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Si sono registrati con successo ! Si prega di confermare la mail inviata al vostro email - ID !!!</div>');
                    redirect(base_url().'registration');
                }
                else
                {
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Impossibile inviare e-mail di conferma</div>');
                     redirect(base_url().'registration');
                }
            }
            else
            {
                // error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Errore. Per favore riprova più tardi!!!</div>');
                 redirect(base_url().'registration');
            }
        }
	}
	public function disconnessione(){
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
			if(!empty($res)){
				$token =random_characters(15);
				$this->umod->addUserResetToken($res->email,$token);
				$this->umod->sendResetToken($res->email,$token);
				echo'<div class="alert alert-success text-center">Si prega di controllare la posta elettronica per il link di reset ...</div>';
			}else{
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
		}else{
			  $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Errore. invalid token / Reset di token password è scaduta / !!!</div>');
				redirect(base_url().'accesso');
			
		}
	}

	public function myaccount(){
	   $this->load->library(array( 'form_validation'));
		$this->form_validation->set_rules('firstname', 'Nome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('lastname', 'Cognome', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        
        $this->form_validation->set_rules('dob', 'Data di nascita', 'trim|required');
        $id =get_user_id();
        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['user'] = $this->umod->getUserById($id);
			$this->data['title']="Edit User";
			$data['scripts'] = array();
			$this->render('my-account-view',$data);
          
        }
        else
        {
            //insert the user registration details into database
            $data = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'middlename' => $this->input->post('middlename'),
                
                'role'=>2,
                'dob' => strtotime($this->input->post('dob')),
                'gender' => $this->input->post('gender')
            );
            
            // insert form data into database
            if ($this->umod->updateUser($data,$id))
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
					}else{
						redirect(base_url());
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
