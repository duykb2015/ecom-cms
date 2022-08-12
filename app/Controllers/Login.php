<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\Encryption\Encryption;
use CodeIgniter\I18n\Time;

class Login extends BaseController
{
	/**
	 * Used to view the login page.
	 * 
	 */
	public function index()
	{
		//if user already login, redirect to dashboard
		$is_logged_in = session()->get('logged_in');
		if (!empty($is_logged_in) && $is_logged_in == true) {
			return redirect()->to(site_url('/'));
		}
		return view('Login/index');
	}

	/**
	 * Used to logout the user.
	 * 
	 */
	function logout()
	{
		session()->destroy();
		return redirect()->to('login');
	}

	/**
	 * Used to validate data from login form.
	 * 
	 */
	public function authentication()
	{

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
			custom_validation_error_message()
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
			return redirect_with_message(site_url('login'), WRONG_LOGIN_INFO_MESSAGE);
		}

		$pass = $user['password'];
		$authPassword = md5($password) === $pass;
		if (!$authPassword) {
			return redirect_with_message(site_url('login'), WRONG_LOGIN_INFO_MESSAGE);
		}

		$sessionData = [
			'id' 	   => $user['id'],
			'name'     => $user['username'],
			'level'	   => $user['level'],
			'logged_in' => true,
		];

		$is_update = $admin_m->update($user['id'], ['last_login_at' => Time::now()]);
		if (!$is_update) {
			return redirect_with_message(site_url('login'), UNEXPECTED_ERROR_MESSAGE);
		}

		//create new session and start to work
		session()->set($sessionData);
		return redirect()->to('/');
	}
}
