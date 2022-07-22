<?php

namespace App\Controllers\Dashboard;

class Home extends AdminController
{
    public function index()
    {
        return view('Dashboard/Home/index');
    }
}
