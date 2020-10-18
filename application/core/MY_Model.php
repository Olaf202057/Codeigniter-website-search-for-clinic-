<?php

class MY_Model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}
	
	
	public function save($data,$table){
		$this->db->insert($table, $data);
		return	$this->db->insert_id();
	}
	public function update($data,$table,$id){
	
		$this->db->where('id', $id);
	 	return	$this->db->update($table, $data);

	}
	public function delete($table,$ref='id',$id){
		
		$this->db->where($ref, $id);
	 	return	$this->db->delete($table);

	}
	public function update2($data,$table,$ref='id',$id){
		
		$this->db->where($ref, $id);
	 	return	$this->db->update($table, $data);

	}
	public function get_data_by_id($table,$id){
		$this->db->where('id', $id);
			$this->db->from($table);
	 	return	$this->db->get()->row();

	}
	
	public function get_detail_by_ref($table,$ref,$id,$order=''){
			$this->db->where($ref, $id);
			$this->db->from($table);
			if($order!=''){
				$this->db->order_by($order,'asc');
			}
	 	return	$this->db->get()->result();

	}
	

	
}

/**
* eof: MY_Model.php
*/