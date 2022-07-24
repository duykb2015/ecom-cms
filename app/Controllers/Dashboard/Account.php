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

            $account['email'] = $this->encrypt_email($account['email']);
            $account['last_login_at'] = $this->get_time_ago(strtotime($account['last_login_at']));
            $processed_data['accounts'][] = $account;
        }
        return view('Dashboard/Account/index', $processed_data);
    }

    function profile()
    {
        $adminModel = new AdminModel();
        $uid = session()->get('id');
        $data['account'] = $adminModel->find($uid);
        if (empty($data['account'])) {
            return redirect()->to('/dashboard/account');
        }

        //view
        if (empty($this->request->getPost())) {

            //handel get request
            return view('Dashboard/Account/profile', $data);
        } else {

            //handel post request
            $error_msg = '';

            //get post data
            $inputs = $this->request->getPost();
            $datas = [];

            //if user want to change password
            if (!empty($inputs['new_password'])) {

                //check if old password is not empty and valid
                if (empty($inputs['old_password'])) {

                    $error_msg = 'Mật khẩu cũ không được để trống!';
                } else {

                    if (md5($inputs['old_password']) != $data['account']['password']) {
                        $error_msg = 'Mật khẩu không đúng, vui lòng kiểm tra lại!';
                    } else {

                        //set new password to update
                        $datas['password'] = md5($inputs['new_password']);
                    }
                }
            }

            //if user want to change email
            if (!empty($inputs['email'])) {
                if ($inputs['email'] != $data['account']['email']) {
                    $datas['email'] = $inputs['email'];
                }
            }

            //update account if data is not empty
            if (!empty($datas)) {

                if ($adminModel->update($uid, $datas)) {

                    session()->setFlashdata('success', 'Cập nhật thành công!');
                    return redirect()->to('/dashboard/account/profile');
                } else {
                    $error_msg = 'Cập nhật thất bại, vui lòng thử lại!';
                }
            }

            session()->setFlashdata('error_msg', $error_msg);
            return view('Dashboard/Account/profile', $data);
        }
    }

    function save()
    {
        if (empty($this->request->getPost())) {

            $data['title'] = 'Chỉnh sửa tài khoản';
            return view('Dashboard/Account/save', $data);
        } else {

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

            if ($adminModel->insert($datas)) {
                $this->session->setFlashdata('success', 'Thêm mới thành công');
                return redirect()->to(base_url('dashboard/account'));
            } else {
                $this->session->setFlashdata('error', 'Thêm mới thất bại');
                return redirect()->to(base_url('dashboard/account/save'));
            }
            return redirect()->to(base_url('dashboard/account'));
        }
    }

    function edit()
    {
        if (empty($this->request->getPost())) {
            $uid = $this->request->getGet('uid');
            if (empty($uid)) {
                return redirect()->to('/dashboard/account');
            }
            $adminModel = new AdminModel();

            $data['account'] = $adminModel->find($uid);

            return view('Dashboard/Account/edit', $data);
        } else {

            $uid = $this->request->getGet('uid');
            if (empty($uid)) {
                return redirect()->to('/dashboard/account');
            }
            $adminModel = new AdminModel();
            $account = $adminModel->find($uid);

            $level = $this->request->getPost('level');
            if (empty($level)) {
                $level = $account['level'];
            }

            $datas = [
                'level' => $level,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (!$adminModel->update($account['id'], $datas)) {
                $this->session->setFlashdata('success', 'Thêm mới thành công');
                return redirect()->to(base_url('dashboard/account'));
            } else {
                $this->session->setFlashdata('error', 'Thêm mới thất bại');
                return redirect()->to(base_url('dashboard/account/edit?uid=' . $uid));
            }
            return redirect()->to('/dashboard/account');
        }
    }

    function get_time_ago($time)
    {
        $time_difference = time() - $time;
        if ($time_difference < 1) {
            return 'Ít hơn 1 giây trước';
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

    function encrypt_email($email)
    {
        for ($i = 4; $i < strlen($email); $i++) {
            $email[$i] = '*';
        }
        return $email;
    }
}
