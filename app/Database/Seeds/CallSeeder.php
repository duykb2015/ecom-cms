<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CallSeeder extends Seeder
{
    //Use command: 'php spark db:seed CallSeeder' to import seed to db
    public function run()
    {
        $this->call('Admin');
    }
}
