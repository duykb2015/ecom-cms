<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_category';
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
        $query = $this->select('product_category.id, product_category.name, menu.name as menu_name, product_category.status, product_category.created_at, product_category.updated_at')
            ->join('menu', 'menu.id = product_category.menu_id');
        $result['product_category'] = $query->paginate(RESULT_LIMIT);
        $result['pager'] = $query->pager;
        return $result;
    }

    public function filter($data)
    {
        if ($data['name']) {
            $this->like('product_category.name', $data['name']);
        }
        if ($data['menu_id']) {
            $this->where('product_category.menu_id', $data['menu_id']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $this->where('product_category.status', $data['status']);
        }
        return $this;
    }
}
