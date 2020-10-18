<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 	= 'home';
$route['limitare'] 	= 'home/limitare';
$route['search'] 				= 'home/search';
$route['search/page'] 				= 'home/search';
$route['map-search'] 				= 'home/search_map';
$route['search/page/(:num)'] 				= 'home/search';
$route['hospitals']				= 'home/hospitals';
$route['hospitals/(:num)']				= 'home/hospitals/$1';
$route['registration']				= 'home/registration';
$route['accesso']				= 'home/accesso';
$route['accesso-fb']				= 'home/facebook';
$route['disconnessione']				= 'home/disconnessione';
$route['verify/(:any)']				= 'home/verify/$1';
$route['resettalapassword']				= 'home/resettalapassword';
$route['resetpassword/(:any)']				= 'home/new_password/$1';
$route['accesso-google-plus']				= 'home/accesso_google_plus';
$route['myaccount']				= 'home/myaccount';
$route['submit-review']				= 'home/submit_review';
$route['admin/search'] 				= 'admin';
$route['admin/search/(:num)'] 				= 'admin';


$route['page/(:any)']				= 'content/page/$1';
$route['contattaci']				= 'content/contattaci';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */