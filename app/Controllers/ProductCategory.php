<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\ProductCategoryModel;
use CodeIgniter\API\ResponseTrait;

class ProductCategory extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $category_m = new ProductCategoryModel();
        $menu_m = new MenuModel();
        if ($this->request->getMethod() == 'get') {
            $category_name = $this->request->getGet('category_name');
            $category_status = $this->request->getGet('category_status');
            $menu_id = $this->request->getGet('menu_id');
            $filter_data = [
                'name' => $category_name,
                'status' => $category_status,
                'menu_id' => $menu_id
            ];
            $category_m->filter($filter_data);
        }
        $category = $category_m->find_all();
        $data = $category;
        $data['menu'] = $menu_m->where(['status' => 1])->findAll();
        return view('product_category/index', $data);
    }

    public function detail()
    {
        $category_id = $this->request->getUri()->getSegment(3);
        $menu_m = new MenuModel();
        $data['menu'] = $menu_m->where(['status' => 1])->findAll();
        if (!$category_id) {
            $data['title'] = 'Thêm mới danh mục';
            return view('product_category/detail', $data);
        }
        $category_m = new ProductCategoryModel();
        $category = $category_m->find($category_id);
        if (!$category) {
            return redirect()->to('/product-category');
        }
        $data['category'] = $category;
        $data['title'] = 'Cập nhật danh mục';
        return view('product_category/detail', $data);
    }

    public function save()
    {
        $category_id = $this->request->getPost('category_id');
        $menu_id     = $this->request->getPost('menu_id');
        $name        = $this->request->getPost('name');
        $slug        = $this->request->getPost('slug');
        $status      = $this->request->getPost('status');
        $data = [
            'name' => $name,
            'menu_id' => $menu_id,
            'slug' => $slug,
            'status' => $status
        ];
        $category_m = new ProductCategoryModel();
        if (!$category_id) {
            $category = $category_m->where(['slug' => $slug])->find();
            if ($category) {
                return redirect_with_message(base_url('product-category/detail'), 'Danh mục đã tồn tại');
            }
        } else {
            $data['id'] = $category_id;
        }
        $is_save = $category_m->save($data);
        if (!$is_save) {
            return redirect_with_message(base_url('product-category/detail/' . $category_id), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('product-category');
    }

    /**
     * Used to change status of a menu
     * 
     */
    public function change_status()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');

        //if menu id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $category_m = new ProductCategoryModel();
        $is_update = $category_m->update($id, $data);
        if (!$is_update) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        return $this->respond(response_successed(), HTTP_OK);
    }


    /**
     * Used to delete a menu
     * 
     */
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');

        //if menu id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        //delete menu
        $category_m = new ProductCategoryModel();
        $is_delete = $category_m->delete($id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
