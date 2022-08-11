<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductItemsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_items';
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

    public function filter($data)
    {
        if ($data['name']) {
            $this->like('name', $data['name']);
        }
        if ($data['product_id']) {
            $this->where('product_id ', $data['product_id']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $this->where('status', $data['status']);
        }
        return $this;
    }
}
