<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\API\ResponseTrait;
use App\Models\MonsterModel;


class Monster extends AdminController
{
    use ResponseTrait;

    function index()
    {
        $monster_m = new MonsterModel();

        $data = [
            'monsters' => $monster_m->paginate(10),
            'pager' => $monster_m->pager
        ];

        return view('Dashboard/Monster/index', $data);
    }

    function view()
    {
        $data['title'] = 'Thêm mới quái vật';
        $monster_m = new MonsterModel();
        $id = $this->request->getGet('id');
        if ($id) {
            $data['title'] = 'Chỉnh quái vật';
            $data['monster'] = $monster_m->where(['id' => $id])->first();
        }
        return view('Dashboard/Monster/save', $data);
    }

    public function save()
    {
        $monster_id = $this->request->getPost('monster_id');
        $data = [
            'id'              => $monster_id,
            'name'            => $this->request->getPost('name'),
            'name_awakened'   => $this->request->getPost('name_awakened'),
            'avatar'          => $this->request->getPost('avatar'),
            'avatar_awakened' => $this->request->getPost('avatar_awakened'),
            'parent_id'       => (int)$this->request->getPost('parent_id'),
            'type'            => $this->request->getPost('type'),
            'status'          => $this->request->getPost('status'),
        ];

        $monster_m = new MonsterModel();
        $is_save = $monster_m->save($data);
        if (!$is_save) {
            $errors = $monster_m->errors();
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
                'result' =>  ['url_redirect' => base_url('dashboard/monster')]
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
        $menu_m = new MonsterModel();
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
        $monster_m = new MonsterModel();
        $monster_m->delete($id);
        return $this->respond(
            [
                'success' => true,
                'message' => 'Xóa dữ liệu thành công',
            ],
            200
        );
    }
}
