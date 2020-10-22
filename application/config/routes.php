<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['heritage']                                     			 	= 'heritage/api_get_heritage';
$route['heritage/api_get_single_heritage']              		 	= 'heritage/api_get_single_heritage';
$route['heritage/api_get_promoted_heritage']            		 	= 'heritage/api_get_promoted_heritage';
$route['heritage/api_update_promotion_flag']                     	= 'heritage/api_update_promotion_flag';
$route['heritage/api_get_promoted_heritage_single']              	= 'heritage/api_get_promoted_heritage_single';
$route['heritage/api_recommend_heritage_status']        			= 'heritage/api_recommend_heritage_status';
$route['heritage/api_send_heritage_status']             			= 'heritage/api_send_heritage_status';
$route['heritage/api_check_if_user_recommend_heritage']				= 'heritage/api_check_if_user_recommend_heritage';



$route['heritage/heritage_detail/(:any)']							= 'heritage/heritage_detail_view_in_woreda/$1';
//$route['heritage/update_zone_approval/(:any)']		      			= 'heritage/update_zone_approval/$1';


$route['heritage/register_heritage_home']                  			= 'heritage/register_heritage_home';
$route['heritage/woreda_registeral_registration_form_one'] 			= 'heritage/woreda_registeral_registration_form_one';
$route['heritage/woreda_registeral_registration_form_two'] 			= 'heritage/woreda_registeral_registration_form_two';
$route['heritage/woreda_registeral_registration_form_three']        = 'heritage/woreda_registeral_registration_form_three';
$route['heritage/dependent_load_zone']								= 'heritage/dependent_load_zone';
$route['heritage/dependent_load_woreda'] 							= 'heritage/dependent_load_woreda';
$route['heritage/dependent_load_kebele']							= 'heritage/dependent_load_kebele';
$route['heritage/chart_woreda_name_with_aboundace']					= 'heritage/chart_woreda_name_with_aboundace';


//route heritage detail info that registerd only in woreda


$route['employee']                                     				= 'employee/register_index';
$route['employee/employee_registration_two']						= 'employee/employee_registration_two';
$route['employee/logic_employee_registration_last']					= 'employee/logic_employee_registration_last';

//route guiders
$route['guiders/api_get_all_guiders']			                    = 'guiders/api_get_all_guiders';
$route['guiders/api_update_profile']							    = 'guiders/api_update_profile';
$route['guiders/api_get_single_guider']								= 'guiders/api_get_single_guider';

//route login 
$route['login/load_language_val_setting']                           = 'login/load_language_val_setting';
$route['login/api_login_as_employee']     							= 'login/api_login_as_employee';
$route['login/api_login_as_guider']      						    = 'login/api_login_as_guider';
$route['login/api_login_as_tourist']      							= 'login/api_login_as_tourist';
$route['login']					          							= 'login/index';     

$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
