<?php

namespace App\Controllers\Dashboard;

class Service extends AdminController
{
    function index() {
        $data['test'] = 'Kiểm tra thử dữ liệu';
        return view('Dashboard/Service/index', $data);
    }
}
