<?php
class users_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function insertUser($data)
    {
        return $this->db->insert('users', $data);
    }
    function updateUser($data,$id)
    {   
        $this->db->where('id',$id);
        return $this->db->update('users', $data);
    }
    function social_login($provider,$id,$data){
        switch($provider){
            case 'Facebook':
                 $this->db->where('fb_id',$id);
                break;
            default:
                $this->db->where('google_id',$id);
                break;
        }
		$this->db->or_where('email',$data['email']);
        $this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
        $res =$this->db->get('users')->row();
        if(!empty($res)){
            switch($provider){
                case 'Facebook':
                    $this->db->where('fb_id',$id);
					
                    break;
                default:
                    $this->db->where('google_id',$id);
                    break;
            }
			
            $this->db->update('users',$data);
        }else{
           $this->insertUser($data);
            $id = $this->db->insert_id();
            $this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
            $this->db->where('id',$id);
            $res =$this->db->get('users')->row();
        }
        return $res;
    }
    function get_users($limit=0, $start=0,$return_type='') {
    
        $get =$this->input->get();
        $sql = "SELECT *,FROM_UNIXTIME(dob, '%Y-%m-%d') as birthday  FROM `users`
                where `status`!=3  or `status` is null
                ";
        
        
        $sql .= " ORDER BY `users`.`id` DESC  ";
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
     function getUserById($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        return $this->db->get('users')->row();
    }
    function getUserByEmail($email){
        $this->db->select('id,email,firstname,lastname,role,profile_pic');
        $this->db->where('email', $email);
        return $this->db->get('users')->row();
    }
    function changePassword($data,$id){
           $this->db->where('id', $id);
           return $this->db->update('users',$data);
    }
    function approve_user($id){
           $this->db->where('id', $id);
           return $this->db->update('users',array('is_approved'=>1));
    }
     function remove_user($id){
           $this->db->where('id', $id);
           return $this->db->update('users',array('status'=>3));
    }
    function getUserByResetToken($reset_pass_token){
        $this->db->select('id,email,firstname,lastname,role,profile_pic');
        $this->db->where('reset_pass_token', $reset_pass_token);
        return $this->db->get('users')->row();
    }
    function addUserResetToken($email,$token){
           $this->db->where('email', $email);
           return $this->db->update('users',array('reset_pass_token'=>$token));
    }
    function check_login($data){
        $this->db->select('id,email,firstname,lastname,role,profile_pic,is_approved,status');
        $this->db->where('email',$data['email']);
        $this->db->where('password',md5($data['password']));
        return $this->db->get('users')->row();
    }
    //send verification email to user's email id
    function sendEmail($to_email)
    {
        $this->load->library('email');
        $from_email = 'no-reply@medscanner.net'; //change this to yours
        $subject = 'Medscanner -  Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> <a href="'.base_url().'verify/' . md5($to_email) . '">'.base_url().'verify/' . md5($to_email) . '</a><br /><br /><br />Thanks<br />Medscanner Team';
        
            //configure email settings
         $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype']='html';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'Medscanner');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
         
    }
    function sendResetToken($to_email,$resetToken)
    {
        $this->load->library('email');
        $from_email = 'no-reply@medscanner.net'; //change this to yours
        $subject = 'Medscanner - Reset Password';
        $message = 'Dear User,<br /><br />Please click on the below link to reset your password.<br /><br /> <a href="'.base_url().'resetpassword/' .$resetToken. '">'.base_url().'verify/' . $resetToken. '</a><br /><br /><br />Thanks<br />Medscanner Team';
        
            //configure email settings
         $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['mailtype']='html';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'Medscanner');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
         
    }
    //activate user account
    function verifyEmailID($key)
    {
        $data = array('status' => 1);
        $this->db->where('md5(email)', $key);
        return $this->db->update('users', $data);
    }
}
?>