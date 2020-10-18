<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function __construct()
	{
		// Constructor to auto-load HybridAuthLib
		parent::__construct();
        $this->load->model('users_model','umod');
		$this->load->library('HybridAuthLib');
	}

	public function index()
	{
		// Send to the view all permitted services as a user profile if authenticated
		$login_data['providers'] = $this->hybridauthlib->getProviders();
		foreach($login_data['providers'] as $provider=>$d) {
			if ($d['connected'] == 1) {
				$info = $login_data['providers'][$provider]['user_profile'] = $this->hybridauthlib->authenticate($provider)->getUserProfile();
			
               $data = array(
                    'firstname' => !empty($info->firstName) ? $info->firstName:$info->displayName,
                    'lastname' => $info->lastName,
                    'middlename' => '',
                    'role'=>2,
                    'profile_pic'=>$info->photoURL,
                    'email' => !empty($info->email) ? $info->email: str_replace(' ','',$info->displayName)  ,
                    'gender' => $info->gender

                );
                switch($provider){
                    case 'Facebook':
                        $data['fb_id']=$info->identifier;
                
                        break;
                    default:
                        $data['google_id']=$info->identifier;
                        break;
                }
                if(!empty($info->EmailVerified)){
                    $data['status']=1;
                }
                  $res = $this->umod->social_login($provider,$info->identifier,$data);
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
                }else {
                    $this->session->set_userdata('user', $res);
                    if ($res->role == 1) {
                        redirect(base_url() . 'admin');
                    } else {
                        redirect(base_url());
                    }
                }

			}
		}
        redirect(base_url('accesso'));

	}
	public function logout($provider)
	{
	}
	public function login($provider)
	{
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					/*log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();

					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;

					$this->load->view('hauth/done',$data);
					*/
					redirect (base_url('hauth'));
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
