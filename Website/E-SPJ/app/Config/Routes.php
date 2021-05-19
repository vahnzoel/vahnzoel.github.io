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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/profil/(:segment)', 'User::edit/$1');
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');
$routes->get('/crprogram', 'Program::create');
$routes->get('/edprogram/(:segment)', 'Program::edit/$1');
$routes->delete('/delprogram/(:num)', 'Program::delete/$1');
$routes->get('/crkegiatan', 'Kegiatan::create');
$routes->get('/edkegiatan/(:segment)', 'Kegiatan::edit/$1');
$routes->delete('/delkegiatan/(:num)', 'Kegiatan::delete/$1');
$routes->get('/crsubkegiatan', 'Subkegiatan::create');
$routes->get('/edsubkegiatan/(:segment)', 'Subkegiatan::edit/$1');
$routes->delete('/delsubkegiatan/(:num)', 'Subkegiatan::delete/$1');
$routes->get('/critem', 'Item::create');
$routes->get('/editem/(:segment)', 'Item::edit/$1');
$routes->delete('/delitem/(:num)', 'Item::delete/$1');
$routes->get('/spj', 'SPJ::index');
$routes->post('/spj/save', 'SPJ::save');
$routes->get('/crspj', 'SPJ::create');
$routes->get('/edspj/(:segment)', 'SPJ::edit/$1');
$routes->delete('/delspj/(:num)', 'SPJ::delete/$1');
$routes->get('/cruser', 'User::create');
$routes->delete('/deluser/(:num)', 'User::delete/$1');

/*
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
