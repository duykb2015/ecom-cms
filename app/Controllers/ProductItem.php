<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Upload;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductAttributesModel;
use App\Models\ProductAttributeValuesModel;
use App\Models\ProductItemColorsModel;
use App\Models\ProductItemImagesModel;
use App\Models\ProductItemsModel;
use App\Models\ProductModel;

class ProductItem extends BaseController
{
    use ResponseTrait;
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
            'product_items' => $product_items_m->paginate(10),
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
        $data['product_attribute_values'] = $product_attribute_values_m->findAll();

        if (!$product_item_id) {
            $data['title'] = 'Thêm mới sản phẩm';
            return view('product_items/detail', $data);
        }
        $product = $product_m->find($product_item_id);
        if (!$product) {
            return redirect()->to('product-item');
        }
        $product_attribute_m = new ProductAttributesModel();
        $product_attributes = $product_attribute_m->select('product_attribute_value_id')->where('product_item_id', $product_item_id)->findAll();
        foreach ($product_attributes as $value) {
            $data['product_attributes'][] = $value['product_attribute_value_id'];
        }
        $data['product'] = $product;
        $data['title'] = 'Chỉnh sửa sản phẩm';
        return view('product_items/detail', $data);
    }


    //Hàm này chưa tối ưu, còn lỗi vì chưa test, xem xét lại là cải tiến thêm
    public function save()
    {
        $product_item_id = $this->request->getUri()->getSegment(3);
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
        $product_item_save_id = $product_items_m->getInsertId();
        //if it's an update. the insert id will be zero, so we will use the already have product item id
        if ($product_item_id) {
            $product_item_save_id = $product_item_id;
        }

        $upload = new Upload();
        $array_image_name = $upload->multiple_images($this->request->getFiles());

        if (!$array_image_name) {
            return redirect_with_message('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
        }
        $product_item_images_m = new ProductItemImagesModel();
        foreach ($array_image_name as $image_name) {
            $images_data[] = [
                'product_item_id' => $product_item_save_id,
                'name' => $image_name,
                'status' => 1,
            ];
        }
        $where = [
            'product_item_id' => $product_item_save_id,
        ];
        //Coi lại chỗ này
        $err = $product_item_images_m->insertOrDelete($images_data, $where);
        if ($err) {
            return redirect_with_message('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
        }

        $colors    = $this->request->getPost('colors');
        $hexcodes  = $this->request->getPost('hexcodes');
        $prices    = $this->request->getPost('prices');
        $discounts = $this->request->getPost('discounts');
        $quantitys = $this->request->getPost('quantitys');
        $status    = $this->request->getPost('status');


        foreach ($colors as $key => $color) {
            $colors_data[] = [
                'product_item_id' => $product_item_save_id,
                'name' => $color,
                'hexcode' => $hexcodes[$key],
                'price' => $prices[$key],
                'discount' => $discounts[$key],
                'quantity' => $quantitys[$key],
                'status' => $status[$key],
            ];
        }
        $product_item_colors_m = new ProductItemColorsModel();
        $err = $product_item_colors_m->insertOrDelete($colors_data, $where);
        if ($err) {
            return redirect_with_message('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
        }

        $product_attribute_value_ids = $this->request->getPost('product_attribute_value');
        foreach ($product_attribute_value_ids as $item) {
            $attribute_data[] = [
                'product_id' => $product_id,
                'product_item_id' => $product_item_save_id,
                'product_attribute_value_id' => $item,
                'status' => 1
            ];
        }
        $product_attribute_m = new ProductAttributesModel();
        $where = [
            'product_item_id' => $product_item_save_id,
            'product_id' => $product_id
        ];
        $err = $product_attribute_m->insertOrDelete($attribute_data, $where);
        if ($err) {
            return redirect_with_message('product-item/detail', UNEXPECTED_ERROR_MESSAGE);
        }
    }

    public function delete()
    {
        # code...
        //get product id from post data
        $product_item_id = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$product_item_id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_attribute_m = new ProductAttributesModel();
        $is_delete = $product_attribute_m->where('product_item_id', $product_item_id)->delete();
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_item_colors_m = new ProductItemColorsModel();
        $is_delete = $product_item_colors_m->where('product_item_id', $product_item_id)->delete();
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_item_colors_m = new ProductItemImagesModel();
        $images = $product_item_colors_m->where('product_item_id', $product_item_id)->findAll();
        if ($images) {
            foreach ($images as $image) {
                $image_path = ROOTPATH . 'public\uploads' . $image['name'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $is_delete = $product_item_colors_m->where('product_item_id', $product_item_id)->delete();
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $product_items_m = new ProductItemsModel();
        $is_delete = $product_items_m->delete($product_item_id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
