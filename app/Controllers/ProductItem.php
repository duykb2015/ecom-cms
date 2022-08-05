<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductAttributesModel;
use App\Models\ProductItemsModel;
use App\Models\ProductModel;

class ProductItem extends BaseController
{
    public function index()
    {
        $product_items_m = new ProductItemsModel();
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
            'pager' => $product_items_m->pager
        ];
        return view('product_items/index', $data);
    }

    public function view()
    {
        $product_item_id = $this->request->getGet('id');

        $product_m = new ProductModel();
        $product = $product_m->select('id, name')->findAll();
        $data['product'] = $product;

        if (!$product_item_id) {
            $product_attribute_m = new ProductAttributesModel();
            $data['product_attribute'] = $product_attribute_m->where('is_group', 0)->findAll();
            $data['title'] = 'Thêm mới sản phẩm';
            return view('product_items/save', $data);
        }
    }

    public function save()
    {
        pre($this->request->getPost());
    }

    public function delete()
    {
        # code...
    }
}
