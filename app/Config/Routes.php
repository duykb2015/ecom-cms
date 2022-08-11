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

$routes->get('login', 'Login::index');
$routes->post('login', 'Login::authentication');

$routes->get('logout', 'Login::logout');

$routes->group("/", ["filter" => "auth-admin"], function ($routes) { //
    $routes->get('', 'Home::index');

    $routes->group('admin', function ($routes) {
        $routes->get('', 'Admin::index');

        $routes->get('profile', 'Admin::profile');
        $routes->post('profile', 'Admin::change_profile');

        $routes->get('save', 'Admin::view');
        $routes->get('save/:any', 'Admin::view');

        $routes->post('save', 'Admin::save');
        $routes->post('save/:any', 'Admin::save');

        $routes->post('delete', 'Admin::delete');
    });

    $routes->group('menu', function ($routes) {
        $routes->get('', 'Menu::index');

        $routes->get('save', 'Menu::view');
        $routes->get('save/:any', 'Menu::view');

        $routes->post('save', 'Menu::save');
        $routes->post('save/:any', 'Menu::save');

        $routes->post('action-status', 'Menu::change_status');

        $routes->post('delete', 'Menu::delete');
    });

    $routes->group('product-category', function ($routes) {
        $routes->get('', 'Category::index');

        $routes->get('save', 'Category::view');
        $routes->get('save/:any', 'Category::view');

        $routes->post('save', 'Category::save');
        $routes->post('save/:any', 'Category::save');

        $routes->post('action-status', 'Category::change_status');

        $routes->post('delete', 'Category::delete');
    });

    $routes->group('product-attribute', function ($routes) {
        $routes->get('', 'ProductAttributes::index');
        $routes->post('', 'ProductAttributes::index');

        $routes->get('save', 'ProductAttributes::view');
        $routes->get('save/:any', 'ProductAttributes::view');

        $routes->post('save', 'ProductAttributes::save');
        $routes->post('save/:any', 'ProductAttributes::save');

        $routes->post('action-status', 'ProductAttributes::change_status');

        $routes->post('delete', 'ProductAttributes::delete');
    });

    $routes->group('product-line', function ($routes) {
        $routes->get('', 'Product::index');
        $routes->post('', 'Product::index');

        $routes->get('save', 'Product::view');
        $routes->get('save/:any', 'Product::view');

        $routes->post('save', 'Product::save');
        $routes->post('save/:any', 'Product::save');

        $routes->post('action-status', 'Product::change_status');

        $routes->post('delete', 'Product::delete');
    });

    $routes->group('product-item', function ($routes) {
        $routes->get('', 'ProductItem::index');
        $routes->post('', 'ProductItem::index');

        $routes->get('save', 'ProductItem::view');
        $routes->get('save/:any', 'ProductItem::view');

        $routes->post('save', 'ProductItem::save');
        $routes->post('save/:any', 'ProductItem::save');


        $routes->post('delete', 'ProductItem::delete');
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
