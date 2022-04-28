<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    =   'login';
$route['404_override']          =   '';
$route['translate_uri_dashes']  =   FALSE;


$route['it-helpdesk']                   =   'helpdesk';
$route['it-helpdesk/request-a-ticket']  =   'helpdesk/request_a_ticket';
$route['it-helpdesk/issues-list']       =   'helpdesk/issues_list';