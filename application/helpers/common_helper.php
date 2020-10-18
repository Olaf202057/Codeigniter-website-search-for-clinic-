<?php
function pr($obj){
	echo "<pre style='border:1px solid #e82121;padding:20px;margin:20px;background-color:#fdb4b4;color:#333'>";
	print_r($obj);
	echo "</pre>";
}


function random_characters($characters){
	/* numbers, letters */
	$possible = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ12345678909876543210';
	$code = '';
	$i = 0;
	while ($i < $characters) { 
		$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		$i++;
	}
	return $code;
}
function is_admin(){
	$CI =& get_instance();
	
	
	$user = $CI->session->userdata('user')->role;
	if($user==1){
		return true;
	}else{
		return false;
	}
}

function get_user_fullname(){
	$CI =& get_instance();
	return  ucwords($CI->session->userdata('user')->firstname.' '. $CI->session->userdata('user')->lastname);
}

function get_user_id(){
	$CI =& get_instance();
	return  $CI->session->userdata('user')->id;
}
function profile_pic(){
	$CI =& get_instance();
	$image = $CI->session->userdata('user')->profile_pic;
	return !empty($image) ? $image: "no-photo.png" ;
}
function is_login($is_redirect=true){
		$CI =& get_instance();
		
		$user = $CI->session->userdata('user');
		if(!empty($user)){ 

				return true;
		}else{
			if($is_redirect){
				
				
				redirect(base_url('accesso'));
			
				exit();
			}else{
				return false;
			}
		}
		return false;
}
function is_admin_login($is_redirect=true){
    $CI =& get_instance();

    $user = $CI->session->userdata('user');
    if(!empty($user)){
        if(is_admin()){
            return true;
        }else{
            redirect(base_url('limitare'));
        }

    }else{
        if($is_redirect){
            redirect(base_url('accesso'));
            exit();
        }else{
            return false;
        }
    }
    return false;
}


?>