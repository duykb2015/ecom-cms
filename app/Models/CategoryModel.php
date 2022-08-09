<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function find_all()
    {
        $query = $this->select('category.id, category.name, menu.name as menu_name, category.status, category.created_at, category.updated_at')
            ->join('menu', 'menu.id = category.menu_id')
            ->orderBy('id', 'DESC');
        $result['category'] = $query->paginate(RESULT_LIMIT);
        $result['pager'] = $query->pager;
        return $result;
    }

    public function filter($data)
    {
        if ($data['name']) {
            $this->like('category.name', $data['name']);
        }

        if (isset($data['status']) && $data['status'] != '') {
            $this->where('category.status', $data['status']);
        }
        return $this;
    }
}
