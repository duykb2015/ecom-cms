<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;

class Product extends BaseController
{
    use ResponseTrait;
    /**
     * Used to view all products
     */
    function index()
    {
        $product_m = new ProductModel();
        $data = [
            'products' => $product_m->findAll(),
            'pager' => $product_m->pager
        ];

        return view('Product/index', $data);
    }

    /**
     * Used to create new product
     * 
     */
    function create()
    {
        if (empty($this->request->getPost())) {
            return view('Product/create');
        }

        $name              = $this->request->getPost('name');
        $slug              = create_slug($name);
        $price             = $this->request->getPost('price');
        $description       = $this->request->getPost('descriptions');
        $short_descriptons = $this->request->getPost('short_descriptions');
        $quantity          = $this->request->getPost('quantity');
        $status            = $this->request->getPost('status');

        $images            = multiple_images_upload($this->request->getFiles());

        if ($images == false) {
            $error_msg = 'Có lỗi xảy ra, vui lòng thử lại sau!';
            return redirect_with_message(site_url('product/create'), $error_msg);
        }
        $datas = [
            'name'              => $name,
            'slug'              => $slug,
            'price'             => $price,
            'descriptions'      => $description,
            'short_descriptions' => $short_descriptons,
            'quantity'          => $quantity,
            'images'            => $images,
            'status'            => $status,
        ];
        $product_m = new ProductModel();
        if (!$product_m->save($datas)) {
            $error_msg = 'Có lỗi xảy ra, vui lòng thử lại sau!';
            return redirect_with_message(site_url('product/create'), $error_msg);
        }
        return redirect()->to(site_url('product'));
    }

    /**
     * Used to edit product infomation 
     * 
     */
    function edit()
    {
        $product_m = new ProductModel();
        $id = $this->request->getGet('id');
        if (!$id) {
            return redirect()->to(site_url('product'));
        }

        $product = $product_m->find($id);
        if (!$product) {
            return redirect()->to(site_url('product'));
        }

        if (empty($this->request->getPost())) {
            $product['images'] = json_decode($product['images']);
            $data['product'] = $product;
            return view('Product/edit', $data);
        }

        $name              = $this->request->getPost('name');
        $slug              = create_slug($name);
        $price             = $this->request->getPost('price');
        $description       = $this->request->getPost('descriptions');
        $short_descriptons = $this->request->getPost('short_descriptions');
        $quantity          = $this->request->getPost('quantity');
        $status            = $this->request->getPost('status');


        $datas = [
            'name'               => $name,
            'slug'               => $slug,
            'price'              => $price,
            'descriptions'       => $description,
            'short_descriptions' => $short_descriptons,
            'quantity'           => $quantity,
            'status'            => $status,
            'updated_at'         => date('Y-m-d H:i:s')
        ];
        if ($this->request->getFiles('images')) {

            remove_images($product['images']);
            $images = multiple_images_upload($this->request->getFiles());
            if ($images == false) {
                $error_msg = 'Có lỗi xảy ra, vui lòng thử lại sau!';
                return redirect_with_message(site_url('product/create'), $error_msg);
            }
            $datas['images'] =  $images;
        }

        if (!$product_m->update($id, $datas)) {
            $error_msg = 'Có lỗi xảy ra, vui lòng thử lại sau!';
            return redirect_with_message(site_url('product/edit'), $error_msg);
        }
        return redirect()->to(site_url('product'));
    }

    /**
     * Used to change status of a product
     */
    public function change_status()
    {
        //get product id from post data
        $id = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), 200);
        }

        //prepare data to update
        $data = [
            'status'    => $this->request->getPost('status'),
        ];

        //update product status
        $product_m = new ProductModel();
        $product_m->update($id, $data);
        return $this->respond(response_successed(), 200);
    }

    /**
     * Used to delete a product
     * 
     */
    public function delete()
    {
        //get product id from post data
        $id = $this->request->getPost('id');

        //if product id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), 200);
        }

        $product_m = new ProductModel();
        $images = $product_m->select('images')->find($id);
        remove_images($images['images']);

        if (!$product_m->delete($id)) {
            return $this->respond(response_failed(), 200);
        }
        return $this->respond(response_successed(), 200);
    }
}
