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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('activacion/(:num)', 'UsersRestController::activar/$1', ['as' => 'registro-activar']);

$routes->group('api', function($routes) {
    $routes->group('user', function($routes) {
        $routes->post('create', 'UsersRestController::create');
        $routes->post('login', 'UsersRestController::login');        
        $routes->get('findall', 'UsersRestController::findAll');
        $routes->get('find/(:any)', 'UsersRestController::find/$1');
        $routes->put('update', 'UsersRestController::update');
        $routes->put('updatepass', 'UsersRestController::updatePass');
        $routes->delete('delete/(:any)', 'UsersRestController::delete/$1');
    });
    $routes->group('province', function($routes) {
        $routes->post('create', 'ProvincesRestController::create');
        $routes->get('findall', 'ProvincesRestController::findAll');
        $routes->get('find/(:any)', 'ProvincesRestController::find/$1');
        $routes->put('update', 'ProvincesRestController::update');
        $routes->delete('delete/(:any)', 'ProvincesRestController::delete/$1');
    });
    $routes->group('city', function($routes) {
        $routes->post('create', 'CitiesRestController::create');
        $routes->get('findall', 'CitiesRestController::findAll');
        $routes->get('find/(:any)', 'CitiesRestController::find/$1');
        $routes->get('findByProvince/(:any)', 'CitiesRestController::findByProvince/$1');
        $routes->put('update', 'CitiesRestController::update');
        $routes->delete('delete/(:any)', 'CitiesRestController::delete/$1');
    });
    $routes->group('category', function($routes) {      
        $routes->post('create', 'CategoriesRestController::create'); 
        $routes->get('findall', 'CategoriesRestController::findAll');
        $routes->get('find/(:any)', 'CategoriesRestController::find/$1');       
        $routes->get('getList', 'CategoriesRestController::getListCategories');       
    });

    $routes->group('activity', function($routes) {      
        $routes->post('create', 'ActivitiesRestController::create'); 
        $routes->get('findall', 'ActivitiesRestController::getActivities');
        $routes->get('find/(:any)', 'ActivitiesRestController::find/$1', ['as' => 'card-activity']);       
    });

    $routes->group('profile', function($routes) {      
        $routes->post('create', 'ProfilesRestController::create'); 
        $routes->get('findall/(:any)', 'ProfilesRestController::findAll');
        $routes->get('find/(:any)', 'ProfilesRestController::find/$1');       
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
