<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MenuModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $admin_m = new AdminModel();
        $menu_m = new MenuModel();
       // $product_m = new ProductModel();

       //get total data in table from db
        $datas['total_users'] = count($admin_m->select('id')->findAll());
        $datas['total_menus'] = count($menu_m->select('id')->findAll());
        return view('Home/index', $datas);
    }
}
