<?php 
if( !defined('BASEPATH')) exit('No direct access allowed');

class Structure_model extends MY_Model
{
	

	
	

	public function get_structure_exam($limit=0, $start=0,$return_type='') {
	
		$get =$this->input->get();
		$sql = "SELECT s.id,e.owner_id,au.clicks_amount,au.budget_amount,au.remianing_amount,e.id as eid, e.id as exam_id, s.image_url as imageurl, s.hospital, s.hospital as naming_struct,s.address_formatted as address, s.latitude, s.longitude, s.city, s.province, s.telephone, s.website as website_int_struct, e.official_waiting_days, e.exam_type as exam_type, e.price as price, s.website as website FROM tblstructure s, tblexamination e ,tbl_ads_users au,users u where 1 AND s.id=e.struct_id AND au.examination_id=e.id AND u.id = e.owner_id";		
		
		if($get){
			if(isset($get['q']) && $get['q']!=""){

				//$sql .="and exam_type REGEXP  '".str_replace(' ','.*', $get['q'])."'";
				$keyword = explode(" ", $get['q']);
				$sql_exam_type = array();
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						$sql_exam_type[] ="e.exam_type like '%".$word."%'";
						//$sql_exam_type[] ="e.common_name like '%".$word."%'";
					}
				}
				if (count($sql_exam_type) > 0) {
					$sql_add_exam_type = " ".join(' AND ',$sql_exam_type)." ";
					$sql .= " AND ($sql_add_exam_type) ";
				}
			}

           		if(isset($get['common_name'])) {
               			if ($get['common_name'] != "") {
                   			$sql .= " AND e.common_name like '%" . $get['common_name'] . "%' ";
                		}
           		}
           		if ($get['city'] != "") {
				$sql .= " AND s.province like '%" . $get['city'] . "%' ";
               		}
                
