<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'third_party/paypal_constant.php');
class Callerservice extends CI_Model
{
	public  $API_UserName;
    
    
	public function __construct()
	{
		parent::__construct();
        
         
	}
	
	public function nvpHeader()
	{
		$API_UserName=API_USERNAME;
		$API_Password=API_PASSWORD;
		$API_Signature=API_SIGNATURE;
		$API_Endpoint=API_ENDPOINT;
		$version=VERSION;
		$subject=SUBJECT;
		
		if(AUTH_TOKEN!="")
		{$AUTH_token=AUTH_TOKEN;}
		
		if(AUTH_SIGNATURE!="")
		{$AUTH_signature=AUTH_SIGNATURE;}
		
		if(AUTH_TIMESTAMP!="")
		{$AUTH_timestamp=AUTH_TIMESTAMP;}
		if(AUTH_MODE!="") 
		{
			//$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
			//$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
			//$AuthMode = "THIRDPARTY";Partner's API Credential and Merchant Email as Subject are required.
			$AuthMode = AUTH_MODE; 
		} 
		else
		{
			if((!empty($API_UserName)) && (!empty($API_Password)) && (!empty($API_Signature)) && (!empty($subject))) 
			{$AuthMode = "THIRDPARTY";}
	
			else if((!empty($API_UserName)) && (!empty($API_Password)) && (!empty($API_Signature)))
			{$AuthMode = "3TOKEN";}
			
			elseif (!empty($AUTH_token) && !empty($AUTH_signature) && !empty($AUTH_timestamp))
			{$AuthMode = "PERMISSION";}
			
    		elseif(!empty($subject)) 
    		{$AuthMode = "FIRSTPARTY";}
		}
		switch($AuthMode) 
		{
			case "3TOKEN" : 
				$nvpHeaderStr = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature);
				break;
			case "FIRSTPARTY" :
				$nvpHeaderStr = "&SUBJECT=".urlencode($subject);
				break;
			case "THIRDPARTY" :
				$nvpHeaderStr = "&PWD=".urlencode($API_Password)."&USER=".urlencode($API_UserName)."&SIGNATURE=".urlencode($API_Signature)."&SUBJECT=".urlencode($subject);
				break;		
			case "PERMISSION" :
		    	$nvpHeaderStr = formAutorization($AUTH_token,$AUTH_signature,$AUTH_timestamp);
		    	break;
		}
		return $nvpHeaderStr;
	}
	
	/**
	  * hash_call: Function to perform the API call to PayPal using API signature
	  * @methodName is name of API  method.
	  * @nvpStr is nvp string.
	  * returns an associtive array containing the response from the server.
	*/
	public function hash_call($methodName,$nvpStr)
	{
		//declaring of global variables
		global $API_Endpoint,$version,$API_UserName,$API_Password,$API_Signature,$nvp_Header, $subject, $AUTH_token,$AUTH_signature,$AUTH_timestamp;
		// form header string
		$API_Endpoint=API_ENDPOINT;
		$AUTH_token=AUTH_TOKEN;
		$AUTH_signature=AUTH_SIGNATURE;
		$AUTH_timestamp=AUTH_TIMESTAMP;
		$nvpheader=$this->nvpHeader();
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		//in case of permission APIs send headers as HTTPheders
		if(!empty($AUTH_token) && !empty($AUTH_signature) && !empty($AUTH_timestamp))
	 	{
			/*$headers_array[] = "X-PP-AUTHORIZATION: ".$nvpheader;
  			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_array);
    		curl_setopt($ch, CURLOPT_HEADER, false);*/
		}
		else 
		{
			$nvpStr=$nvpheader.$nvpStr;
		}
		
	    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
	   //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
		if(USE_PROXY)
		curl_setopt ($ch, CURLOPT_PROXY, PROXY_HOST.":".PROXY_PORT); 

		//check if version is included in $nvpStr else include the version.
		if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) 
		{
			$nvpStr = "&VERSION=" . (VERSION) . $nvpStr;	
		}
	
		$nvpreq="METHOD=".($methodName).$nvpStr;
	
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
	
		//getting response from server
		$response = curl_exec($ch);

		//convrting NVPResponse to an Associative Array
		$nvpResArray=$this->deformatNVP($response);
		$nvpReqArray=$this->deformatNVP($nvpreq);
		$nvp_req_array=array('nvpReqArray'=>$nvpReqArray);
		$this->session->set_userdata($nvp_req_array);

		if (curl_errno($ch)) 
		{
			// moving to display page to display curl errors
			$curl_error_array=array('curl_error_no'=>curl_errno($ch),'curl_error_msg'=>curl_error($ch));
		 	$this->session->set_userdata($curl_error_array);
		  	//$location = "APIError.php";
		  	//header("Location: $location");
		}
		else
		{
		 //closing the curl
			curl_close($ch);
	  	}
		return $nvpResArray;
	}
	/** This function will take NVPString and convert it to an Associative Array and it will decode the response.
	  * It is usefull to search for a particular key and displaying arrays.
	  * @nvpstr is NVPString.
	  * @nvpArray is Associative Array.
	*/
	public function deformatNVP($nvpstr)
	{
		$intial=0;
 		$nvpArray = array();
		while(strlen($nvpstr))
 		{
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvpArray[urldecode($keyval)] =urldecode( $valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
     	}
		return $nvpArray;
	}
	public function formAutorization($auth_token,$auth_signature,$auth_timestamp)
	{
		$authString="token=".$auth_token.",signature=".$auth_signature.",timestamp=".$auth_timestamp ;
		return $authString;
	}
}
