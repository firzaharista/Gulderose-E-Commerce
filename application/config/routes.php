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
$route['default_controller']        = 'home';
$route['404_override']              = '';
$route['translate_uri_dashes']      = FALSE;

$route['profil']                    = 'page/company';
$route['product/allproducts']       = 'product/allproducts';
$route['my-account']                = 'auth/my_account';

$route['my-account/edit-account/(:any)']     = 'auth/update_account/$1';
$route['user-login']                = 'auth/login';
$route['log-out']                   = 'auth/logout';
$route['create-account']            = 'auth/register';
$route['how-to-order']              = 'page/how_to_order';
$route['about-us']                  = 'page/about_us';
$route['contact-us']                = 'page/contact_us';
$route['terms-of-service']          = 'page/terms_of_service';

$route['payment-confirmation']      = 'payment/payment_confirmation';
$route['payment-confirmation-form/(:any)'] = 'payment/payment_confirmation_form/$1';
$route['payment-confirmation/payment-done'] = 'payment/send_payment_confirmation';


$route['product/all-products']                 = 'product/allproducts';
$route['product/(:any)']                       = 'product/read/$1';
$route['product/all-products/(:any)']          = 'product/allproducts';
$route['product/all-products/(:any)/(:any)']   = 'product/allproducts';
$route['product-category/(:any)']              = 'product_category/read/$1';
$route['product-category/(:any)/(:any)']       = 'product_category/read/$1/$1';
$route['product-category/(:any)/(:any)/(:any)']= 'product_category/read/$1/$1/$1';

$route['checkout/process']                  = 'cart/checkout_process';
$route['checkout/order-information']        = 'cart/order_information';
$route['checkout/finished']                 = 'cart/checkout_finished';
$route['download-invoice/(:any)']   = 'cart/download_invoice/$1';

$route['order-details/(:any)']      = 'auth/order_history_details/$1';



// BAGIAN ADMIN
$route['admin_gulderose/penjualan/pembayaran-diterima-dan-diproses'] = 'admin_gulderose/penjualan/pembayaran_diterima_dan_diproses';
$route['admin_gulderose/penjualan/dikirim']           = 'admin_gulderose/penjualan/orderan_dikirim';
$route['admin_gulderose/penjualan/dibatalkan']        = 'admin_gulderose/penjualan/orderan_dibatalkan';
$route['admin_gulderose/penjualan/belum-konfirmasi']  = 'admin_gulderose/penjualan/belum_konfirmasi';
$route['admin_gulderose/penjualan/sudah-konfirmasi']  = 'admin_gulderose/penjualan/sudah_konfirmasi';