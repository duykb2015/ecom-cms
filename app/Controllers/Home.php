<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MenuModel;
use App\Models\ProductItems;
use App\Models\ProductItemsModel;
use App\Models\ProductModel;

class Home extends BaseController
{

    /**
     * Used to view dashboard page
     * 
     */
    public function index()
    {
        $admin_m = new AdminModel();
        $menu_m = new MenuModel();
        $product_m = new ProductModel();
        $product_item_m = new ProductItemsModel();

        $total_users = count($admin_m->select('id')->findAll());
        $total_menu = count($menu_m->select('id')->findAll());
        $total_product = count($product_m->select('id')->findAll());
        $total_product_items = count($product_item_m->select('id')->findAll());

        //get total data in table from db
        $datas['total_users'] = $total_users;
        $datas['total_menu'] = $total_menu;
        $datas['total_product'] = $total_product;
        $datas['total_product_items'] = $total_product_items;
        return view('Home/index', $datas);
    }
}
