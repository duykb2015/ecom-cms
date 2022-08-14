<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;

class ProductAttributes extends BaseController
{
    use ResponseTrait;

    /**
     * Used to view all product attribute
     * 
     */
    public function index()
    {
        $product_attribute_m = new ProductAttributeValuesModel();
        if ($this->request->getMethod() == 'get') {
            $product_attribute_name   = $this->request->getGet('product_attribute_name');
            $product_attribute_key    = $this->request->getGet('product_attribute_key');
            $product_attribute_value  = $this->request->getGet('product_attribute_value');
            $product_attribute_status = $this->request->getGet('product_attribute_status');
            $filter_data = [
                'name'       => $product_attribute_name,
                'key'        => $product_attribute_key,
                'value'      => $product_attribute_value,
                'status'     => $product_attribute_status
            ];
            $product_attribute_m->filter($filter_data);
        }
        $data = [
            'product_attributes' => $product_attribute_m->paginate(10),
            'pager'              => $product_attribute_m->pager
        ];
        return view('Product_attribute/index', $data);
    }

    /**
     * Used to view product attribute infomation 
     * 
     */
    public function detail()
    {
        $product_attribute_id = $this->request->getUri()->getSegment(3);

        if (!$product_attribute_id) {
            $data['title'] = 'Thêm mới thuộc tính';
            return view('Product_attribute/detail', $data);
        }
        $product_attribute_value_m = new ProductAttributeValuesModel();
        $product_attribute = $product_attribute_value_m->find($product_attribute_id);

        if (!$product_attribute) {
            return redirect()->to('product-attribute');
        }
        $data['product_attribute'] = $product_attribute;
        $data['title'] = 'Chỉnh sửa thuộc tính';
        return view('Product_attribute/detail', $data);
    }

    /**
     * Used to save product attribute
     * 
     */

    public function save()
    {
        $product_attribute_id     = $this->request->getPost('product_attribute_id');
        $product_attribute_name   = $this->request->getPost('name');
        $product_attribute_key    = $this->request->getPost('key');
        $product_attribute_value  = $this->request->getPost('value');
        $product_attribute_status = $this->request->getPost('status');

        $data = [
            'name'   => $product_attribute_name,
            'key'    => $product_attribute_key,
            'value'  => $product_attribute_value,
            'status' => $product_attribute_status,
        ];

        //Check if product attribute is exist
        $product_attribute_value_m = new ProductAttributeValuesModel();
        $product_attribute_value = $product_attribute_value_m->where('name', $product_attribute_name)->first();
        if ($product_attribute_value) {
            if ($product_attribute_value['id'] != $product_attribute_id) {
                return redirect_with_message('product-attribute/detail', 'Thuộc tính đã tồn tại');
            }
        }

        if ($product_attribute_id) {
            $data['id'] = $product_attribute_id;
        }
        $is_save = $product_attribute_value_m->save($data);
        if (!$is_save) {
            return redirect_with_message('product-attribute/detail', UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to(base_url('product-attribute'));
    }

    /**
     * Used to change status of an product attribute
     * 
     */
    public function change_status()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $product_attribute_m = new ProductAttributesModel();
        $is_update = $product_attribute_m->update($id, $data);
        if (!$is_update) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }

    /**
     * Used to delete an attribute
     * 
     */
    public function delete()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        //delete attribute
        $product_attribute_m = new ProductAttributesModel();
        $is_delete = $product_attribute_m->delete($id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
