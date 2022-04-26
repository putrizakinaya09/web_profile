<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::store');
$routes->get('/matakuliah', 'MatakuliahController::index');
$routes->get('/matakuliah/create', 'MatakuliahController::create');
$routes->get('/matakuliah/(:num)/delete', 'MatakuliahController::delete/$1');
$routes->get('/matakuliah/(:num)/edit', 'MatakuliahController::edit/$1');
$routes->post('/matakuliah/store', 'MatakuliahController::store');
$routes->post('/matakuliah/update', 'MatakuliahController::update');
$routes->get('/mahasiswa', 'MahasiswaController::index');
$routes->get('/mahasiswa/create', 'MahasiswaController::create');
$routes->get('/mahasiswa/(:num)/delete', 'MahasiswaController::delete/$1');
$routes->get('/mahasiswa/(:num)/edit', 'MahasiswaController::edit/$1');
$routes->post('/mahasiswa/store', 'MahasiswaController::store');
$routes->post('/mahasiswa/update', 'MahasiswaController::update');


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
