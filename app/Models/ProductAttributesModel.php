<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_attributes';
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
        $query = $this->select();
        if ($data['name']) {
            $query->like('name', $data['name']);
        }
        //use isset because value of this data can be 0 and it will skip this condition
        if (isset($data['is_group']) && $data['is_group'] != '') {
            $query->where('is_group', $data['is_group']);
        }

        $result['product_attributes'] = $query->paginate(20);
        $result['pager'] = $query->pager;
        return $result;
    }

    public function find_all()
    {
        $query = $this->select([
            'product_attributes.id',
            'product_attributes.name',
            'pav.id as pav_id',
            'pav.value',
            'product_attributes.is_group',
            'product_attributes.created_at',
            'product_attributes.updated_at'
        ])->where('is_group', 1)
            ->join('product_attribute_values as pav', 'product_attributes.id = pav.product_attribute_id', 'left');
        return  $query->findAll();
    }

    public function find_all_id($product_id)
    {
        $query = $this->select([
            'product_attributes.id',
            'pav.id as pav_id',
        ])->where('is_group', 1)
            ->join('product_attribute_values as pav', 'product_attributes.id = pav.product_attribute_id', 'left')
            ->where('pav.product_id', $product_id);
        return  $query->findAll();
    }
}
