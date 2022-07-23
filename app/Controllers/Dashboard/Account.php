<?php

namespace App\Controllers\Dashboard;

use App\Models\AdminModel;

class Account extends AdminController
{
    function index()
    {
        $adminModel = new AdminModel();
        $data['accounts'] = $adminModel->findAll();

        $processed_data['accounts'] = [];
        foreach ($data['accounts'] as $account) {
            $account['level'] = $this->get_level_name($account['level']);
            $account['created_at'] = date('d/m/Y', strtotime($account['created_at']));
            $account['updated_at'] = date('d/m/Y', strtotime($account['updated_at']));
            $account['last_login_at'] = $this->get_time_ago(strtotime($account['last_login_at']));
            $processed_data['accounts'][] = $account;
        }
        return view('Dashboard/Account/index', $processed_data);
    }

    function profile()
    {
        if (!empty($this->request->getPost())) {
        } else {

            $data['test'] = 'Kiểm tra thử dữ liệu';
            return view('Dashboard/Account/profile', $data);
        }
    }

    function save()
    {
        if (!empty($this->request->getPost())) {
        } else {
            $data['title'] = 'Chỉnh sửa tài khoản';
            $data['test'] = 'Kiểm tra thử dữ liệu';
            return view('Dashboard/Account/save', $data);
        }
    }

    function get_level_name(int $level)
    {
        $level_name = '';
        switch ($level) {
            case 3:
                $level_name = '<span style="color:red">Admin</span>';
                break;
            case 2:
                $level_name = '<span style="color:blue">Moderator</span>';
                break;
            case 1:
                $level_name = 'Member';
                break;
            default:
                $level_name = 'Member';
                break;
        }
        return $level_name;
    }

    function get_time_ago($time)
    {
        $time_difference = time() - $time;

        if ($time_difference < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(
            12 * 30 * 24 * 60 * 60 =>  'năm',
            30 * 24 * 60 * 60       =>  'tháng',
            24 * 60 * 60            =>  'ngày',
            60 * 60                 =>  'giờ',
            60                      =>  'phút',
            1                       =>  'giây'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return $t . ' ' . $str . ' trước';
            }
        }
    }
}
