<?php

class  MY_Controller  extends  CI_Controller  {

	public $data;
	

	function render($file, $data = array())
	{
		
		
		if(empty($this->data['title'] )){
			$this->data['title'] ="";
		}

		
		$this->data['content'] = $this->load->view($file, $data, true);
		$this->load->view('main', $this->data);
	}

}