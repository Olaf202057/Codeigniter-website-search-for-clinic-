<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital extends MY_Controller {

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

	}

	/*function To add Hospital*/
	public function add()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == '')
		{
			redirect(base_url());
		}

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
                $user_id = $this->session->userdata('user')->id;
                $user_email = $this->session->userdata('user')->email;
                $user_fname = $this->session->userdata('user')->firstname;
                $user_lname = $this->session->userdata('user')->lastname;
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
                    'owner_id' =>$user_id,
                    'image_url'=>$image_url
                );
                $admin_email = $this->master_model->getRecords('users',array('id'=>12));
                $info_email  = $this->master_model->getRecords('tbl_email_master',array('id'=>1));
                $info_arr = array('from'=>$info_email[0]['info_email'],'to'=>$admin_email[0]['email'],'subject'=>'Hospital Add','view'=>'hospital_add_success');
                $other_arr = array('hospital_name'=>$this->input->post('hospital'),'username'=>$user_fname.' '.$user_lname);
                /*Insert Record in database*/
                if($this->master_model->insertRecord('tblstructure',$insert_array))
                {
                	if($this->email_sending->sendmail($info_arr,$other_arr))
                	{
                		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Hospital is Successfully added !!!</div>');
                    	redirect(base_url().'hospital/add');	
                	}
                	else 
                	{
                		$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Failed to send mail !!!</div>');
                    	redirect(base_url().'hospital/add');
                	}
                    
                }
                else 
                {
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later !!!</div>');
                    redirect(base_url().'hospital/add');
                }
            }
        }
		$data['title'] 	= 'Add Hospital';
		$data['scripts']= array();
		$data['menu'] = 'hospital';
		$this->render('addHospital',$data);
	}

	/*Function to edit Hospital*/
	public function edit()
	{
		$user_id 		= $this->session->userdata('user')->id;
		if($user_id == '')
		{
			redirect(base_url());
		}

        if(isset($_POST['update_hospital']))
        {
            $this->form_validation->set_rules('hospital', 'Hospital', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('province', 'Province', 'trim|required|xss_clean');
           // $this->form_validation->set_rules('address_formatted', 'Address Formatted', 'trim|required|xss_clean');
            $this->form_validation->set_rules('website', 'website', 'trim|prep_url');
           /* $this->form_validation->set_rules('latitude', 'Latitude', 'trim|xss_clean');
    	    $this->form_validation->set_rules('longitude', 'Longitude', 'trim|xss_clean');*/

            //validate form input
            if ($this->form_validation->run())
            {
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
                  /*  'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude')*/
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
                        $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error. while uploading image!!!</div>');
                        redirect(base_url().'hospital/edit');
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
                if ($this->master_model->updateRecord('tblstructure',$data,array('owner_id'=>$user_id)))
                {
                
                    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Hospital updated Successfully !!!</div>');
                    redirect(base_url().'hospital/edit');
                }
                else
                {
                    // error
                    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    redirect(base_url().'hospital/edit');
                }

            }
            else
            {
                $data['error'] = $this->form_validation->error_string();  
                //print_r($data['error']); exit();
            }
        }


        $data = array();
        $data['hospital'] = $this->master_model->getRecords('tblstructure',array('owner_id'=>$user_id));
        //echo "<pre>"; print_r($data['hospital']); exit();
        $data['menu'] = 'hospital';
        $this->data['title']="Edit Hospital";
        $data['scripts'] = array();
        $this->render('editHospital',$data);
    }

    /*Function to  remove structure*/
    function remove_structure()
    {
        $post = $this->input->post();
        if(!empty($post)){
            echo $this->smod->remove_hospital($post['id']);
        }else{
            echo 0;
        }
    }


   
}
?>