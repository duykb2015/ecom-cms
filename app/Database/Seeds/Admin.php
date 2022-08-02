<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        //Seed data
        $data = [
            'username' => 'admin',
            'password'  => md5('1112'),
        ];

        // Using Query Builder
        $this->db->table('admin')->insert($data);
    }
}
