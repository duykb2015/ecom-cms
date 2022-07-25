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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ["filter" => "auth-admin"]);

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login_validate');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register_validate');

$routes->get('logout', 'Auth::logout');

$routes->group("/", ["filter" => "auth-admin"], function ($routes) { //
    $routes->get('', 'Home::index');

    $routes->group('account', function ($routes) {
        $routes->get('', 'Account::index');
        
        $routes->get('profile', 'Account::profile');
        $routes->post('profile', 'Account::profile');

        $routes->get('create', 'Account::create');
        $routes->post('create', 'Account::create');

        $routes->get('edit', 'Account::edit');
        $routes->post('edit', 'Account::edit');
    });

    $routes->group('menu', function ($routes) {
        $routes->get('', 'Menu::index');
        $routes->get('create', 'Menu::view');

        $routes->post('create', 'Menu::create');
        $routes->post('action-status', 'Menu::action_status');

        $routes->post('delete', 'Menu::delete');
    });

    $routes->group('product', function ($routes) {
        $routes->get('', 'Product::index');
        $routes->get('create', 'Menu::view');
        $routes->post('create', 'Menu::create');
        $routes->post('action-status', 'Menu::action_status');
        $routes->post('delete', 'Menu::delete');
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
