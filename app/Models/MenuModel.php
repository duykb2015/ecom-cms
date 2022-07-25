<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'parent_id', 'name', 'type', 'status', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name'             => 'required',
    ];

    protected $validationMessages   = [
        'name'      => [
            'required' => 'Tên menu bắt buộc',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    /**
     * Get all menus
     * 
     * @param null
     * @return mixed
     *
     */

    public function get_all_menu()
    {
        $query = $this->select([
            'menu.id',
            'menu.parent_id', 'menu.name',
            'pm.name as parent_name',
            'menu.type',
            'menu.status',
            'menu.created_at',
            'menu.updated_at',
        ])  ->join('menu as pm', 'pm.id = menu.parent_id', 'left')
            ->orderBy('menu.updated_at', 'desc');


        $data['menus'] = $query->paginate(10);
        $data['pager'] = $query->pager;
        return $data;
    }
}
