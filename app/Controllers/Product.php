<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\UploadHandler;
use App\Models\MenuModel;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;

class Product extends BaseController
{
    use ResponseTrait;
    /**
     * Used to view all products
     */
    function index()
    {
        $product_m = new ProductModel();
        if ($this->request->getMethod() == 'post') {
            $filter_data = [
                'name' => $this->request->getVar('filter_product_name'),
            ];
            $product_m->filter($filter_data);
        }
        $data = [
            'products' => $product_m->findAll(),
            'pager'    => $product_m->pager
        ];
        return view('Product/index', $data);
    }

    /**
     * Used to create new product
     * 
     */
    function view()
    {
        $product_id = $this->request->getGet('id');

        $menu_m = new MenuModel();
        $data['menu'] = $menu_m->select('id, name')->where('parent_id >', 0)->findAll();

        $product_attribute_m = new ProductAttributesModel();

        if (!$product_id) {
            $data['product_attribute'] = $product_attribute_m->where('is_group', 1)->findAll();
            $data['title'] = 'Thêm mới dòng sản phẩm';
            return view('product/save', $data);
        }
        $product_m = new ProductModel();
        $product = $product_m->find($product_id);
        if (!$product) {
            return redirect()->to('product');
        }
        $data['product_attribute'] = $product_attribute_m->find_all($product_id);
        $data['product'] = $product;
        $data['title'] = 'Chỉnh sửa dòng sản phẩm';
        return view('product/save', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated. 
     * 
     */
    function save()
    {
        //get product data
        $admin_id               = session()->get('id');
        $product_id             = $this->request->getPost('product_id');
        $menu_id                = $this->request->getPost('menu_id');
        $name                   = $this->request->getPost('name');
        $slug                   = $this->request->getPost('slug');
        $additional_information = $this->request->getPost('additional_information');
        $support_information    = $this->request->getPost('support_information');
        $status                 = $this->request->getPost('status');

        //prepare data
        $data = [
            'name'                   => $name,
            'slug'                   => $slug,
            'admin_id'               => $admin_id,
            'menu_id'                => $menu_id,
            'additional_information' => $additional_information,
            'support_information'    => $support_information,
            'status'                 => $status,
        ];
        //check if product_id is empty then insert new product else update product
        if ($product_id) {
            $data['id'] = $product_id;
        }
        $product_m = new ProductModel();
        $is_save = $product_m->save($data);
        if (!$is_save) {
            return redirect()->to('product/save', UNEXPECTED_ERROR);
        }

        //after save product, we need to save product attribute values
        //get product id
        if (!$product_id) {
            $product_save_id = $product_m->getInsertID();
        } else {
            $product_save_id = $product_id;
        }

        $product_attribute_m = new ProductAttributesModel();
        $product_attribute_value_m = new ProductAttributeValuesModel();

        //get all product attribute id (for what? because we need to know which product attribute value to save)
        $product_attribute_id = $product_attribute_m->select('id')->where('is_group', 1)->findAll();

        //if it's an update, need to get bold product attribute and product attribute value
        if ($product_id) {
            //Đặt lại tên cho hàm này
            $product_attribute_id = $product_attribute_m->find_all_id($product_id);
        }
        //Since the number of ids will coincide with the amount of data requested,
        //we just need to loop through the ids
        $product_attribute_value_m->transStart();
        foreach ($product_attribute_id as $value) {
            $product_attribute_value = $this->request->getPost('attribute_' . $value['id']);

            $product_attribute_value_id = '';
            //if it's an update, need to get product attribute values id
            if ($product_id) {
                // pav: Product Attribute Values
                $product_attribute_value_id = $this->request->getPost('pav_' . $value['pav_id']);
            }
            $data = [
                'product_id' => $product_save_id,
                'product_attribute_id' => $value['id'],
                'value' => $product_attribute_value,
                'status' => 1
            ];

            if ($product_attribute_value_id) {
                $data['id'] = $product_attribute_value_id;
            }

            $is_save = $product_attribute_value_m->save($data);
            if (!$is_save) {
                $product_attribute_value_m->transRollback();
                return redirect()->to('product/save', UNEXPECTED_ERROR);
            }
            $product_attribute_value_m->transCommit();
        }
        $product_attribute_value_m->transComplete();

        return redirect()->to('product');
    }

    /**
     * Used to delete a product
     * 
     */
    public function delete()
    {
        //get product id from post data
        $product_id = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$product_id) {
            return $this->respond(response_failed(), 200);
        }

        $product_attribute_value_m = new ProductAttributeValuesModel();
        $is_delete = $product_attribute_value_m->where('product_id', $product_id)->delete();
        if (!$is_delete) {
            return $this->respond(response_failed(), 200);
        }

        $product_m = new ProductModel();
        $is_delete = $product_m->delete($product_id);
        if (!$is_delete) {
            return $this->respond(response_failed(), 200);
        }
        return $this->respond(response_successed(), 200);
    }
}
