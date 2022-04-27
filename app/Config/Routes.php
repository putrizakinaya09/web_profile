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
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('/login', 'AuthController::index');
$routes->get('/sign-up', 'AuthController::signup');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/auth/login', 'AuthController::login');
$routes->post('/auth/store', 'AuthController::store');

$routes->get('/page/(:any)', 'PageController::index/$1', ['filter' => 'auth']);
$routes->post('/page/(:any)/store', 'PageController::store/$1', ['filter' => 'auth']);

$routes->get('/page-types', 'PageTypeController::index', ['filter' => 'auth']);
$routes->get('/page-types/create', 'PageTypeController::create', ['filter' => 'auth']);
$routes->get('/page-types/(:num)/delete', 'PageTypeController::delete/$1', ['filter' => 'auth']);
$routes->get('/page-types/(:num)/edit', 'PageTypeController::edit/$1', ['filter' => 'auth']);
$routes->post('/page-types/store', 'PageTypeController::store', ['filter' => 'auth']);
$routes->post('/page-types/update', 'PageTypeController::update', ['filter' => 'auth']);

$routes->get('/article-categories', 'ArticleCategoriesController::index', ['filter' => 'auth']);
$routes->get('/article-categories/create', 'ArticleCategoriesController::create', ['filter' => 'auth']);
$routes->get('/article-categories/(:num)/delete', 'ArticleCategoriesController::delete/$1', ['filter' => 'auth']);
$routes->get('/article-categories/(:num)/edit', 'ArticleCategoriesController::edit/$1', ['filter' => 'auth']);
$routes->post('/article-categories/store', 'ArticleCategoriesController::store', ['filter' => 'auth']);
$routes->post('/article-categories/update', 'ArticleCategoriesController::update', ['filter' => 'auth']);

$routes->get('/articles', 'ArticleController::index', ['filter' => 'auth']);
$routes->get('/articles/create', 'ArticleController::create', ['filter' => 'auth']);
$routes->get('/articles/(:num)/delete', 'ArticleController::delete/$1', ['filter' => 'auth']);
$routes->get('/articles/(:num)/edit', 'ArticleController::edit/$1', ['filter' => 'auth']);
$routes->post('/articles/store', 'ArticleController::store', ['filter' => 'auth']);
$routes->post('/articles/update', 'ArticleController::update', ['filter' => 'auth']);

$routes->get('/berita', 'BeritaController::index');
$routes->get('/berita/(:any)', 'BeritaController::detail/$1');
$routes->get('/(:any)', 'Home::index/$1');


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
