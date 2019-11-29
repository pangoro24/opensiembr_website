<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'CommingSoon';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['device'] = 'front/device';
$route['app'] = 'front/app';
$route['how-to-work'] = 'front/how_to_work';
$route['blog'] = 'front/blog';
$route['help'] = 'front/help';

// API
$route['api/register'] = 'api/login/register';

// Administrador
$route['login'] = 'front/login';
$route['logout'] = 'front/login/logout';
$route['register'] = 'front/login/register';
$route['login/auth'] = 'front/login/auth';
