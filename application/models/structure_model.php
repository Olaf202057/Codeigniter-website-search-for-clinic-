<?php 
if( !defined('BASEPATH')) exit('No direct access allowed');

class Structure_model extends MY_Model
{
	

	
	

	public function get_structure_exam($limit=0, $start=0,$return_type='') {
	
		$get =$this->input->get();
		//echo "<pre>"; print_r($get); echo "</pre>";
		$sql = "SELECT e.source, e.ratings, e.formula_rwt,
		e.common_name,s.id,e.owner_id,au.clicks_amount,au.budget_amount,au.remianing_amount,e.id as eid, e.id as exam_id, s.image_url as imageurl, 
		s.hospital, s.hospital as naming_struct,s.address_formatted as address, s.latitude, s.longitude, s.city, s.province, s.telephone, 
		s.website as website_int_struct, e.official_waiting_days, e.exam_type as exam_type, e.price as price, s.website as website 
		FROM tblstructure s, tblexamination e ,tbl_ads_users au,users u 
		where 1 AND s.id=e.struct_id AND au.examination_id=e.id AND u.id = e.owner_id";		
		$velocit_array = array('alta' => array('min' => 0, 'max' => 3), 'media' => array('min' => 3, 'max' => 6), 'bassa' => array('min' => 6, 'max' => 10));
		if($get){
			if(isset($get['q']) && $get['q']!=""){
				//$sql .="and exam_type REGEXP  '".str_replace(' ','.*', $get['q'])."'";
				$keyword = explode(" ", $get['q']);
				$sql_exam_type = array();
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						$word =	str_replace("'","''",$word);
						//$sql_exam_type[] ="e.exam_type like '%".$word."%'";
						$sql_exam_type[] ="e.common_name like '%".$word."%'";
					}
				}
				//exit();
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
						if($get['price_min'][$key] == 0 && $get['price_max'][$key] == 0) {
							$sql .=" (e.price IS NULL) ";
						} else {						
							$sql .=" (e.price BETWEEN  ".$get['price_min'][$key]." and ".$get['price_max'][$key].") ";
						}
					}
					$sql .=" ) ";
					
				}
			}
			
			
			if(isset($get['velocit'])){
				if(count($get['velocit']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['velocit'] as $key => $row) {
						if(isset($velocit_array[$get['velocit'][$key]])) {
							if($key>0){
								$sql .=" OR ";
							}
							$selected_velocit = $velocit_array[$get['velocit'][$key]];
							$sql .=" (e.formula_rwt > ".$selected_velocit['min']." AND e.formula_rwt < ".($selected_velocit['max'] + 1).") ";
						}
					}
					$sql .=" ) ";
					
				}
			}	
			
			if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['rating'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.ratings >=  ".$get['rating'][$key]." AND e.ratings < ".($get['rating'][$key] + 1).") ";
					}
					$sql .=" ) ";
					
				}
			}			
			/*if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{
					$rating = implode(",", $get['rating']);	
					$sql .=" AND (SELECT IFNULL(AVG(IFNULL(rating,0)),0) FROM  `tblexamination_review` WHERE `status`=1 AND exam_id=e.id) IN ($rating)";
				}
			}*/
			$sql .= " And u.is_approved = '1' ";
			$sql .= " AND u.status = 1 ";
			//$sql .= " AND ((u.price_set_by = 'admin' AND u.clicks_price = '0') OR (au.clicks < au.number_of_click))";
			$sql .= " AND ((u.price_set_by = 'admin' AND u.clicks_price = '0') OR ((au.remianing_amount) / (u.clicks_price) >= 1))";
			//$sql .= " AND au.payment_status= 'active'  ";

		}
		//$sql .= " ORDER BY e.official_waiting_days ASC  ";
		
		$sql1 = ' SELECT e.source,e.ratings,e.formula_rwt,  
		e.common_name,s.id,e.owner_id,e.owner_id as clicks_amount,e.owner_id as budget_amount,e.owner_id as remianing_amount,e.id as eid, e.id as exam_id, 
		s.image_url as imageurl, s.hospital, s.hospital as naming_struct,s.address_formatted as address, s.latitude, s.longitude, s.city, s.province, 
		s.telephone, s.website as website_int_struct, e.official_waiting_days, e.exam_type as exam_type, e.price as price, s.website as website 
		FROM tblstructure s,tblexamination e 
		WHERE  s.id=e.struct_id AND e.owner_id = 0';
				
		if($get){
			if(isset($get['q']) && $get['q']!=""){

				//$sql .="and exam_type REGEXP  '".str_replace(' ','.*', $get['q'])."'";
				$keyword = explode(" ", $get['q']);
				$sql_exam_type = array();
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						//$sql_exam_type[] ="e.exam_type like '%".$word."%'";
						$word =	str_replace("'","''",$word);
						$sql_exam_type[] ="e.common_name like '%".$word."%'";
					}
				}
				if (count($sql_exam_type) > 0) {
					$sql_add_exam_type = " ".join(' AND ',$sql_exam_type)." ";
					$sql1 .= " AND ($sql_add_exam_type) ";
				}
			}

			if(isset($get['common_name'])) {
				if ($get['common_name'] != "") {
					$sql1 .= " AND e.common_name like '%" . $get['common_name'] . "%' ";
				}
			}
			if ($get['city'] != "") {
				$sql1 .= " AND s.province like '%" . $get['city'] . "%' ";
			}
                
			if(isset($get['owd_min']) && isset($get['owd_max'])  ){
				if(count($get['owd_min']) >0 && count($get['owd_max'])>0) 
				{	
					$sql1 .=" AND (";
					foreach ($get['owd_min'] as $key => $row) {
						if($key>0){
							$sql1 .=" OR ";
						}
						$sql1 .=" (e.official_waiting_days BETWEEN  ".$get['owd_min'][$key]." and ".$get['owd_max'][$key].") ";
					}
					$sql1 .=" ) ";
					
				}
			}
			if(isset($get['price_min']) && isset($get['price_max'])  ){
				if(count($get['price_min']) >0 && count($get['price_max'])>0) 
				{	
					$sql1 .=" AND (";
					foreach ($get['price_min'] as $key => $row) {
						if($key>0){
							$sql1 .=" OR ";
						}
						if($get['price_min'][$key] == 0 && $get['price_max'][$key] == 0) {
							$sql1 .=" (e.price IS NULL) ";
						} else {
							$sql1 .=" (e.price BETWEEN  ".$get['price_min'][$key]." and ".$get['price_max'][$key].") ";
						}
					}
					$sql1 .=" ) ";
					
				}
			}
			
			if(isset($get['velocit'])){
				if(count($get['velocit']) >0) 
				{	
					$sql1 .=" AND (";
					foreach ($get['velocit'] as $key => $row) {
						if(isset($velocit_array[$get['velocit'][$key]])) {
							if($key>0){
								$sql1 .=" OR ";
							}
							$selected_velocit = $velocit_array[$get['velocit'][$key]];
							$sql1 .=" (e.formula_rwt > ".$selected_velocit['min']." AND e.formula_rwt < ".($selected_velocit['max'] + 1).") ";
						}
					}
					$sql1 .=" ) ";
					
				}
			}	
			
			if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{	
					$sql1 .=" AND (";
					foreach ($get['rating'] as $key => $row) {
						if($key>0){
							$sql1 .=" OR ";
						}
						$sql1 .=" (e.ratings >=  ".$get['rating'][$key]." AND e.ratings < ".($get['rating'][$key] + 1).") ";
					}
					$sql1 .=" ) ";
					
				}
			}	
			
			
			/*if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{
					$rating = implode(",", $get['rating']);	
					$sql1 .=" AND (SELECT IFNULL(AVG(IFNULL(rating,0)),0) FROM  `tblexamination_review` WHERE `status`=1 AND exam_id=e.id) IN($rating)";
				}
			}*/
		}

		//$sql1 .= " ORDER BY e.official_waiting_days ASC  ";
		$sql = 'SELECT s.* FROM (('.$sql .') UNION ('.$sql1.')) s ';
		if(isset($get['sort']) && $get['sort']!=""){
			if($get['sort'] == "default") {
				//$sql .= " ORDER BY s.official_waiting_days ASC  ";
				//$sql .= " ORDER BY -s.official_waiting_days DESC  ";
				$sql .= " ORDER BY ISNULL(NULLIF(s.official_waiting_days,0)), NULLIF(s.official_waiting_days,0) ASC ";
			} else if($get['sort'] == "costo") {
				$sql .= " ORDER BY s.price ASC  ";
			} else if($get['sort'] == "suggerito") {
				$sql .= " ORDER BY s.price ASC  ";
			}
		} else {
			// ISNULL(field)
			//$sql .= " ORDER BY s.official_waiting_days ASC  ";
			//$sql .= " ORDER BY -s.official_waiting_days DESC  ";
			$sql .= " ORDER BY ISNULL(NULLIF(s.official_waiting_days,0)), NULLIF(s.official_waiting_days,0) ASC ";
		}
		//echo "<br /><br />" . $sql;
		switch ( $return_type ) { // ADDED 04.26.2015. To get total results only.
			case 'total_results':
				return Count($this->db->query($sql)->result());
				
			break;
			default:
				if($limit>0){
					$sql .=" limit  $start, $limit ";
				}
				//echo $sql;exit;
				return $this->db->query($sql)->result();
				//echo $this->db->last_query();echo '<pre>';print_r($res);exit;
			break;
		}

		
	}

	public function get_structure_for_map() {
	
		$sql = "SELECT s.id, e.id as eid, 
		e.ratings, e.formula_rwt, e.common_name, 
		s.hospital, 
		s.hospital as naming_struct, 
		s.address_formatted as address, 
		s.latitude, s.longitude, 
		s.city, s.province, 
		s.telephone, s.website as website_int_struct, 
		e.official_waiting_days FROM tblstructure s, tblexamination e where 1 AND s.id=e.struct_id AND s.latitude != 0 AND s.longitude != 0 ";
		
		$get =$this->input->get();
		
		if($get){
				
			if(isset($get['q']) && ($get['q']!="")  ){
				$keyword = explode(" ", $get['q']);
				foreach($keyword as $word){
					if (strlen($word) > 2) {
						$sql .=" and e.common_name like '%".$word."%'";
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
			
			if(isset($get['velocit'])){
				if(count($get['velocit']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['velocit'] as $key => $row) {
						if(isset($velocit_array[$get['velocit'][$key]])) {
							if($key>0){
								$sql .=" OR ";
							}
							$selected_velocit = $velocit_array[$get['velocit'][$key]];
							$sql .=" (e.formula_rwt > ".$selected_velocit['min']." AND e.formula_rwt < ".($selected_velocit['max'] + 1).") ";
						}
					}
					$sql .=" ) ";
					
				}
			}	
			
			if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['rating'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.ratings >=  ".$get['rating'][$key]." AND e.ratings < ".($get['rating'][$key] + 1).") ";
					}
					$sql .=" ) ";
					
				}
			}	
			

		}
		$sql .= " limit  0, 100 "; // added by ksa
		//echo $sql;
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
			if(isset($get['velocit'])){
				if(count($get['velocit']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['velocit'] as $key => $row) {
						if(isset($velocit_array[$get['velocit'][$key]])) {
							if($key>0){
								$sql .=" OR ";
							}
							$selected_velocit = $velocit_array[$get['velocit'][$key]];
							$sql .=" (e.formula_rwt > ".$selected_velocit['min']." AND e.formula_rwt < ".($selected_velocit['max'] + 1).") ";
						}
					}
					$sql .=" ) ";
					
				}
			}	
			
			if(isset($get['rating'])){
				if(count($get['rating']) >0) 
				{	
					$sql .=" AND (";
					foreach ($get['rating'] as $key => $row) {
						if($key>0){
							$sql .=" OR ";
						}
						$sql .=" (e.ratings >=  ".$get['rating'][$key]." AND e.ratings < ".($get['rating'][$key] + 1).") ";
					}
					$sql .=" ) ";
					
				}
			}	

		}

				return $this->db->query($sql)->result();
	
		
	}
    function get_hospitals($limit=0, $start=0,$return_type='',$columns_array) {
        $sql = "SELECT tblstructure.*, users.firstname, users.lastname from tblstructure LEFT JOIN users ON users.id = tblstructure.owner_id  where tblstructure.status=1 ";
			$get =$this->input->get();
		
		if($get){
			if(trim($get['q'])!=""){
				$key_search = array();
				$key_search[] = "tblstructure.hospital like '%".$get['q']."%'";
				$key_search[] = "tblstructure.address like '%".$get['q']."%'";
				$key_search[] = "tblstructure.city like '%".$get['q']."%'";
				$key_search[] = "tblstructure.province like '%".$get['q']."%'";
				$key_search[] = "tblstructure.latitude like '%".$get['q']."%'";
				$key_search[] = "tblstructure.longitude like '%".$get['q']."%'";
				$key_search[] = "tblstructure.telephone like '%".$get['q']."%'";
				$key_search[] = "tblstructure.email like '%".$get['q']."%'";
				$key_search[] = "tblstructure.website like '%".$get['q']."%'";
				$key_search[] = "tblstructure.image_url like '%".$get['q']."%'";
				
				$sql .=" AND (" . implode(" OR ", $key_search) . ") ";
				//$sql .=" AND hospital like '%".$get['q']."%'  ";
			} 
		}
		
		if(isset($columns_array[$get['column']])) {
			$order = "asc";
			if($get['order'] == "desc") {
				$order = "desc";
			}
			
			$sql .= " ORDER BY " .  $get['column'] . " " . $order . "  ";
		} else {
			$sql .= " ORDER BY hospital asc  ";
		}
        
		
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
