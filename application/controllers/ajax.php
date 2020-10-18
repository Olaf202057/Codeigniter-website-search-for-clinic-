<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MY_Controller {

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

	}

	public function checkemaildup()
	{
		$email = $this->input->post('email');
		$user  = $this->master_model->getRecords('users',array('email'=>$email));
		if(count($user)>0)
			echo "error";
		else
		   echo "success";
		
	}
  

	public function getState()
	{
		$id=$this->input->post('id');
		$states = $this->master_model->getRecords('states',array('country_id'=>$id));
		$str = "<option value=''>--Select State--</option>";
		if(count($states)>0)
		{
			foreach ($states as $state)
			{
				$str = $str."<option value=$state[id]>$state[name]</option>";
			}
		}
		else
		{
			$str = "<option value=''>--No states--</option>";
		}
		echo $str;
	}
	public function getCity()
	{
		$id=$this->input->post('id');
		$cities = $this->master_model->getRecords('cities',array('state_id'=>$id));
		$str = "<option value=''>--Select city--</option>";
		if(count($cities)>0)
		{
			foreach ($cities as $city)
			{
				$str = $str."<option value=$city[id]>$city[name]</option>";
			}
		}
		else
		{
			$str = "<option value=''>--No city--</option>";
		}
		echo $str;
	}

	/*---Seema--*/
	public function dup_emailaddress()
	{
		 $email = $this->input->post('email'); 
		 $user_id    = $this->session->userdata('user')->id;
		if(!empty($email))
		{
			$user_result = $this->master_model->getRecordCount('users',array('email'=>$email,'id <>' => $user_id));
		 	if($user_result>0)
		 	{ 
		 		echo "exist"; 
		 	}
		 	else
	 		{ 
	 			echo "available"; 
	 		}
		}
	}




	public function getHospital()
	{
		$id=$this->input->post('user');
		$hospital = $this->master_model->getRecords('tblstructure',array('status'=>1,'owner_id'=>$id));
		$str = "<option value=''>--Select Hospital--</option>";
		if(count($hospital)>0)
		{
			foreach ($hospital as $hosp)
			{
				$str = $str."<option value=$hosp[id]>$hosp[hospital]</option>";
			}
		}
		else
		{
			$str = "<option value=''>--No hospital--</option>";
		}
		echo $str;
	}





	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>