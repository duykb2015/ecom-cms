<?php

namespace App\Controllers\Product;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;
use App\Models\ProductCategoryModel;

class Line extends BaseController
{
    use ResponseTrait;
    /**
     * Used to view all products
     */
    function index()
    {
        $product_m = new ProductModel();
        $product_category_m = new ProductCategoryModel();
        if ($this->request->getMethod() == 'get') {
            $product_name     = $this->request->getGet('product_name');
            $product_category = $this->request->getGet('product_category');
            $product_status   = $this->request->getGet('product_status');
            $product_creator  = $this->request->getGet('product_creator');
            $filter_data = [
                'name'     => $product_name,
                'category_id' => $product_category,
                'admin_id' => $product_creator,
                'status'   => $product_status
            ];
            $product_m->filter($filter_data);
        }
        $data = [
            'products' => $product_m->findAll(),
            'pager'    => $product_m->pager,
            'category' => $product_category_m->findAll()
        ];
        return view('Product/Line/index', $data);
    }

    /**
     * Used to create and edit new product
     * 
     */
    function detail()
    {
        $product_id = $this->request->getUri()->getSegment(3);

        $product_category_m = new ProductCategoryModel();
        $category = $product_category_m->select('id, name')->findAll();
        if (!$category) {
            return redirect_with_message('product-category/detail', 'Bạn cần có danh mục trước mới có thể thêm sản phẩm');
        }
        $data['category'] = $category;

        $product_attribute_values_m = new ProductAttributeValuesModel();
        $data['product_attribute_values'] = $product_attribute_values_m->findAll();

        if (!$product_id) {
            $data['title'] = 'Thêm mới dòng sản phẩm';
            return view('Product/Line/detail', $data);
        }

        $product_m = new ProductModel();
        $product = $product_m->find($product_id);
        if (!$product) {
            return redirect()->to('product-line');
        }

        //select all product attributes of this product, that already have to edit
        $product_attribute_m = new ProductAttributesModel();
        $product_attributes = $product_attribute_m->select('product_attribute_value_id')->where('product_id', $product_id)->findAll();
        foreach ($product_attributes as $row) {
            $attributes[] = $row['product_attribute_value_id'];
        }
        $data['product_attributes'] = $attributes;
        $data['product'] = $product;
        $data['title'] = 'Chỉnh sửa dòng sản phẩm';
        return view('Product/Line/detail', $data);
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
        $category_id            = $this->request->getPost('category_id');
        $name                   = $this->request->getPost('name');
        $slug                   = $this->request->getPost('slug');
        $additional_information = $this->request->getPost('additional_information');
        $support_information    = $this->request->getPost('support_information');
        $description            = $this->request->getPost('description');
        $status                 = $this->request->getPost('status');

        //prepare data
        $data = [
            'name'                   => $name,
            'slug'                   => $slug,
            'admin_id'               => $admin_id,
            'category_id'            => $category_id,
            'additional_information' => $additional_information,
            'support_information'    => $support_information,
            'description'            => $description,
            'status'                 => $status,
        ];

        $product_m = new ProductModel();
        $product = $product_m->where('name', $name)->first();
        if ($product) {
            if ($product['id'] != $product_id) {
                return redirect_with_message('product-line/detail/' . $product_id, 'Sản phẩm đã tồn tại!');
            }
        }

        //check if product_id is not empty then update product else insert new product
        if ($product_id) {
            $data['id'] = $product_id;
        }

        $is_save = $product_m->save($data);
        if (!$is_save) {
            return redirect_with_message('product-line/detail', UNEXPECTED_ERROR_MESSAGE);
        }

        //after save product, we need to save product attribute values
        //get product inserted id for insert attribute values
        $product_save_id = $product_m->getInsertID();

        //if it's an update. the insert id will be zero, so we will use the already have product id
        if ($product_id) {
            $product_save_id = $product_id;
        }

        $product_attribute_value_ids = $this->request->getPost('product_attribute_value');
        foreach ($product_attribute_value_ids as $item) {
            $insert_data[] = [
                'product_id' => $product_save_id,
                'product_attribute_value_id' => $item,
                'status' => 1
            ];
        }
        $product_attribute_m = new ProductAttributesModel();
        $where = [
            'product_id' => $product_save_id
        ];
        $err = $product_attribute_m->insertOrDelete($insert_data, $where);
        if (!$err) {
            return redirect_with_message('product-line/detail', UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('product-line');
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
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_attribute_m = new ProductAttributesModel();
        $is_delete = $product_attribute_m->where('product_id', $product_id)->delete();
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_m = new ProductModel();
        $is_delete = $product_m->delete($product_id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
