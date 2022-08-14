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

        $routes->get('detail', 'Admin::detail');
        $routes->get('detail/:any', 'Admin::detail');

        $routes->post('save', 'Admin::save');
        $routes->post('save/:any', 'Admin::save');

        $routes->post('delete', 'Admin::delete');
    });

    $routes->group('menu', function ($routes) {
        $routes->get('', 'Menu::index');

        $routes->get('detail', 'Menu::detail');
        $routes->get('detail/:any', 'Menu::detail');

        $routes->post('save', 'Menu::save');
        $routes->post('save/:any', 'Menu::save');

        $routes->post('action-status', 'Menu::change_status');

        $routes->post('delete', 'Menu::delete');
    });

    $routes->group('product-category', function ($routes) {
        $routes->get('', 'ProductCategory::index');

        $routes->get('detail', 'ProductCategory::detail');
        $routes->get('detail/:any', 'ProductCategory::detail');

        $routes->post('save', 'ProductCategory::save');
        $routes->post('save/:any', 'ProductCategory::save');

        $routes->post('action-status', 'ProductCategory::change_status');

        $routes->post('delete', 'ProductCategory::delete');
    });

    $routes->group('product-attribute', function ($routes) {
        $routes->get('', 'ProductAttributes::index');

        $routes->get('detail', 'ProductAttributes::detail');
        $routes->get('detail/:any', 'ProductAttributes::detail');

        $routes->post('save', 'ProductAttributes::save');
        $routes->post('save/:any', 'ProductAttributes::save');

        $routes->post('action-status', 'ProductAttributes::change_status');

        $routes->post('delete', 'ProductAttributes::delete');
    });

    $routes->group('product-line', function ($routes) {
        $routes->get('', 'Product::index');

        $routes->get('detail', 'Product::detail');
        $routes->get('detail/:any', 'Product::detail');

        $routes->post('save', 'Product::save');
        $routes->post('save/:any', 'Product::save');

        $routes->post('action-status', 'Product::change_status');

        $routes->post('delete', 'Product::delete');
    });

    $routes->group('product-item', function ($routes) {
        $routes->get('', 'ProductItem::index');
        $routes->post('', 'ProductItem::index');

        $routes->get('detail', 'ProductItem::detail');
        $routes->get('detail/:any', 'ProductItem::detail');

        //the first :any is product_item_id, the second :any is product_item_color_id
        //The name for this router is not quite right
        $routes->post('delete-color', 'ProductItem::delete_color');
        $routes->post('delete-image', 'ProductItem::delete_image');

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
