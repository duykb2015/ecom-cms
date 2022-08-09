<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributeValuesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_attribute_values';
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
        if (isset($data['name'])) {
            $this->like('name', $data['name']);
        }
        if (isset($data['key'])) {
            $this->like('key', $data['key']);
        }
        if (isset($data['value'])) {
            $this->like('value', $data['value']);
        }
        if (isset($data['status']) && $data['status'] != '') {
            $this->where('status', $data['status']);
        }
        return $this;
    }

    public function find_all()
    {
        // $this->select('pav.id, pav.name, product_attributes.product_id, pav.key, pav.value, pav.status, pav.created_at, pav.updated_at');
        // $this->join('product_attributes', 'product_attributes.id = pav.product_attribute_id');
        // return $this->findAll();
    }
}
