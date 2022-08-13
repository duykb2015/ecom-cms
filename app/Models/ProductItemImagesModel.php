<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductItemImagesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_item_images';
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

    /**
     * Convinient method to insert product attribute
     * 
     * @param array $data Data to insert
     * @param array $where where to find in product attribute
     * @param bool $clean_data if this parameter is provide, it will delete unnecessary data in product attribute table
     * @return bool
     */

    public function insertOrDelete($data, array $where, $clean_data = true)
    {
        if (!is_array($data)) {
            return false;
        }
        $product_item_images = $this->where($where)->findAll();

        if ($clean_data) {
            $product_item_images_name = array_column($data, 'name');
            foreach ($product_item_images as $row) {
                if (!in_array($row['name'], $product_item_images_name)) {
                    $this->delete($row['id']);
                }
            }
        }

        foreach ($data as $row) {
            if (in_array($row['name'], array_column($product_item_images, 'name'))) {
                continue;
            }
            $is_insert = $this->insert($row);
            if (!$is_insert) {
                return $is_insert;
            }
        }
        return true;
    }
}
