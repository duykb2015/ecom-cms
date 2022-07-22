<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class Menu extends AdminController
{
    use ResponseTrait;

    public function index()
    {
        $menu_m = new MenuModel();
        $query = $menu_m->select([
            'menu.id',
            'menu.parent_id', 'menu.name',
            'pm.name as parent_name',
            'menu.type',
            'menu.status',
            'menu.created_at',
            'menu.updated_at',
        ])
            ->join('menu as pm', 'pm.id = menu.parent_id', 'left')
            ->orderBy('menu.updated_at', 'desc');
        $data['pager'] = $query->pager;
        $data['menus'] = $query->paginate(10);
        return view('Dashboard/Menu/index', $data);
    }

    public function view()
    {
        $data['title'] = 'Thêm mới menu';
        $menu_m = new MenuModel();
        $id = $this->request->getGet('id');
        if ($id) {
            $data['title'] = 'Chỉnh menu';
            $data['menu'] = $menu_m->where(['id' => $id])->first();
        }

        $data['parent_menus'] = $menu_m->where(['parent_id' => 0, 'status' => 2])->findAll();
        return view('Dashboard/Menu/save', $data);
    }

    public function save()
    {
        $menu_id = $this->request->getPost('menu_id');
        $data = [
            'id'        => $menu_id,
            'name'      => $this->request->getPost('name'),
            'parent_id' => (int)$this->request->getPost('parent_id'),
            'type'      => $this->request->getPost('type'),
            'status'    => $this->request->getPost('status'),
        ];

        $menu_m = new MenuModel();
        $is_save = $menu_m->save($data);
        if (!$is_save) {
            $errors = $menu_m->errors();
            return $this->respond(
                [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra',
                    'result' =>  [
                        'errors' => $errors
                    ]
                ],
                200
            );
        }

        return $this->respond(
            [
                'success' => true,
                'message' => 'Thêm menu thành công',
                'result' =>  ['url_redirect' => base_url('dashboard/menu')]
            ],
            200
        );
    }

    public function action_status()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(
                [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra',
                    'result' =>  [
                        'error' => 'Dữ liệu không hợp lệ',
                    ]
                ],
                200
            );
        }

        $data = [
            'status'    => $this->request->getPost('status'),
        ];
        $menu_m = new MenuModel();
        $menu_m->update($id, $data);
        return $this->respond(
            [
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công',
            ],
            200
        );
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        if (!$id) {
            return $this->respond(
                [
                    'success' => false,
                    'message' => 'Có lỗi xảy ra',
                    'result' =>  [
                        'error' => 'Dữ liệu không hợp lệ',
                    ]
                ],
                200
            );
        }
        $menu_m = new MenuModel();
        $menu_m->delete($id);
        return $this->respond(
            [
                'success' => true,
                'message' => 'Xóa dữ liệu thành công',
            ],
            200
        );
    }
}
