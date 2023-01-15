<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('activacion/(:num)', 'UsersRestController::activar/$1', ['as' => 'registro-activar']);
$routes->options('(:any)', '', ['filter' => 'cors']);

$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->group('user', function($routes) {
        $routes->post('create', 'UsersRestController::create');
        $routes->post('login', 'UsersRestController::login');
        $routes->get('find/(:any)', 'UsersRestController::find/$1');
        $routes->put('updatepass', 'UsersRestController::updatePass');
    });

    $routes->group('province', function($routes) {
        $routes->get('findall', 'ProvincesRestController::findAll');
    });

    $routes->group('city', function($routes) {
        $routes->get('findByProvince/(:any)', 'CitiesRestController::findByProvince/$1');
    });

    $routes->group('category', function($routes) {      
        $routes->get('findall', 'CategoriesRestController::findAll');             
    });

    $routes->group('activity', function($routes) {      
        $routes->post('create', 'ActivitiesRestController::create'); 
        $routes->post('findall', 'ActivitiesRestController::getActivities');       
    });

    $routes->group('profile', function($routes) {      
        $routes->post('create', 'ProfilesRestController::create'); 
        $routes->put('update', 'ProfilesRestController::update'); 
        $routes->put('updatePicture', 'ProfilesRestController::updatePicture'); 
        $routes->get('find/(:any)', 'ProfilesRestController::find/$1');       
    });

    $routes->group('requests', function($routes) {      
        $routes->post('create', 'RequestsRestController::create');     
        $routes->post('update', 'RequestsRestController::update');
        $routes->get('getRequests/(:any)', 'RequestsRestController::getRequests/$1');
        $routes->get('getRequestsByactivities/(:any)', 'RequestsRestController::getRequestsByactivities/$1');
        $routes->get('lastRequests', 'RequestsRestController::lastFinishedRequests');     
    });

    $routes->group('contact', function ($routes) {
        $routes->post('index', 'ContactRestController::index');
    });
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
