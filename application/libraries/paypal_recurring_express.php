<?php
require_once(APPPATH.'third_party/paypal_constant.php');
class paypal_recurring_express
{
	

	function setExpressCheckout()
	{
		
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
	   $desc = " Medscanner Advertise Payment";
		// Add request-specific fields to the request string.
		$nvpStr = "&Amt=$paymentAmount&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID&BILLINGAGREEMENTDESCRIPTION=$currencyID$paymentAmount$desc&BILLINGTYPE=RecurringPayments";
		
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->fn_setExpressCheckout('SetExpressCheckout', $nvpStr);
		

	
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
			// Redirect to paypal.com.
			$token = urldecode($httpParsedResponseAr["TOKEN"]);
			$payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
			if("sandbox" === $environment || "beta-sandbox" === $environment) {
				$payPalURL = "https://www.$environment.paypal.com/webscr&cmd=_express-checkout&token=$token";
			}
			header("Location: $payPalURL");
		
		} 
		else  
		{
			exit('SetExpressCheckout failed: ' . print_r($httpParsedResponseAr, true));
		}
	}
	
	
	function getExpressCheckout()
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;


		// Obtain the token from PayPal.
		if(!array_key_exists('token', $_REQUEST)) 
		{exit('Token is not received.');}
	
		// Set request-specific fields.
		$token = urlencode(htmlspecialchars($_REQUEST['token']));
	
		// Add request-specific fields to the request string.
		$nvpStr = "&TOKEN=$token";
	
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->fn_getExpressCheckout('GetExpressCheckoutDetails', $nvpStr);
		//echo '<pre>'; print_r($httpParsedResponseAr);exit;
	
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			// Extract the response details.
			$payerID = $httpParsedResponseAr['PAYERID'];
			$street1 = $httpParsedResponseAr["SHIPTOSTREET"];
			if(array_key_exists("SHIPTOSTREET2", $httpParsedResponseAr))
			{
				$street2 = $httpParsedResponseAr["SHIPTOSTREET2"];
			}
			$city_name = $httpParsedResponseAr["SHIPTOCITY"];
			//$state_province = $httpParsedResponseAr["SHIPTOSTATE"];
			$postal_code = $httpParsedResponseAr["SHIPTOZIP"];
			$country_code = $httpParsedResponseAr["SHIPTOCOUNTRYCODE"];
			
			return $this->doExpressCheckout($payerID,$token);
			//	exit('Get Express Checkout Details Completed Successfully: '.print_r($httpParsedResponseAr, true));
		} 
		else  
		{
			return $this->doExpressCheckout($payerID,$token);
			//exit('GetExpressCheckoutDetails failed: ' . print_r($httpParsedResponseAr, true));
		}
	
	}
	
	function doExpressCheckout($payerID,$token)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
	
		// Add request-specific fields to the request string.
		$nvpStr = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";
	
		// Execute the API operation; see the PPHttpPost function above.
		$httpParsedResponseAr = $this->fn_doExpressCheckout('DoExpressCheckoutPayment', $nvpStr);
		//print_r($httpParsedResponseAr['TRANSACTIONID']);exit;
	
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			return $this->createRecurringPaymentsProfile($token);
			exit('Express Checkout Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
		} 
		else 
		{
			return $this->createRecurringPaymentsProfile($token);
			exit('DoExpressCheckoutPayment failed: ' . print_r($httpParsedResponseAr, true));
		}
	}
	
	function createRecurringPaymentsProfile($token)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
		$billingPeriod=$this->billingPeriod;
		$billingFreq=$this->billingFreq; 
		$initamt=$this->initamt;
		$desc = " Medscanner Advertise Payment";
		//&INITAMT=0.00
		$token = $_REQUEST['token'];
		$nvpStr="&TOKEN=$token&AMT=$paymentAmount&CURRENCYCODE=$currencyID&PROFILESTARTDATE=$startDate&DESC=$currencyID$paymentAmount$desc";
		$nvpStr .= "&BILLINGPERIOD=$billingPeriod&BILLINGFREQUENCY=$billingFreq";
		
		
		$httpParsedResponseAr = $this->fn_createRecurringPaymentsProfile('CreateRecurringPaymentsProfile', $nvpStr);
		//print_r($httpParsedResponseAr);exit;

		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			//exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($httpParsedResponseAr, true).print_r(urldecode($httpParsedResponseAr['PROFILEID'])));
			//exit(urldecode($httpParsedResponseAr['PROFILEID']));
			return json_encode($httpParsedResponseAr);
		}
		else
		{
			//exit('CreateRecurringPaymentsProfile failed: ' . print_r($httpParsedResponseAr, true));
			return json_encode($httpParsedResponseAr);
		}
	}

	function UpdateRecurringPaymentsProfile($profileID)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		
		
		$nvpStr="&PROFILEID=$profileID&ACTION=Cancel";
		
	
		$httpParsedResponseAr = $this->fn_UpdateRecurringPaymentsProfile('ManageRecurringPaymentsProfileStatus', $nvpStr);
	
		if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
		{
			return $httpParsedResponseAr;
			//exit('CreateRecurringPaymentsProfile Completed Successfully: '.print_r($httpParsedResponseAr, true).print_r(urldecode($httpParsedResponseAr['PROFILEID'])));
		}
		else
		{
			//echo '<pre>';print_r($httpParsedResponseAr);
			exit('Cancelling previous profile failed: ' . print_r($httpParsedResponseAr, true));
		}
	}

	function fn_UpdateRecurringPaymentsProfile($methodName_, $nvpStr_)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;

		$version = urlencode('51.0');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// NVPRequest for submitting to server
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		
		// setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// getting response from server
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse)
		{
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the RefundTransaction response details
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value)
		{
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) 
			{
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr))
		{
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
	
	function fn_createRecurringPaymentsProfile($methodName_, $nvpStr_)
	{ 
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
		$version = urlencode('51.0');
	
		// setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// NVPRequest for submitting to server
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		
		// setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// getting response from server
		$httpResponse = curl_exec($ch);
	/*
		print_r($httpResponse);exit;*/
		if(!$httpResponse)
		{
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the RefundTransaction response details
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value)
		{
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) 
			{
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr))
		{
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
	
	function fn_setExpressCheckout($methodName_, $nvpStr_) 
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
	
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
	
	function fn_getExpressCheckout($methodName_, $nvpStr_)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit('$methodName_ failed: '.curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	
	}
	
	
	function fn_doExpressCheckout($methodName_, $nvpStr_)
	{
		$environment=$this->environment;
		$API_UserName=$this->API_UserName;
		$API_Password=$this->API_Password;
		$API_Signature=$this->API_Signature;
		$API_Endpoint=$this->API_Endpoint;
		$paymentAmount=$this->paymentAmount;
		$currencyID=$this->currencyID;
		$paymentType=$this->paymentType;
		$returnURL=$this->returnURL;
		$cancelURL=$this->cancelURL;
		$startDate=$this->startDate;
	
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	
		// setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Set the curl parameters.
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit('$methodName_ failed: '.curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}
}
?>