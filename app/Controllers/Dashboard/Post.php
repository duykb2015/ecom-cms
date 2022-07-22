<?php

namespace App\Controllers\Dashboard;


class Post extends AdminController
{
    function index() {
        $data['test'] = 'Kiểm tra thử dữ liệu';
        return view('Dashboard/Post/index', $data);
    }
}
