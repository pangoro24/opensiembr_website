<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['device'] = 'front/device';
$route['app'] = 'front/app';
$route['how-to-work'] = 'front/how_to_work';
$route['blog'] = 'front/blog';
$route['blog/view/(:num)'] = 'front/blog/view/$1';
$route['help'] = 'front/help';
$route['shop'] = 'front/shop';
$route['shop/product/(:num)'] = 'front/shop/product/$1';
$route['channel'] = 'front/channel';
$route['channel/view/(:num)'] = 'front/channel/view/$1';

// Config Back-End user
$route['(:any)/config/(:any)'] = 'config/config/$2';

// API
$route['api/register'] = 'api/login/register';

// Administrador
$route['login'] = 'front/login';
$route['logout'] = 'front/login/logout';
$route['register'] = 'front/login/register';
$route['login/auth'] = 'front/login/auth';
