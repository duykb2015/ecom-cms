<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Account extends BaseController
{

    /**
     * View all user account (admin only)
     * 
     */
    function index()
    {
        $adminModel = new AdminModel();
        //get all data from db
        $data['accounts'] = $adminModel->findAll();

        $processed_data['accounts'] = [];
        foreach ($data['accounts'] as $account) {
            //encrypt data for security
            $account['email'] = encrypt_email($account['email']);
            $account['last_login_at'] = get_time_ago(strtotime($account['last_login_at']));
            $processed_data['accounts'][] = $account;
        }
        return view('Account/index', $processed_data);
    }

    /**
     * View account infomation
     * 
     */
    function profile()
    {
        $adminModel = new AdminModel();

        //get id from store session
        $uid = session()->get('id');

        //get data from db
        $data['account'] = $adminModel->find($uid);

        //if account not found, redirect to ...
        if (empty($data['account'])) {
            return redirect()->to('/');
        }

        //handel get request
        if (empty($this->request->getPost())) {

            return view('Account/profile', $data);
        } else {

            //handel post request
            $error_msg = '';

            //get post data
            $new_password = $this->request->getPost('new_password');
            $old_password = $this->request->getPost('old_password');
            $email        = $this->request->getPost('email');

            $datas = [];

            //if user want to change password
            if (!empty($new_password)) {

                //check if old password is not empty and valid
                if (empty($old_password)) {

                    $error_msg = 'Mật khẩu cũ không được để trống!';
                } else {

                    //check if old password is correct
                    if (md5($old_password) != $data['account']['password']) {
                        $error_msg = 'Mật khẩu không đúng, vui lòng kiểm tra lại!';
                    } else {

                        //set new password to update
                        $datas['password'] = md5($new_password);
                    }
                }
            }

            //if user want to change email
            if (!empty($email)) {
                if ($email != $data['account']['email']) {
                    $datas['email'] = $email;
                }
            }

            //update account if data is not empty
            if (!empty($datas)) {

                //if update failed, notice and redirect to profile page
                if (!$adminModel->update($uid, $datas)) {
                    $error_msg = 'Cập nhật thất bại, vui lòng thử lại!';
                } else {

                    session()->setFlashdata('success', 'Cập nhật thành công!');
                    return redirect()->to('/account/profile');
                }
            }

            session()->setFlashdata('error_msg', $error_msg);
            return view('Account/profile', $data);
        }
    }

    /**
     * Create new account (admin only) 
     */
    function save()
    {
        //get the view
        if (empty($this->request->getPost())) {
            return view('Account/save');
        } else {

            //handel post request for create new account
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $level = !empty($this->request->getPost('level')) ? $this->request->getPost('level') : 1;

            $adminModel = new AdminModel();
            $datas = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'level' => $level,
            ];

            //if create failed, notice and redirect to register page again
            if (!$adminModel->insert($datas)) {
                $this->session->setFlashdata('error', 'Thêm mới thất bại');
                return redirect()->to(base_url('account/save'));
            }

            $this->session->setFlashdata('success', 'Thêm mới thành công');
            return redirect()->to(base_url('account'));
        }
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

        if (empty($this->request->getPost())) {
            //handle view request

            //get data from db and show to view
            $adminModel = new AdminModel();
            $data['account'] = $adminModel->find($uid);

            return view('Account/edit', $data);
        } else {
            //handle post request
            $adminModel = new AdminModel();
            //get account data from db
            $account = $adminModel->find($uid);

            //get post data
            $level = $this->request->getPost('level');
            if (empty($level)) {
                //if level is empty, set level to curent account level
                $level = $account['level'];
            }

            //set new data to update
            $datas = [
                'level' => $level,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            //if update fail, redirect to edit page again
            if (!$adminModel->update($account['id'], $datas)) {
                session()->setFlashdata('error', 'Sửa thông tin thất bại');
                return redirect()->to('account/edit?uid=' . $uid);
            }
            //if update success, redirect to account page
            session()->setFlashdata('success', 'Sửa thông tin thành công');
            return redirect()->to('/account');
        }
    }
}
