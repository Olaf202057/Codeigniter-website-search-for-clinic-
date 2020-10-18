<?php 
if( !defined('BASEPATH')) exit('No direct access allowed');

class Page_model extends MY_Model
{
	


	public function get_page_by_url($url) {
		
		$this->db->where('url',$url);
		return $this->db->get('tblcontents')->row();
		
	}
	public function get_page_by_id($id) {
		$this->db->where('id',$id);
		return $this->db->get('tblcontents')->row();
		
	}
	
	
}