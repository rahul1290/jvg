<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'auth';

$route['master/vendor'] = 'Vendor/index';
$route['master/product'] = 'Product/index';
$route['purchase/list'] = 'Purchase/purchase_list';
$route['master/user'] = 'User/index';
$route['master/customer'] = 'Customer/index';
$route['master/broker'] = 'Broker/index';
$route['purchase/edit/(:any)'] = 'purchase/bill_entry_update/$1';
$route['bill/bill-generate'] = 'Sales';
$route['bill/bill-list'] = 'Sales/bill_list';
$route['sales/new-order'] = 'Sales/sale_order';
$route['sales/order-list'] = 'Sales/sales_list';
$route['sales/order/edit/(:any)'] = 'Sales/sale_order_update/$1';

$route['Dashboard'] = 'Report_ctrl';
$route['report/product-stock'] = 'Report_ctrl';
$route['report/prchase-n-sales'] = 'Report_ctrl/purchase_sales';
$route['report/prchase-n-sales/(:any)'] = 'Report_ctrl/purchase_sales/$1';
$route['report/vendor-report'] = 'Report_ctrl/vendor_report';
$route['report/vendor-prchase-n-sales'] = 'Report_ctrl/vendor_purchase_sales';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
