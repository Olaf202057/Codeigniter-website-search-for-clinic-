<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->query('SELECT * FROM tbl_paypal_credential WHERE id=1');

$result= $query->result_array();

$paypal_mode = $result[0]['paypal_mode'];
*/
/**
# API user: The user that is identified as making the call. you can
# also use your own API username that you created on PayPal’s sandbox
# or the PayPal live site
*/

/*if($paypal_mode=='sandbox')
{
	$API_USERNAME=$result[0]['test_username'];
	$API_PASSWORD=$result[0]['test_password'];
	$API_SIGNATURE=$result[0]['test_signature'];
	$API_ENDPOINT="https://api-3t.sandbox.paypal.com/nvp";
	$PAYPAL_URL="https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";
}
else 
{
	$API_USERNAME=$result[0]['live_username'];
	$API_PASSWORD=$result[0]['live_password'];
	$API_SIGNATURE=$result[0]['live_signature'];
	$API_ENDPOINT="https://api-3t.paypal.com/nvp";
	$PAYPAL_URL="https://www.paypal.com/webscr&cmd=_express-checkout&token=";
	
}*/

$live_mode=TRUE;
if($live_mode==TRUE)
{
	$API_USERNAME="seller_1328528795_biz_api1.gmail.com";
	$API_PASSWORD="1328528828";
	$API_SIGNATURE="AdwdBGIWQg1xwuI46PkE6bAmnLTRAwNM7efznbByMZLsCjiU1RwAcrvo";
	$API_ENDPOINT="https://api-3t.sandbox.paypal.com/nvp";
	$PAYPAL_URL="https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=";
	define('environment','sandbox');
}
else 
{

	$API_USERNAME="info_api1.medscanner.net";
	$API_PASSWORD="R83TQZTQH7J8483V";
	$API_SIGNATURE="AFcWxV21C7fd0v3bYYYRCpSSRl31A43JZlQNfq756RRa3X.mhnGuAsUR";
	$API_ENDPOINT="https://api-3t.paypal.com/nvp";
	$PAYPAL_URL="https://www.paypal.com/webscr&cmd=_express-checkout&token=";
	define('environment','live');

	/*$API_USERNAME="seller_1328528795_biz_api1.gmail.com";
	$API_PASSWORD="1328528828";
	$API_SIGNATURE="AdwdBGIWQg1xwuI46PkE6bAmnLTRAwNM7efznbByMZLsCjiU1RwAcrvo";
	$API_ENDPOINT="https://api-3t.paypal.com/nvp";
	$PAYPAL_URL="https://www.paypal.com/webscr&cmd=_express-checkout&token=";*/
	
}
define('paymentType','Sale');
define('currencyCode','EUR');
define('API_USERNAME',$API_USERNAME);
define('API_PASSWORD',$API_PASSWORD);
define('API_SIGNATURE',$API_SIGNATURE);
define('API_ENDPOINT',$API_ENDPOINT);
define('SUBJECT',"");

/**
PROXY_HOST: Set the host name or the IP address of proxy server.
PROXY_PORT: Set proxy port.
PROXY_HOST and PROXY_PORT will be read only if USE_PROXY is set to TRUE
*/
define('USE_PROXY',FALSE);
define('PROXY_HOST',"127.0.0.1");
define('PROXY_PORT', '808');
/* Define the PayPal URL. This is the URL that the buyer is
   first sent to to authorize payment with their paypal account
   change the URL depending if you are testing on the sandbox
   or going to the live PayPal site
   For the sandbox, the URL is
   https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=
   For the live site, the URL is
   https://www.paypal.com/webscr&cmd=_express-checkout&token=
   */
define('PAYPAL_URL',$PAYPAL_URL);
/**
# Version: this is the API version in the request.
# It is a mandatory parameter for each API request.
# The only supported value at this time is 2.3
*/
define('VERSION',"65.1");
define('ACK_SUCCESS',"SUCCESS");
define('ACK_SUCCESS_WITH_WARNING',"SUCCESSWITHWARNING");
define('AUTH_MODE','');
define('AUTH_TOKEN','');
define('AUTH_SIGNATURE','');
define('AUTH_TIMESTAMP','');
