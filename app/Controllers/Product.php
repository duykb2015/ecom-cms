<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Product extends BaseController
{
    /**
     * Comming soon...
     */
    function index()
    {
        $data['test'] = 'Kiểm tra thử dữ liệu';
        return view('Product/index', $data);
    }

    /**
     * Comming soon...
     * 
     */
    function view()
    {
        $data['title'] = 'Thêm sản phẩm mới';
        return view('Product/create', $data);
    }
}
