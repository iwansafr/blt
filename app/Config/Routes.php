<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

$routes->resource('user', ['controller' => 'UserController']);

$routes->get('/blt/excel', 'BltController::excel');
$routes->get('/blt/desa', 'BltController::list/6');
$routes->get('/blt/kecamatan', 'BltController::list/5');
$routes->get('/blt/dinsos', 'BltController::list/4');
$routes->get('/blt/provinsi', 'BltController::list/3');
$routes->get('/blt/kementerian', 'BltController::list/2');
$routes->put('/blt/valid/(:num)', 'BltController::valid/$1');

$routes->resource('blt', ['controller' => 'BltController']);


$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::auth');
$routes->get('/logout', 'UserController::logout');

$routes->get('/saran', 'InboxController::list/1');
$routes->get('/saran/(:num)', 'InboxController::detail/$1');
$routes->post('/saran', 'InboxController::inboxin/1');
$routes->get('/masukkan/(:num)', 'InboxController::detail/$1');
$routes->get('/masukkan', 'InboxController::list/2');
$routes->post('/masukkan', 'InboxController::inboxin/2');
$routes->post('/pertanyaan', 'InboxController::inboxin/3');
$routes->get('/pertanyaan/(:num)', 'InboxController::detail/$1');
$routes->get('/pertanyaan', 'InboxController::list/3');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
