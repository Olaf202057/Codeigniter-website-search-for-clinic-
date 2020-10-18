<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function page($url)
	{
		$data = array();
		$this->load->model('page_model','pmod');
		$data['scripts'] = array();

		$data['data'] = $this->pmod->get_page_by_url($url);
		$this->data['title'] = $data['data']->title;
		$this->render('page/page-view',$data);
	}
	public function contattaci()
	{
		$data = array();
		$this->load->model('page_model','pmod');
		$data['scripts'] = array();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nome', 'Nome', 'required');
		$this->form_validation->set_rules('cognome', 'Nognome', 'required');
		$this->form_validation->set_rules('indirizzo', 'Indirizzo', 'required');
		$this->form_validation->set_rules('comune', 'Comune', 'required');
		$this->form_validation->set_rules('prov', 'Prov', 'required');
		$this->form_validation->set_rules('cap', 'Cap', 'required');
		$this->form_validation->set_rules('codice_fiscale', 'Codice Fiscale', 'required');
		$this->form_validation->set_rules('cellulare', 'Cellulare', 'required');
		$this->form_validation->set_rules('request_message', 'La Tua richiesta', 'required');
		$this->form_validation->set_rules('email', 'E-mail' , 'trim|required|matches[confirm_email]');
		$this->form_validation->set_rules('confirm_email', 'Conferma E-mail', 'required');
		$this->form_validation->set_rules('accept', 'Accetto/Non accetto', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" style="text-align: center; margin-bottom: 0px;" >', '</div>');
		$this->load->library('form_validation');

		

		if ($this->form_validation->run() == FALSE)
		{
			$data['contattaci_1'] = $this->pmod->get_page_by_id(5);
			$data['contattaci_2'] = $this->pmod->get_page_by_id(6);
			$this->data['title'] =  $data['contattaci_1']->title;
			$this->render('Page/contattaci-view',$data);
		}
		else
		{
			$post =$this->input->post();
			$data_insert =array(
									'nome'=>$post["nome"],
									'cognome'=>$post["cognome"],
									'indirizzo'=>$post["indirizzo"],
									'cap'=>$post["cap"],
									'comune'=>$post["comune"],
									'prov'=>$post["prov"],
									'cellulare'=>$post["cellulare"],
									'codice_fiscale'=>$post["codice_fiscale"],
									'email'=>$post["email"],
									'request_message'=>$post["request_message"],
									'is_accetto'=>$post["accept"]
								);
			$this->load->library('email');

			// prepare email
			$this->email
			    ->from($post["email"], $post["nome"]. ' '. $post["cognome"])
			    ->to('info@medscanner.net')
			    ->subject('['.SITE_TITLE.'] - Contattaci')
			    ->message($post["request_message"])
			    ->set_mailtype('html');

			// send email
			$this->email->send();
			//echo $this->email->print_debugger();
			$this->session->set_flashdata('message', '<div class="alert alert-success" style="text-align:center" >inviata con successo</div>');
			$this->db->insert('tblcontattaci_request',$data_insert);
			redirect(base_url('contattaci'));
		}

	}
}
