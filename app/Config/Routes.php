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

    $routes->group('user', function ($routes) {
        $routes->get('', 'User::index');
        $routes->get('get-shoping-cart', 'User::get_shoping_cart');

        $routes->get('profile', 'User::profile');
        $routes->post('profile', 'User::change_profile');

        $routes->get('detail', 'User::detail');
        $routes->get('detail/:any', 'User::detail');

        $routes->post('save', 'User::save');
        $routes->post('save/:any', 'User::save');

        $routes->post('delete', 'User::delete');
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
        $routes->get('', 'Product\Category::index');

        $routes->get('detail', 'Product\Category::detail');
        $routes->get('detail/:any', 'Product\Category::detail');

        $routes->post('save', 'Product\Category::save');
        $routes->post('save/:any', 'Product\Category::save');

        $routes->post('action-status', 'Product\Category::change_status');

        $routes->post('delete', 'Product\Category::delete');
    });

    $routes->group('product-attribute', function ($routes) {
        $routes->get('', 'Product\Attribute::index');

        $routes->get('detail', 'Product\Attribute::detail');
        $routes->get('detail/:any', 'Product\Attribute::detail');

        $routes->post('save', 'Product\Attributes::save');
        $routes->post('save/:any', 'Product\Attribute::save');

        $routes->post('action-status', 'Product\Attribute::change_status');

        $routes->post('delete', 'Product\Attribute::delete');
    });

    $routes->group('product-line', function ($routes) {
        $routes->get('', 'Product\Line::index');

        $routes->get('detail', 'Product\Line::detail');
        $routes->get('detail/:any', 'Product\Line::detail');

        $routes->post('save', 'Product\Line::save');
        $routes->post('save/:any', 'Product\Line::save');

        $routes->post('action-status', 'Product\Line::change_status');

        $routes->post('delete', 'Product\Line::delete');
    });

    $routes->group('product-item', function ($routes) {
        $routes->get('', 'Product\Item::index');
        $routes->post('', 'Product\Item::index');

        $routes->get('detail', 'Product\Item::detail');
        $routes->get('detail/:any', 'Product\Item::detail');

        //the first :any is product_item_id, the second :any is product_item_color_id
        //The name for this router is not quite right
        $routes->get('delete-color/:any/:any', 'Product\Item::delete_color');
        $routes->get('delete-image/:any/:any', 'Product\Item::delete_image');

        $routes->post('save', 'Product\Item::save');
        $routes->post('save/:any', 'Product\Item::save');

        $routes->post('delete', 'Product\Item::delete');
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
