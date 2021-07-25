<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';

$route['master/vendor'] = 'Vendor/index';
$route['master/product'] = 'Product/index';
$route['purchase/list'] = 'Purchase/purchase_list';
$route['master/user'] = 'User/index';
$route['master/customer'] = 'Customer/index';
$route['master/broker'] = 'Broker/index';

$route['bill/bill-generate'] = 'Sales';
$route['bill/bill-list'] = 'Sales/bill_list';
$route['sales/new-order'] = 'Sales/sale_order';
$route['sales/order-list'] = 'Sales/sales_list';
$route['Dashboard'] = 'Stock';
$route['stock'] = 'Stock';
$route['report/vendor'] = 'Vendor/report';
$route['report/broker'] = 'Broker/report';
$route['report/purchase-order'] = 'Purchase/purchase_order_report';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
