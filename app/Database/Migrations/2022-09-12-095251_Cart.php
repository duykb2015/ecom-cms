<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cart extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'product_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'discount' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'discount' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'type' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ],
            'created_at DATETIME NOT NULL DEFAULT current_timestamp',
            'updated_at DATETIME NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp',
            'last_login_at DATETIME NOT NULL DEFAULT current_timestamp '
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('product_item_id', 'product_items', 'id');
        $this->forge->addForeignKey('user_id', 'user', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('cart', TRUE, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('cart', TRUE);
    }
}
