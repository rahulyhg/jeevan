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

$route['default_controller'] = 'frontend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['adminpanel'] = 'adminpanel';
$route['program'] = 'frontend/events';
$route['livetv'] = 'frontend/livetv';
$route['live_tv'] = 'frontend/live_tv';
//$route['security'] = 'frontend/security';
$route['databases'] = 'frontend/databases';
$route['settings'] = 'frontend/settings';

$route['done'] = 'frontend/done';
$route['(:any)'] = 'frontend/pages/$1';
$route['gallery/(:any)'] = 'frontend/gallery/$1';
$route['blog/(:any)'] = 'frontend/blog/$1';
$route['discourse/(:any)'] = 'frontend/discourse/$1';
$route['newsletterunsubscribe/(:any)'] = 'frontend/newsletterunsubscribe/$1';
$route['newslettersubscribe/(:any)'] = 'frontend/newslettersubscribe/$1';
$route['accountactivation/(:any)'] = 'frontend/accountactivation/$1';
$route['resetpassword/(:any)'] = 'frontend/resetpassword/$1';
$route['dashboard/(:any)'] = 'frontend/dashboard/$1';
/*$route['accountactivation/(:any)'] = 'frontend/accountactivation/$1';
$route['resetpassword/(:any)'] = 'frontend/resetpassword/$1';
$route['(:any)'] = 'frontend/myaccount/$1';
*/

