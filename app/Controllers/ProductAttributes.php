<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductAttributesModel;

class ProductAttributes extends BaseController
{
    use ResponseTrait;

    /**
     * Used to view all product attribute
     * 
     */
    public function index()
    {
        $product_attribute_m = new ProductAttributesModel();
        if ($this->request->getMethod() == 'post') {
            $product_attribute_name  = $this->request->getPost('product_attribute_name');
            $product_attribute_group = $this->request->getPost('product_attribute_group');
            $filter_data = [
                'name'       => $product_attribute_name,
                'is_group'   => $product_attribute_group,
            ];
            $product_attribute_m->filter($filter_data);
        }
        $data = [
            'product_attributes' => $product_attribute_m->paginate(10),
            'pager'              => $product_attribute_m->pager
        ];
        return view('product_attribute/index', $data);
    }

    /**
     * Used to view product attribute infomation 
     * 
     */
    public function view()
    {
        $product_attribute_id = $this->request->getUri()->getSegment(3);

        if (!$product_attribute_id) {
            $data['title'] = 'Thêm mới thuộc tính';
            return view('product_attribute/save', $data);
        }
        $product_attribute_m = new ProductAttributesModel();
        $product_attribute = $product_attribute_m->find($product_attribute_id);

        if (!$product_attribute) {
            return redirect()->to('product-attribute');
        }
        $data['product_attribute'] = $product_attribute;
        $data['title'] = 'Chỉnh sửa thuộc tính';
        return view('product_attribute/save', $data);
    }

    public function save()
    {
        $product_attribute_id = $this->request->getPost('product_attribute_id');
        $name                 = $this->request->getPost('name');
        $is_group             = $this->request->getPost('is_group');
        $status               = $this->request->getPost('status');

        pre($name);
        $data = [
            'name' => $name,
            'is_group' => $is_group,
            'status' => $status,
        ];

        $product_attribute_m = new ProductAttributesModel();
        if (!$product_attribute_id) {
            $product_attribute = $product_attribute_m->where(['name' => $name])->first();
            if ($product_attribute) {
                return redirect_with_message('product-attribute/save', 'Thuộc tính đã tồn tại');
            }
        } else {
            $data['id'] = $product_attribute_id;
        }

        $is_save = $product_attribute_m->save($data);
        if (!$is_save) {
            return redirect_with_message('product-attribute/save', UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to(base_url('product-attribute'));
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

        $data = [
            'status' => $this->request->getPost('status'),
        ];

        //update menu status
        $product_attribute_m = new ProductAttributesModel();
        $is_update = $product_attribute_m->update($id, $data);
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
        $product_attribute_m = new ProductAttributesModel();
        $is_delete = $product_attribute_m->delete($id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