			if(isset($get['owd_min']) && isset($get['owd_max'])  ){
				if(count($get['owd_min']) >0 && count($get['owd_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['owd_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.official_waiting_days BETWEEN  ".$get['owd_min'][$key]." and ".$get['owd_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}
			if(isset($get['price_min']) && isset($get['price_max'])  ){
				if(count($get['price_min']) >0 && count($get['price_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['price_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.price BETWEEN  ".$get['price_min'][$key]." and ".$get['price_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}
			$sql .= " AND u.is_approved = '1' ";
			$sql .= " AND u.status = 1 ";
			//$sql .= " AND ((u.price_set_by = 'admin' AND u.clicks_price = '0') OR (au.clicks < au.number_of_click))";
			$sql .= " AND ((u.price_set_by = 'admin' AND u.clicks_price = '0') OR ((au.remianing_amount) / (u.clicks_price) >= 1))";
			//$sql .= " AND au.payment_status= 'active'  ";

		}
		
		
		$sql .= " ORDER BY e.official_waiting_days ASC  ";
		switch ( $return_type ) { // ADDED 04.26.2015. To get total results only.
			case 'total_results':
				
					return Count($this->db->query($sql)->result());
				
			break;
			default:
				
				if($limit>0){
					
					$sql .=" limit  $start, $limit ";
					
				}
				
				return $this->db->query($sql)->result();
			break;
		}

		
	}

	public function get_structure_for_map() {
	
		$sql = "SELECT s.id, e.id as eid, s.hospital, s.hospital as naming_struct, s.address_formatted as address, s.latitude, s.longitude, s.city, s.province, s.telephone, s.website as website_int_struct, e.official_waiting_days FROM tblstructure s, tblexamination e where 1 AND s.id=e.struct_id ";
		
		$get =$this->input->get();
		
		if($get){
				
			if(isset($get['q']) && ($get['q']!="")  ){
				$keyword = explode(" ", $get['q']);
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						$sql .=" and e.exam_type like '%".$word."%'";
					}
				}
			} 
			if(isset($get['exam_id']) && ($get['exam_id']!="")  ){
				$sql .=" AND e.id IN (".$get['exam_id'].") ";
			}
			if(isset($get['address']) && ($get['address']!="")  ){
				$sql .=" AND s.address like '%".$get['address']."%' ";
			}
			if(isset($get['city']) && ($get['city']!="")  ){
				$sql .=" AND s.province like '%".$get['city']."%' ";
			} 
			if(isset($get['owd_min']) && isset($get['owd_max'])  ){
				if(count($get['owd_min']) >0 && count($get['owd_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['owd_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.official_waiting_days BETWEEN  ".$get['owd_min'][$key]." and ".$get['owd_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}
			if(isset($get['price_min']) && isset($get['price_max'])  ){
				if(count($get['price_min']) >0 && count($get['price_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['price_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.price BETWEEN  ".$get['price_min'][$key]." and ".$get['price_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}

		}

				return $this->db->query($sql)->result();
	
		
	}
	public function get_structure_exam_for_map($id) {
	
		$sql = "SELECT s.id, e.id as eid, s.hospital, s.hospital as naming_struct, s.address_formatted as address, s.latitude, s.longitude, s.city, s.province, s.telephone, s.website as website_int_struct, e.official_waiting_days FROM tblstructure s, tblexamination e where 1 AND e.id IN (".$id.") AND s.id=e.struct_id ";
		
		
		$get =$this->input->get();
		
		if($get){
			if(isset($get['q']) && ($get['q']!="")  ){
				$keyword = explode(" ", $get['q']);
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						$sql .=" and e.exam_type like '%".$word."%'";
					}
				}
			} 
			if(isset($get['exam_id']) && ($get['exam_id']!="")  ){
				$sql .=" AND e.id IN (".$get['exam_id'].") ";
				//$sql .=" AND e.id = '".$get['exam_id']."' ";
			}
			if(isset($get['address']) && ($get['address']!="")  ){
				$sql .=" AND s.address like '%".$get['address']."%' ";
			}
			if(isset($get['city']) && ($get['city']!="")  ){
				$sql .=" AND s.province like '%".$get['city']."%' ";
			} 
			if(isset($get['owd_min']) && isset($get['owd_max'])  ){
				if(count($get['owd_min']) >0 && count($get['owd_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['owd_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.official_waiting_days BETWEEN  ".$get['owd_min'][$key]." and ".$get['owd_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}
			if(isset($get['price_min']) && isset($get['price_max'])  ){
				if(count($get['price_min']) >0 && count($get['price_max'])>0) 
				{	
					$sql .=" AND (";
					foreach ($get['price_min'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.price BETWEEN  ".$get['price_min'][$key]." and ".$get['price_max'][$key].") ";
					}
					$sql .=" ) ";
					
				}
			}

		}

				return $this->db->query($sql)->result();
	
		
	}
    function get_hospitals($limit=0, $start=0,$return_type='') {
        $sql = "SELECT * from tblstructure where status=1 ";
			$get =$this->input->get();
		
		if($get){
			if($get['q']!=""){
				$sql .=" AND hospital like '%".$get['q']."%'  ";
			} 
		}
		
        $sql .= " ORDER BY hospital asc  ";
        switch ( $return_type ) { // ADDED 04.26.2015. To get total results only.
            case 'total_results':

                return Count($this->db->query($sql)->result());
                break;
            default:
                if($limit>0) {
                    $sql .= " limit  $start, $limit ";
                }
                return $this->db->query($sql)->result();
                break;
        }

    }
    function get_hospital($id){
        $this->db->where('id',$id);
        return $this->db->get('tblstructure')->row();
    }
    function update_hospital($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update('tblstructure', $data);
    }
    function remove_hospital($id){
        $this->db->where('id', $id);
        return $this->db->update('tblstructure',array('status'=>0));
    }
    function get_hospitals_tagging($limit=0, $start=0,$return_type='') {
        $sql = "SELECT id,hospital from tblstructure where status=1 ";
        $sql .= " ORDER BY hospital asc  ";
        switch ( $return_type ) { // ADDED 04.26.2015. To get total results only.
            case 'total_results':

                return Count($this->db->query($sql)->result());
                break;
            default:
                if($limit>0) {
                    $sql .= " limit  $start, $limit ";
                }
                return $this->db->query($sql)->result();
                break;
        }

    }
}
