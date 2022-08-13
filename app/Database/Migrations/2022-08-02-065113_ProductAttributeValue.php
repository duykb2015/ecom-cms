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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 512,
                'null' => FALSE,
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
