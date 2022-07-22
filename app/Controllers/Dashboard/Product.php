<?php

namespace App\Controllers\Dashboard;

use App\Models\ProductModel;

class Product extends AdminController
{
    function index() {
        $data['test'] = 'Kiểm tra thử dữ liệu';
        return view('Dashboard/Product/index', $data);
    }
}
