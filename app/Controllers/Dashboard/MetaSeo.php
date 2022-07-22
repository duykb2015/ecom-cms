<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class MetaSeo extends AdminController
{
    use ResponseTrait;

    public function index()
    {
        $data = [];
        return view('Dashboard/MetaSeo/index', $data);
    }

    public function view()
    {
        $data = [];
        return view('Dashboard/MetaSeo/index', $data);
    }
}
