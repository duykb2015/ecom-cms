<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;


class Auth extends BaseController
{
	/**
	 * Used to view the login page.
	 * 
	 */
	public function login()
	{

		$is_logged_in = session()->get('logged_in');

		//if user already login, redirect to dashboard
		if (!empty($is_logged_in) && $is_logged_in == true) {

			return redirect()->to(site_url('/'));
		}
		return view('Auth/login');
	}

	/**
	 * Used to view the register page.
	 * 
	 * 
	 */
	public function register()
	{

		$is_logged_in = session()->get('logged_in');

		//if user already login, redirect to dashboard
		if (!empty($is_logged_in) && $is_logged_in == true) {

			return redirect()->to(site_url('/'));
		}
		return view('Auth/register');
	}

	/**
	 * Used to logout the user.
	 * 
	 */
	function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}

	/**
	 * Used to validate data from login form.
	 * 
	 */
	public function login_authentication()
	{
		$error_msg = '';

		if ($this->request->getPost()) {

			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

			$inputs = array(
				'username' => $username,
				'password' => $password
			);

			//load validation service
			$validation = service('validation');

			$validation->setRules(
				[
					'username' => 'required',
					'password' => 'required|min_length[3]'
				],
				//Custom error message
				custom_validation_rule()
			);

			//if something wrong, redirect to login page and show error message
			if (!$validation->run($inputs)) {

				$error_msg = $validation->getErrors();
				return redirect_with_message(site_url('login'), $error_msg);
			}

			//Get info user
			$admin_m = new AdminModel();
			$user = $admin_m->where('username', $username)->first();

			if (!$user) {

				$error_msg = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!';
				return redirect_with_message(site_url('login'), $error_msg);
			}

			//Check password valid
			$pass = $user['password'];
			$authPassword = md5($password) === $pass;

			if (!$authPassword) {
				$error_msg = 'Tài khoản hoặc mật khẩu không đúng. Vui lòng thử lại!';
				return redirect_with_message(site_url('login'), $error_msg);
			}
			$sessionData = [
				'id' 	   => $user['id'],
				'name'     => $user['username'],
				'email'	   => $user['email'],
				'level'	   => $user['level'],
				'logged_in' => true,
			];

			//Update last_login_at
			if (!$admin_m->update($user['id'], ['last_login_at' => date('Y-m-d H:i:s')])) {
				$error_msg = 'Đã có lỗi xảy ra, vui lòng thử lại sau!';
				return redirect_with_message(site_url('login'), $error_msg);
			}

			//create new session and start to work
			session()->set($sessionData);
			return redirect()->to('/');
		}
	}


	/**
	 * Used to validate data from register form
	 * 
	 */

	public function register_authentication()
	{
		$error_msg = '';

		if ($this->request->getPost()) {

			$username = $this->request->getPost('username');
			$email    = $this->request->getPost('email');
			$password = $this->request->getPost('password');

			$inputs = array(
				'username' => $username,
				'email'    => $email,
				'password' => $password
			);
			$validation = service('validation');

			$validation->setRules(
				[
					'username' => 'required',
					'email'    => 'required|valid_email',
					'password' => 'required|min_length[3]'
				],
				//Custom error message
				custom_validation_rule()
			);

			//Validate data
			if (!$validation->run($inputs)) {

				$error_msg = $validation->getErrors();
				return redirect_with_message(site_url('register'), $error_msg);
			}

			//Get info user
			$admin_m = new AdminModel();
			$user = $admin_m->where('username', $username)->first();

			//check username exist
			if ($user) {
				$error_msg = 'Tài khoản đã tồn tại. Vui lòng thử lại!';
				return redirect_with_message(site_url('register'), $error_msg);
			}

			//Check email exist
			$user = '';
			$user = $admin_m->where('email', $email)->first();

			if ($user) {
				$error_msg = 'Email đã tồn tại. Vui lòng thử lại!';
				return redirect_with_message(site_url('register'), $error_msg);
			}
			//prepare data
			$datas = [
				'username'     => $username,
				'email'	   => $email,
				'password' => md5($password),
			];

			//create new account
			if (!$admin_m->insert($datas)) {

				$error_msg = 'Đã có lỗi xảy ra, vui lòng thử lại sau!';
				return redirect_with_message(site_url('register'), $error_msg);
			}

			$error_msg = 'Đăng ký thành công, giờ bạn có thể đăng nhập!';
			return redirect_with_message(site_url('register'), $error_msg, 'success');
		}
	}
}
