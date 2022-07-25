<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\admin_m;
use App\Models\AdminModel;

class Account extends BaseController
{

    /**
     * View all user account (admin only)
     * 
     */
    function index()
    {
        $admin_m = new AdminModel();
        //get all data from db
        $data['accounts'] = $admin_m->findAll();

        foreach ($data['accounts'] as $key => $account) {
            //encrypt data for security
            $account['email'] = encrypt_email($account['email']);
            $account['last_login_at'] = get_time_ago(strtotime($account['last_login_at']));
            $data['accounts'][$key] = $account;
        }
        return view('Account/index', $data);
    }

    /**
     * View account infomation
     * 
     */
    function profile()
    {
        $admin_m = new AdminModel();

        //get id from store session
        $uid = session()->get('id');

        $account = $admin_m->find($uid);

        if (empty($account)) {
            return redirect()->to('/');
        }

        $data['account'] = $account;

        //handel get request
        if (empty($this->request->getPost())) {

            return view('Account/profile', $data);
        }

        $error_msg = '';

        //get post data
        $new_password = $this->request->getPost('new_password');
        $old_password = $this->request->getPost('old_password');
        $email        = $this->request->getPost('email');

        $account_password = $data['account']['password'];
        $account_email    = $data['account']['email'];

        $datas = [];

        //if user want to change password
        if (!empty($new_password)) {

            if (empty($old_password)) {
                $error_msg = 'Mật khẩu cũ không được để trống!';
            } else {

                if (md5($old_password) != $account_password) {
                    $error_msg = 'Mật khẩu không đúng, vui lòng kiểm tra lại!';
                } else {

                    $datas['password'] = md5($new_password);
                }
            }
        }

        //if user want to change email
        if (!empty($email)) {
            if ($email != $account_email) {
                $datas['email'] = $email;
            }
        }

        //update account if data is not empty
        if (!empty($datas)) {

            //if update failed, notice and redirect to profile page
            if (!$admin_m->update($uid, $datas)) {
                $error_msg = 'Cập nhật thất bại, vui lòng thử lại!';
            } else {

                session()->setFlashdata('success', 'Cập nhật thành công!');
                return redirect()->to('/account/profile');
            }
        }

        session()->setFlashdata('error_msg', $error_msg);
        return view('Account/profile', $data);
    }

    /**
     * Create new account (admin only) 
     */
    function create()
    {
        //get the view
        if (empty($this->request->getPost())) {
            return view('Account/create');
        }

        //handel post request for create new account
        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $level    = !empty($this->request->getPost('level')) ? $this->request->getPost('level') : 1;

        $inputs = array(
            'username' => $username,
            'password' => $password
        );
        $validation = service('validation');

        $validation->setRules(
            [
                'username' => 'required',
                'password' => 'required|min_length[3]'
            ],
            //Custom error message
            [
                'username' => [
                    'required' => 'Tài khoản không được để trống!',
                ],
                'password' => [
                    'required' => 'Mật khẩu không được để trống!',
                    'min_length' => 'Mật khẩu phải có ít nhất 3 kí tự!',
                ],
            ]
        );

        $error_msg = '';

        if (!$validation->run($inputs)) {
            session()->setFlashdata('error_msg', $validation->getErrors());
            return redirect()->to(base_url('account/create'));
        } else {

            $admin_m = new AdminModel();
            $user = $admin_m->where('username', $username)->first();

            if ($user) {
                session()->setFlashdata('error_msg', 'Tài khoản đã tồn tại!');
                return redirect()->to(base_url('account/create'));
            }

            $user_email = $admin_m->where('email', $email)->first();

            if ($user_email) {
                session()->setFlashdata('error_msg', 'Email đã tồn tại!');
                return redirect()->to(base_url('account/create'));
            }

            $datas = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'level' => $level,
            ];

            //if create failed, notice and redirect to register page again
            if (!$admin_m->insert($datas)) {
                session()->setFlashdata('error_msg', 'Thêm mới thất bại');
                return redirect()->to(base_url('account/create'));
            }
        }

        session()->setFlashdata('error_msg', $error_msg);
        return redirect()->to(base_url('account'));
    }

    /**
     * Edit account infomation
     */
    function edit()
    {
        //get account id from url
        $uid = $this->request->getGet('uid');
        if (empty($uid)) {
            //if id is empty, redirect to account page
            return redirect()->to('/account');
        }

        //handle view request
        if (empty($this->request->getPost())) {

            //get data from db and show to view
            $admin_m = new AdminModel();
            $data['account'] = $admin_m->find($uid);

            return view('Account/edit', $data);
        }

        $admin_m = new AdminModel();
        $account = $admin_m->find($uid);

        //get post data
        $level = $this->request->getPost('level');

        if (empty($level)) {
            //if level is empty, set level to curent account level
            $level = $account['level'];
        }

        $datas = [
            'level' => $level,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$admin_m->update($account['id'], $datas)) {
            session()->setFlashdata('error', 'Sửa thông tin thất bại');
            return redirect()->to('account/edit?uid=' . $uid);
        }

        session()->setFlashdata('success', 'Sửa thông tin thành công');
        return redirect()->to('/account');
    }
}
