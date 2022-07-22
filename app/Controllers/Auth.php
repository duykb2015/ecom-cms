<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use Config\Validation;

class Auth extends BaseController
{

	public function login()
	{
		if (!empty(session()->get('admin_logged_in')) && session()->get('admin_logged_in') == true) {
			return redirect()->to(site_url('/dashboard'));
		}
		return view('Dashboard/admin/login');
	}
	
	public function loginValidate()
	{
		$error_msg = '';

		if ($this->request->getPost()) {

			//Get email and password
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

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

			if (!$validation->run($inputs)) {
				$error_msg = $validation->getErrors('username') ?: $validation->getErrors('password');
			} else {
				//Get info user
				$admin_m = new AdminModel();
				$user = $admin_m->where('username', $username)->first();

				if (!$user) {
					$error_msg = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!';
				} else {

					//Check password valid
					$pass = $user['password'];
					$authPassword = md5($password) === $pass;

					if (!$authPassword) {
						$error_msg = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!';
					} else {
						$sessionData = [
							'id' 	   => $user['id'],
							'name'     => $user['username'],
							'email'	   => $user['email'],
							'admin_logged_in' => true,
						];

						//Update last_login_at
						if (!$admin_m->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')])) {
							$error_msg = 'Đã có lỗi xảy ra, vui lòng thử lại sau!';
						}

						session()->set($sessionData);
						return redirect()->to('dashboard');
					}
				}
			}
		}
		session()->setFlashdata('error_msg', $error_msg);
		return redirect()->to(site_url('/dashboard/login'));
	}
}
