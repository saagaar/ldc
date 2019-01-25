<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'user/login/admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
$route['login/(:any)']="user/login/index/$1";
$route['logout/(:any)']="user/logout/index/$1";
	
// $route['home/(:any)'] = "user/login/index/$1";
// $route['home/(:any)'] = "home/index/$1";
// $route['cron/(:any)'] = 'cron/auto_close/$1';
//added by sujit
// $route[ADMIN_LOGIN_PATH] = 'login/admin';

//$route[ADMIN_FORGOT_PASSWORD_PATH] = 'login/password/forgot';
//$route[ADMIN_CHANGE_PASSWORD_PATH] = 'login/pasword';

$route[ADMIN_DASHBOARD_PATH] = 'admin/member_management';
$route[STAFF_DASHBOARD_PATH.'/(:any)'] = 'staff/student_management/$1';
$route[STUDENT_DASHBOARD_PATH] = 'student/total_incentive';
$route[ADMIN.'/(:any)'] = "admin/$1";
$route[MY_ACCOUNT.'(:any)'] = 'my-account/user/$1';
$route[MY_ACCOUNT.'(:any)/(:any)'] = 'my-account/user/$1/$2';
$route[MY_ACCOUNT.'(:any)/(:any)/(:any)/(:any)'] = 'my-account/user/$1/$2/$3';
$route[MY_ACCOUNT.'(:any)/(:any)/(:any)/(:any)'] = 'my-account/user/$1/$2/$3/$4';

$route['feedback/(:any)'] = 'user/users/feedback/$1';


// $route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(:any)'] = '$1/admin/$2';
// $route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(:any)/(:any)'] = '$1/admin/$2/$3';
// $route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(:any)/(:any)/(:any)'] = '$1/admin/$2/$3/$4';
// $route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(:any)/(:any)/(:any)/(:any)'] = '$1/admin/$2/$3/$4/$5';
// $route[ADMIN_DASHBOARD_PATH.'/([a-zA-Z_-]+)/(:any)/(:any)/(:any)/(:any)/(:any)'] = '$1/admin/$2/$3/$4/$5/$6';

//search page routing
// $route['auction-search-result'] = 'home/auction_search_result';

// //auction pages routing
// $route['marketplace-auctions'] = 'home/auctions/marketplace';

// $route['category/(:num)'] = 'home/category/$1';
// $route['category/(:num)/(:any)'] = 'home/category/$1';

// $route['live-auction/(:num)/(:any)'] = 'home/live_auction_detail/$1';
// $route['buy-product/(:num)/(:any)'] = 'home/upcoming_auction_detail/$1';

// $rotue['user/logout']='user/logout/index';
// $route['user/(:num)'] = 'user/users/index/$1';
// $route['user/(:num)/(:any)'] = 'user/users/index/$1';

// $route['host-auction-detail/(:num)'] = 'user/users/host_auction_detail/$1';
// $route['host-auction-detail/(:num)/(:any)'] = 'user/users/host_auction_detail/$1';

// $route[BRAND.'(:any)'] = 'brand/brand/$1';
// $route[CREATOR.'(:any)'] = 'creator/creator/$1';
// //My Account Routing

// $route['paypal/paypal_ipn'] = 'my-account/paypal_ipn' ; 

// $route['my-messages/buyer_inbox'] = 'communication/mail/buyer_inbox';
// $route['my-messages/supplier_inbox'] = 'communication/mail/supplier_inbox';

// //routing for communication module
// $route['my-messages/inbox'] = 'communication/mail/inbox';
// $route['my-messages/outbox'] = 'communication/mail/outbox';
// $route['my-messages/conversation/(:any)/(:num)/(:num)'] = 'communication/mail/conversation/$1/$2/$3';
// $route['my-messages/buyer_inbox'] = 'communication/mail/buyer_inbox';
// $route['my-messages/outbox'] = 'communication/mail/outbox';
// $route['my-messages/conversation/(:any)/(:num)/(:num)'] = 'communication/mail/conversation/$1/$2/$3';


//for CMS pages
// $route['page/(:any)'] = 'cms/index/$1';

// //for help page
// $route['help'] = 'help/help/index';
// $route['help/(:any)'] = 'help/help/index/$1';



// $route[ADMIN_DASHBOARD_PATH.'/administrator/view/([a-zA-Z_-]+)/(:num)'] = 'administrator/admin/view/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/administrator/edit/([a-zA-Z_-]+)/(:num)'] = 'administrator/admin/edit/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/administrator/delete/([a-zA-Z_-]+)/(:num)'] = 'administrator/admin/delete/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/administrator/role/([a-zA-Z_-]+)/(:num)'] = 'administrator/admin/role/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/how-and-why/index/(:any)'] = 'how-and-why/admin/index/$1';
// $route[ADMIN_DASHBOARD_PATH.'/how-and-why/delete/(:num)/(:any)'] = 'how-and-why/admin/delete/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/members/edit_member/(:num)/(:num)'] = 'members/admin/edit_member/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/members/delete/(:num)/(:num)'] = 'members/admin/delete/$1/$2';
// $route[ADMIN_DASHBOARD_PATH.'/members/(:any)/(:num)/(:num)'] = 'members/admin/$1/$2/$3';
