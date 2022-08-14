<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;

class Admin extends BaseController
{

    use ResponseTrait;

    public function __construct()
    {
        helper('array');
    }

    /**
     * Used to view all user accounts (Only for users with admin level)
     * 
     */
    public function index()
    {
        $admin_m = new AdminModel();
        $accounts  = $admin_m->findAll();

        foreach ($accounts as $key => $account) {
            $account['last_login_at'] = get_time_ago(strtotime($account['last_login_at']));
            $accounts[$key]           = $account;
        }
        $data['accounts'] = $accounts;
        return view('Admin/index', $data);
    }

    /**
     * Used to view account infomation
     * 
     */
    public function profile()
    {
        //get id from store session
        $id = session()->get('id');
        if ($id == null) {
            return redirect()->to('/admin');
        }
        $admin_m = new AdminModel();
        $account = $admin_m->find($id);
        //yes, be careful never too much
        if (empty($account)) {
            return redirect()->to('/admin');
        }
        $data['account'] = $account;
        return view('Admin/profile', $data);
    }

    /**
     * Used to view create and update account page
     * 
     */
    public function detail()
    {

        $id = $this->request->getUri()->getSegment(3);
        if (!$id) {
            $data['title'] = "Thêm Mới Tài Khoản";
            return view('Admin/detail', $data);
        }
        $admin_m = new AdminModel();
        $account = $admin_m->find($id);
        if (empty($account)) {
            return redirect()->to('/admin');
        }
        $data['title'] = "Chỉnh Sửa Tài Khoản";
        $data['account'] = $account;
        return view('Admin/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated.
     *  
     */
    public function save()
    {
        $user_id  = $this->request->getPost('id');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level    = $this->request->getPost('level');
        $status   = $this->request->getPost('status');

        $inputs = array(
            'username' => $username,
            'password' => $password
        );

        $rules['username'] = 'required';
        //if create new user or update password, then require password validation
        if (!$user_id || !empty($password)) {
            $rules['password'] = 'required|min_length[3]';
        }

        $validation = service('validation');
        $validation->setRules($rules, custom_validation_error_message());
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            if (!$user_id) {
                return redirect_with_message(site_url('Admin/detail'), $error_msg);
            }
            return redirect_with_message(site_url('Admin/detail?id=') . $user_id, $error_msg);
        }

        $admin_m = new AdminModel();
        $user = $admin_m->where('username', $username)->first();
        if ($user) {
            $error_msg = 'Tài khoản đã tồn tại!';
            return redirect_with_message(site_url('Admin/detail'), $error_msg);
        }
        $data = [
            'username' => $username,
            'password' => $password,
            'level'    => $level,
            'status'   => $status
        ];

        if ($user_id) {
            $data['id'] = $user_id;
        }

        //if create failed, notice and redirect to register page again
        $is_save = $admin_m->save($data);
        if (!$is_save) {
            return redirect_with_message(site_url('Admin/detail'), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('admin');
    }

    /**
     * Used to delete account (Only for users with admin level)
     * 
     */
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        //if account id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        //cannot delete exclusive admin account, of course
        if ($id == 1) {
            return $this->respond(response_failed('Bạn không thể xoá tài khoản này!'), HTTP_OK);
        }

        $admin_m = new AdminModel();
        if ($admin_m->delete($id)) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
