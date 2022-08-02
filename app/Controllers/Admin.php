<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;

class Admin extends BaseController
{

    use ResponseTrait;

    /**
     * Used to view all user accounts (Only for users with admin level)
     * 
     */
    function index()
    {
        $admin_m = new AdminModel();
        $data['accounts'] = $admin_m->findAll();

        foreach ($data['accounts'] as $key => $account) {
            // $account['email'] = encrypt_email($account['email']);
            //change format of date
            $account['last_login_at'] = get_time_ago(strtotime($account['last_login_at']));
            $data['accounts'][$key] = $account;
        }
        return view('Admin/index', $data);
    }

    /**
     * Used to view account infomation
     * 
     */
    function profile()
    {

        //get id from store session
        $uid = session()->get('id');

        $admin_m = new AdminModel();
        $account = $admin_m->find($uid);

        if (empty($account)) {
            return redirect()->to('/');
        }

        $data['account'] = $account;

        //this is handle get request

        return view('Admin/profile', $data);
    }

    /**
     * Used to update account infomation
     * 
     */

    public function change_profile()
    {

        $uid = session()->get('id');

        $admin_m = new AdminModel();
        $account = $admin_m->find($uid);

        if (empty($account)) {
            return redirect()->to('/');
        }

        $error_msg = '';

        $new_password = $this->request->getPost('new_password');
        $old_password = $this->request->getPost('old_password');
        $email        = $this->request->getPost('email');

        $account_password = $account['password'];
        $account_email    = $account['email'];

        $datas = [];

        //if user want to change password
        if (!empty($new_password)) {

            $is_password_match = md5($old_password) === $account_password;
            if (empty($old_password) || $is_password_match == false) {

                $error_msg = 'Mật khẩu cũ không đúng, vui lòng kiểm tra lại!';
                return redirect_with_message(site_url('admin/profile'), $error_msg);
            } else {

                $datas['password'] = md5($new_password);
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
                return redirect_with_message(site_url('admin/profile'), $error_msg);
            }
        }

        $error_msg = 'Cập nhật thành công!';
        return redirect_with_message(site_url('admin/profile'), $error_msg, 'success');
    }

    /**
     * Used to create a new account that can choose a specific level for a user (Only for users with admin level)
     *  
     */
    function create()
    {
        //get the view
        if (empty($this->request->getPost())) {
            return view('Admin/create');
        }

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
            $error_msg = $validation->getErrors();
            return redirect_with_message(site_url('admin/create'), $error_msg);
        }

        $admin_m = new AdminModel();
        $user = $admin_m->where('username', $username)->first();

        if ($user) {
            $error_msg = 'Tài khoản đã tồn tại!';
            return redirect_with_message(site_url('admin/create'), $error_msg);
        }

        $user = '';
        $user = $admin_m->where('email', $email)->first();

        if ($user) {
            $error_msg = 'Email đã tồn tại!';
            return redirect_with_message(site_url('admin/create'), $error_msg);
        }

        $datas = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'level' => $level,
        ];

        //if create failed, notice and redirect to register page again
        if (!$admin_m->insert($datas)) {
            $error_msg = 'Thêm mới thất bại';
            return redirect_with_message(site_url('admin/create'), $error_msg);
        }

        return redirect()->to(base_url('admin'));
    }

    /**
     * Used to edit account level (Only for users with admin level)
     * 
     */
    function edit()
    {
        //get account id from url
        $uid = $this->request->getGet('uid');
        if (empty($uid)) {
            //if id is empty, redirect to account page
            return redirect()->to('/account');
        }

        $admin_m = new AdminModel();
        $account = $admin_m->find($uid);

        //handle view request
        if (empty($this->request->getPost())) {
            $data['account'] = $account;
            return view('Admin/edit', $data);
        }

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
            $error_msg = 'Sửa thông tin thất bại';
            return redirect_with_message(site_url('admin/edit?uid=' . $uid), $error_msg);
        }

        return redirect()->to('/admin');
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
            return $this->respond(response_failed(), 200);
        }


        $admin_m = new AdminModel();
        if ($admin_m->delete($id)) {
            return $this->respond(response_failed(), 200);
        }
        return $this->respond(response_successed(), 200);
    }
}
