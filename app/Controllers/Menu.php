<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class Menu extends BaseController
{
    use ResponseTrait;


    /**
     * Used to view all menus
     * 
     */
    public function index()
    {
        $menu_m = new MenuModel();
        //The method is not deprecated, the optional [$upper] parameter is deprecated.
        if ($this->request->getMethod() == 'get') {
            $menu_name   = $this->request->getGet('menu_name');
            $menu_parent = $this->request->getGet('menu_parent');
            $menu_type   = $this->request->getGet('menu_type');
            $menu_status = $this->request->getGet('menu_status');
            $filter_data = [
                'name'      => $menu_name,
                'parent_id' => $menu_parent,
                'type'      => $menu_type,
                'status'    => $menu_status,
            ];
            $menu_m->filter($filter_data);
        }

        $data = $menu_m->find_all();
        $parent_menu = $menu_m->where(['parent_id' => 0, 'status' => 1])->findAll();
        $data['parent_menu'] = $parent_menu;
        return view('Menu/index', $data);
    }

    /**
     * Used to view menu infomation 
     * 
     */
    public function detail()
    {
        $menu_id = $this->request->getUri()->getSegment(3);
        $menu_m = new MenuModel();
        $data['parent_menu'] = $menu_m->where(['parent_id' => 0, 'status' => 1])->findAll();

        if (!$menu_id) {
            $data['title'] = "Thêm Mới Menu";
            return view('menu/detail', $data);
        }

        $menu = $menu_m->find($menu_id);
        //just in case if menu not found
        if (!$menu) {
            return redirect()->to('/menu');
        }

        $data['title'] = "Chỉnh Sửa Menu";
        $data['menu'] = $menu;
        return view('menu/detail', $data);
    }

    /**
     * Combination of create and update that will attempt to determine whether the data should be inserted or updated.
     * 
     */
    public function save()
    {
        //get post data
        $menu_id        = $this->request->getPost('menu_id');
        $menu_name      = $this->request->getPost('name');
        $menu_slug      = $this->request->getPost('slug');
        $menu_parent_id = $this->request->getPost('parent_id');
        $menu_status    = $this->request->getPost('status');
        $menu_type      = ($menu_parent_id == 0) ? 0 : 1;

        $data = [
            'name'      => $menu_name,
            'slug'      => $menu_slug,
            'parent_id' => $menu_parent_id,
            'type'      => $menu_type,
            'status'    => $menu_status
        ];

        $menu_m = new MenuModel();
        $menu = $menu_m->where(['slug' => $menu_slug])->find();
        if ($menu) {
            return redirect_with_message(base_url('menu/detail'), 'Menu đã tồn tại');
        }
        if ($menu_id) {
            $data['id'] = $menu_id;
        }

        if (!$menu_m->save($data)) {
            return redirect_with_message(site_url('menu/create/' . $menu_id), UNEXPECTED_ERROR_MESSAGE);
        }
        return redirect()->to('menu');
    }

    /**
     * Used to change status of a menu
     * 
     */
    public function change_status()
    {
        //get menu id from post data
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        $data['status'] = $this->request->getPost('status');
        $menu_m = new MenuModel();
        $is_update = $menu_m->update($id, $data);
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
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(response_failed(), HTTP_OK);
        }

        //delete menu
        $menu_m = new MenuModel();
        $is_delete = $menu_m->delete($id);
        if (!$is_delete) {
            return $this->respond(response_failed(), HTTP_OK);
        }
        return $this->respond(response_successed(), HTTP_OK);
    }
}
