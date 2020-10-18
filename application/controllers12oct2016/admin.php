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
		$this->load->library('pagination');
        is_admin_login();
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
    public function edit_structures($id){

        $this->load->library(array( 'form_validation'));
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
          
            if($_FILES['fileupload']['size']>0){
                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
                $filename =time().basename($_FILES['fileupload']['name']);
                $uploadfile = $uploaddir.$filename ;

                if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $uploadfile)) {
                  $image_url=base_url().'uploads/'.$filename;
                  $data['image_url']=$image_url;
                } 
            }
       
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
    public function update_exam_common_name(){
       $exam_id= $this->input->post('exam_id');
       $common_name= $this->input->post('common_name');
       echo  $this->emod->update_exam_common_name($common_name,$exam_id);


    }
    public function edit_exam($id){
        $this->load->library(array( 'form_validation'));
        $this->form_validation->set_rules('exam_type', 'Exam Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('common_name', 'Search Keyword', 'trim|xss_clean');
        $this->form_validation->set_rules('official_waiting_days', 'Official waiting days', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reported_waiting_days', 'Reported waiting days', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');

        //validate form input
        if ($this->form_validation->run() == FALSE)
        {
            $data = array();
            $data['exam'] = $this->emod->get_exam_by_id($id);
            $this->data['title']="Edit Exam";
            $data['scripts'] = array();
            $this->render('admin/exam-form-view',$data);

        }
        else
        {

            //insert the user registration details into database
            $data = array(
                'price' => $this->input->post('price'),
                'exam_type' => $this->input->post('exam_type'),
                'common_name' => $this->input->post('common_name'),
                'official_waiting_days' => $this->input->post('official_waiting_days'),
                'reported_waiting_days' => $this->input->post('reported_waiting_days'),
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
		$config['total_rows'] =  $this->umod->get_users($limit, $offset,'total_results'); // Total results only.
		
		$this->pagination->initialize($config);
		$data['users'] = $this->umod->get_users($limit, $offset);
	
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
                'dob' => strtotime($this->input->post('dob')),
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
	function approve_user(){
		$post = $this->input->post();
		if(!empty($post)){
			echo $this->umod->approve_user($post['id']);
		}else{
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
