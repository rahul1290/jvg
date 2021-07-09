<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';

$route['master/vendor'] = 'Vendor/index';
$route['master/product'] = 'Product/index';
$route['purchase/list'] = 'Purchase/purchase_list';
$route['master/user'] = 'User/index';
$route['master/customer'] = 'Customer/index';

$route['sales/new-order'] = 'Sales';
$route['Dashboard'] = 'Stock';
$route['stock'] = 'Stock';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
