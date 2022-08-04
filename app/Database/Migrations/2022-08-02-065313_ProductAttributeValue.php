<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductAttributeValue extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'product_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ],
            'product_attribute_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'value' => [
                'type' => 'VARCHAR',
                'constraint' => 2048,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ],
            'created_at DATETIME NOT NULL DEFAULT current_timestamp',
            'updated_at DATETIME NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp'
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_id', 'product', 'id');
        $this->forge->addForeignKey('product_item_id', 'product_items', 'id');
        $this->forge->addForeignKey('product_attribute_id', 'product_attributes', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('product_attribute_values', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('product_attributes', TRUE);
        $this->forge->dropTable('product_attribute_values', TRUE);
    }
}
