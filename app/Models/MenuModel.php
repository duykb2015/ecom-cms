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
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    /**
     * Custom function. Find all menu from database with specific conditions.
     * 
     * @return array|null
     *
     */

    public function find_all()
    {
        $query = $this->select([
            'menu.id',
            'menu.parent_id',
            'menu.name',
            'pm.name as parent_name',
            'menu.type',
            'menu.status',
            'menu.created_at',
            'menu.updated_at',
        ])->join('menu as pm', 'pm.id = menu.parent_id', 'left')
            ->orderBy('menu.updated_at', 'desc');

        $data['menu'] = $query->paginate(10);
        $data['pager'] = $query->pager;

        return $data;
    }

    /**
     * Add condition to query before find all menu.
     * 
     * @return array|null
     *
     */
    public function filter($data)
    {
        if ($data['name']) {
            $this->like('menu.name', $data['name']);
        }
        if ($data['parent_id']) {
            $this->where('menu.parent_id', $data['parent_id']);
        }
        if ($data['type']) {
            $this->where('menu.type', $data['type']);
        }
        return $this;
    }
}
