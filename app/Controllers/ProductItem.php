<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;
use App\Models\ProductItemsModel;
use App\Models\ProductModel;

class ProductItem extends BaseController
{
    public function index()
    {
        $product_items_m = new ProductItemsModel();
        $product_m = new ProductModel();
        if ($this->request->getMethod() == 'post') {
            $product_item_name = $this->request->getPost('product_item_name');
            $produc_id         = $this->request->getPost('product_id');
            $filter_data = [
                'name' => $product_item_name,
                'product_id' => $produc_id,
            ];
            $product_items_m->filter($filter_data);
        }

        $data = [
            'produc_items' => $product_items_m->paginate(10),
            'pager' => $product_items_m->pager,
            'product' => $product_m->findAll()
        ];
        return view('product_items/index', $data);
    }

    public function detail()
    {
        $product_item_id = $this->request->getUri()->getSegment(3);

        $product_m = new ProductModel();
        $product = $product_m->select('id, name')->findAll();
        $data['product'] = $product;

        $product_attribute_values_m = new ProductAttributeValuesModel();
        if (!$product_item_id) {
            $data['product_attribute'] = $product_attribute_values_m->findAll();
            $data['title'] = 'Thêm mới sản phẩm';
            return view('product_items/detail', $data);
        }
        $product_item_m = new ProductItemsModel();
        $product = $product_m->find($product_item_id);
        if (!$product) {
            return redirect()->to('product');
        }
        $product_attribute_m = new ProductAttributesModel();
        $product_attributes = $product_attribute_m->select('product_attribute_value_id')->where('product_item_id', $product_item_id)->findAll();
        foreach ($product_attributes as $value) {
            $data['product_attributes'][] = $value['product_attribute_value_id'];
        }
        $data['product'] = $product;
        $data['title'] = 'Chỉnh sửa dòng sản phẩm';
        return view('product/detail', $data);
    }

    public function save()
    {
        $product_item_id = $this->request->getPost('id');
        $admin_id        = session()->get('id');
        $name            = $this->request->getPost('name');
        $slug            = $this->request->getPost('slug');
        $product_id      = $this->request->getPost('product_id');
        $description     = $this->request->getPost('description');
        $status          = $this->request->getPost('status');
        $data = [
            'product_id' => $product_id,
            'admin_id' => $admin_id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'status' => $status,
        ];

        if ($product_item_id) {
            $data['id'] = $product_item_id;
        }
        $product_items_m = new ProductItemsModel();

        $is_save = $product_items_m->save($data);
        if (!$is_save) {
            return redirect_with_message('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
        }
        //get product item inserted id for insert attribute values
        $product_save_item_id = $product_items_m->getInsertId();
        //if it's an update. the insert id will be zero, so we will use the already have product item id
        if ($product_item_id) {
            $product_save_item_id = $product_item_id;
        }

        $product_attribute_m = new ProductAttributesModel();

        $product_attribute_ids = $product_attribute_m->select('id')->where('is_group', 0)->findAll();
        if ($product_item_id) {
            $product_attribute_ids = $product_attribute_m->find_id($product_item_id);
        }
        //start trans to make sure ...
        $product_attribute_value_m = new ProductAttributeValuesModel();
        $product_attribute_value_m->transStart();
        foreach ($product_attribute_ids as $item) {
            $product_attribute_value = $this->request->getPost('attribute_' . $item->id);
            if ($product_item_id) {
                $product_attribute_value_id = $this->request->getPost('pav_' . $item['pav_id']);
            }
            $data = [
                'product_item_id' => $product_save_item_id,
                'product_attribute_id' => $item['id'],
                'value' => $product_attribute_value,
                'status' => 1
            ];

            //if it's an update
            if ($product_attribute_value_id) {
                $data['id'] = $product_attribute_value_id;
            }

            $is_save = $product_attribute_value_m->save($data);
            if (!$is_save) {
                $product_attribute_value_m->transRollback();
                return redirect()->to('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
            }
            $product_attribute_value_m->transCommit();
        }
        $product_attribute_value_m->transComplete();
    }

    public function delete()
    {
        # code...
    }
}
