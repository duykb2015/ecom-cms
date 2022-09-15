<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\AdminModel;
use App\Models\CartModel;
use App\Models\Transaction;
use App\Models\TransactionModel;
use App\Models\UserModel;

use function PHPUnit\Framework\returnValue;

class User extends BaseController
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
        $user_m = new UserModel();
        $accounts  = $user_m->findAll();

        $data['accounts'] = $accounts;
        return view('user/index', $data);
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
        return view('user/profile', $data);
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
            return view('user/detail', $data);
        }
        $user_m = new UserModel();
        $account = $user_m->find($id);
        if (empty($account)) {
            return redirect()->to('/admin');
        }
        $data['title'] = "Chỉnh Sửa Tài Khoản";
        $data['account'] = $account;
        return view('user/detail', $data);
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
        $email    = $this->request->getPost('email');
        $address  = $this->request->getPost('address');
        $phone    = $this->request->getPost('phone');
        $status   = $this->request->getPost('status');

        $inputs = array(
            'username' => $username,
            'email'    => $email,
            'password' => $password
        );

        $rules = [
            'username' => 'required',
            'email' => 'required'
        ];
        //if create new user or update password, then require password validation
        if (!$user_id || !empty($password)) {
            $rules['password'] = 'required|min_length[3]';
        }

        $validation = service('validation');
        $validation->setRules($rules, custom_validation_error_message());
        if (!$validation->run($inputs)) {
            $error_msg = $validation->getErrors();
            if (!$user_id) {
                return redirect_with_message(site_url('user/detail'), $error_msg);
            }
            return redirect_with_message(site_url('user/detail?id=') . $user_id, $error_msg);
        }

        $user_m = new UserModel();
        $user = $user_m->where('username', $username)->orWhere('email', $email)->first();
        if (!$user_id) {
            if ($user) {
                $error_msg = 'Tài khoản đã tồn tại!';
                return redirect_with_message(site_url('user/detail'), $error_msg);
            }
        }
        $data = [
            'username' => $username,
            'email'    => $email,
            'address'  => $address,
            'phone'    => $phone,
            'status'   => $status
        ];

        if ($password) {
            $data['password'] = $password;
        }

        if ($user_id) {
            $data['id'] = $user_id;
        }

        //if create failed, notice and redirect to register page again
        $is_save = $user_m->save($data);
        if (!$is_save) {
            return redirect_with_message(site_url('user/detail'), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('user');
    }

    /**
     * Used to delete account (Only for users with admin level)
     * 
     */
    public function delete()
    {
        if (session()->get('level') < 2) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        //get menu id from post data
        $id = $this->request->getPost('id');
        //if account id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $admin_m = new AdminModel();
        if ($admin_m->delete($id)) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }

    public function get_shoping_cart()
    {
        $user_id = $this->request->getPost('user_id');
        $cart_m = new CartModel();
        $data = $cart_m->find($user_id);
        return $this->respond(
            [
                'success' => true,
                'result' => $data
            ]
        );
    }

    public function get_transaction()
    {
        $user_id = $this->request->getPost('user_id');
        $transaction_m = new TransactionModel();
        $data = $transaction_m->find($user_id);
        return $this->respond(
            [
                'success' => true,
                'result' => $data
            ]
        );
    }
}
