<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\API\ResponseTrait;
use App\Models\TagModel;

class Tag extends AdminController
{
    use ResponseTrait;

    public function index()
    {
        return view('Dashboard/Tag/index');
    }

    public function view()
    {
        $data['title'] = 'Thêm mới tag';
        return view('Dashboard/Tag/save', $data);
    }

    public function save()
    {
        $menu_id = $this->request->getPost('menu_id');
        $data = [
            'id'        => $menu_id,
            'name'      => $this->request->getPost('name'),
            'type'      => $this->request->getPost('type'),
            'status'    => $this->request->getPost('status'),
        ];

        $tag_m = new TagModel();
        $is_save = $tag_m->save($data);
        if (!$is_save) {
            $errors = $tag_m->errors();
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
                'message' => 'Thêm tag thành công',
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
        $tag_m = new TagModel();
        $tag_m->update($id, $data);
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
        $tag_m = new TagModel();
        $tag_m->delete($id);
        return $this->respond(
            [
                'success' => true,
                'message' => 'Xóa dữ liệu thành công',
            ],
            200
        );
    }
}
