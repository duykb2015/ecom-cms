<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductItems extends Migration
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
                'null' => FALSE,
            ],
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 2048,
            ],
            'slug' => [
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
        $this->forge->addForeignKey('admin_id', 'admin', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('product_items', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('product_items', TRUE);
    }
}
