<?php 
if( !defined('BASEPATH')) exit('No direct access allowed');

class Exam_model extends MY_Model
{
	


	public function get_exam($limit=0, $start=0,$return_type='') {
		$this->db->_protect_identifiers=FALSE;

		$sql = "SELECT s.*,e.id as exam_id,e.price,e.exam_type,e.date_updated,e.official_waiting_days,e.reported_waiting_days,e.price FROM tblexamination e
				INNER JOIN tblstructure s on s.id=e.struct_id
				WHERE 1=1
				";
		
		$get =$this->input->get();
		
		if($get){
			if($get['q']!=""){
				$sql .=" AND (e.exam_type like '%".$get['q']."%' ) ";
			} 
			
			if($get['city']!=""){
				$sql .=" OR s.city like '%".$get['city']."%' ";
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

		switch ( $return_type ) { // ADDED 04.26.2015. To get total results only.
			case 'total_results':
					
					return Count($this->db->query($sql)->result());

				break;
			default:
				
				if($limit>0){
					$start = $limit * $start;
					$sql .=" limit  $start, $limit ";
					
				}
				
				return $this->db->query($sql)->result();
			break;
		}

		
	}
	public function save_review($data){
        $data['user_id'] = (is_login(false)) ?get_user_id():0;
        $data['date_submited'] =time();
		$data['status']=1;
        $this->db->insert('tblexamination_review', $data);
        return	$this->db->insert_id();
    }
    function get_exam_review($id){
        $sql = "SELECT er.*,FROM_UNIXTIME(date_submited, '%Y-%m-%d') AS submited_date  ,e.`exam_type`,s.hospital,CONCAT(u.`firstname`,' ',u.`lastname`) AS `name`
                    FROM tblexamination_review    er
                    LEFT JOIN users u ON u.id=er.`user_id`
                    LEFT JOIN tblexamination e ON e.id=er.`exam_id`
                    LEFT JOIN tblstructure s ON s.id=er.`structure_id`
                    WHERE er.id=$id
                  ";

        return $this->db->query($sql)->row();
    }
    function get_hospital_exam_review($structure_id,$exam_id){
        $sql = "SELECT er.*,FROM_UNIXTIME(date_submited, '%Y-%m-%d') AS submited_date  ,e.`exam_type`,s.hospital,CONCAT(u.`firstname`,' ',u.`lastname`) AS `name`
                    FROM tblexamination_review    er
                    LEFT JOIN users u ON u.id=er.`user_id`
                    LEFT JOIN tblexamination e ON e.id=er.`exam_id`
                    LEFT JOIN tblstructure s ON s.id=er.`structure_id`
                    WHERE er.structure_id=$structure_id and er.exam_id=$exam_id and er.status=1
                  ";

        return $this->db->query($sql)->result();
    }
    function get_exam_reviews($limit=0, $start=0,$return_type='') {


            $sql = "SELECT er.*,FROM_UNIXTIME(date_submited, '%Y-%m-%d') AS submited_date  ,e.`exam_type`,s.hospital,CONCAT(u.`firstname`,' ',u.`lastname`) AS `name`
                    FROM tblexamination_review    er
                    LEFT JOIN users u ON u.id=er.`user_id`
                    LEFT JOIN tblexamination e ON e.id=er.`exam_id`
                    LEFT JOIN tblstructure s ON s.id=er.`structure_id`
                    WHERE er.`status`!=2
                  ";

        $sql .= " ORDER BY submited_date DESC  ";
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
    function approve_review($id){
        $this->db->where('id', $id);
        return $this->db->update('tblexamination_review',array('status'=>1));
    }
    function update_review($data){
        $this->db->where('id', $data['id']);
        return $this->db->update('tblexamination_review',$data);
    }
    function remove_review($id){
        $this->db->where('id', $id);
        return $this->db->update('tblexamination_review',array('status'=>2));
    }
    function get_exam_common_name(){
        $this->db->distinct();
        $this->db->select('common_name');
        $this->db->where('common_name !=','');
        return $this->db->get('tblexamination')->result();
    }
    function update_exam_common_name($commmon,$ids){
        $this->db->where_in('id',$ids);
        return $this->db->update('tblexamination',array('common_name'=>$commmon));

    }
    function get_exam_by_id($id){

        $this->db->select('*');
        $this->db->where('id',$id);
        return $this->db->get('tblexamination')->row();
    }
    function update_exam($data,$id)
    {
        $this->db->where('id',$id);
        return $this->db->update('tblexamination', $data);
    }
    function remove_exam($id){
        $this->db->where('id', $id);
        return $this->db->update('tblexamination',array('status'=>0));
    }
    function get_exams($hospital_id=0,$limit=0, $start=0,$return_type='') {
        $sql = "SELECT e.*,s.hospital FROM tblexamination e LEFT JOIN tblstructure s ON s.id=e.struct_id WHERE e.status=1 ";
        $q = $this->input->get('q');
        if($q!=null){
            $sql.=" AND e.exam_type LIKE '%$q%' ";
        }
        if($hospital_id!=0){
            $sql.=" AND e.struct_id=$hospital_id";
        }
        $sql .= " ORDER BY e.exam_type asc  ";
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