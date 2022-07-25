<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
    function index() {
        $data['test'] = 'Kiểm tra thử dữ liệu';
        return view('Product/index', $data);
    }
}
