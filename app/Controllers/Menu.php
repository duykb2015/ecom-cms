<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class Menu extends BaseController
{
    use ResponseTrait;


    /**
     * View all menu
     * 
     * @return string HTML view
     */
    public function index()
    {
        $menu_m = new MenuModel();

        return view('Menu/index', $menu_m->get_all_menu());
    }

    /**
     * View a menu
     * 
     * @return string HTML view
     */
    public function view()
    {
        $menu_m = new MenuModel();
        $id = $this->request->getGet('id');
        if ($id) {
            $data['title'] = 'Chỉnh menu';
            $data['menu'] = $menu_m->where(['id' => $id])->first();
        }

        $data['parent_menus'] = $menu_m->where(['parent_id' => 0, 'status' => 1])->findAll();
        return view('Menu/save', $data);
    }

    /**
     * Save a menu
     * 
     * @return Response JSON
     */
    public function save()
    {
        //get post data
        $menu_id = $this->request->getPost('menu_id');
        $data = [
            'id'        => $menu_id,
            'name'      => $this->request->getPost('name'),
            'parent_id' => (int)$this->request->getPost('parent_id'),
            'type'      => $this->request->getPost('type'),
            'status'    => $this->request->getPost('status'),
        ];

        $menu_m = new MenuModel();

        //if menu_id is empty, then insert new menu else update menu
        $is_save = $menu_m->save($data);

        //handle response
        if (!$is_save) {
            $errors = $menu_m->errors();
            return $this->respond(response_failed($errors), 200);
        }

        return $this->respond(response_successed(base_url('menu')), 200);
    }

    /**
     * Change status of a menu
     * 
     * @return Response JSON
     */
    public function action_status()
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
     * Delete a menu
     * 
     * @return Response JSON
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
        $menu_m->delete($id);
        return $this->respond(response_successed(), 200);
    }
}
