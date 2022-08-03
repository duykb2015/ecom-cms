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
        $data['parent_menu'] = $menu_m->where(['parent_id' => 0, 'status' => 1])->findAll();
        if ($this->request->getPost()) {
            $filter_menu_name   = $this->request->getPost('filter_menu_name');
            $filter_menu_parent = $this->request->getPost('filter_menu_parent');
            $filter_menu_type   = $this->request->getPost('filter_menu_type');
            $filter_data = [
                'filter_menu_name'   => $filter_menu_name,
                'filter_menu_parent' => $filter_menu_parent,
                'filter_menu_type'   => $filter_menu_type,
            ];
            $data['menu'] = $menu_m->orLike('name', $filter_menu_name)
                ->orWhere('parent_id', $filter_menu_parent)
                ->orWhere('type', $filter_menu_type)
                ->findAll();
            
            return view('Menu/index', $data);
        }
        $data = $menu_m->find_all();
        return view('Menu/index', $data);
    }

    /**
     * Used to view menu infomation 
     * 
     */
    public function view()
    {
        $id = $this->request->getGet('id');
        $menu_m = new MenuModel();
        $data['parent_menu'] = $menu_m->where(['parent_id' => 0, 'status' => 1])->findAll();

        if (!$id) {
            $data['title'] = "Thêm Mới Menu";
            return view('menu/save', $data);
        }

        $menu = $menu_m->find($id);
        //just in case if menu not found
        if (empty($menu)) {
            return redirect()->to('/menu');
        }

        $data['title'] = "Chỉnh Sửa Menu";
        $data['menu'] = $menu;
        return view('menu/save', $data);
    }


    /**
     * Used to create new menu or update existing menu
     * 
     */
    public function save()
    {
        //get post data
        $menu_id   = $this->request->getPost('menu_id');
        $name      = $this->request->getPost('name');
        $slug      = $this->request->getPost('slug');
        $parent_id = $this->request->getPost('parent_id');
        $type      = $this->request->getPost('type');
        $status    = $this->request->getPost('status');

        $data = [
            'name' => $name,
            'slug' => $slug,
            'parent_id' => $parent_id,
            'type' => $type,
            'status' => $status
        ];
        $menu_m = new MenuModel();
        //if menu_id is empty, then insert new menu else update menu
        if ($menu_id) {
            $data['id'] = $menu_id;
        }

        if (!$menu_m->save($data)) {
            return redirect_with_message(site_url('menu/create'), UNEXPECTED_ERROR);
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

        //if menu id is empty, return error response
        if (!$id) {
            return $this->respond(response_failed(), 200);
        }

        //prepare data to update
        $data = [
            'status'    => $this->request->getPost('status'),
        ];

        //update menu status
        $menu_m = new MenuModel();
        $menu_m->update($id, $data);
        return $this->respond(response_successed(), 200);
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
            return $this->respond(response_failed(), 200);
        }

        //delete menu
        $menu_m = new MenuModel();
        if (!$menu_m->delete($id)) {
            return $this->respond(response_failed(), 200);
        }
        return $this->respond(response_successed(), 200);
    }
}
