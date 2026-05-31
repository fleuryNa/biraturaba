<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembreSeeder extends Seeder
{
    public function run()
    {
        $db = db();

        $data = [
            'firstname' => 'John',
            'lastname'  => 'Doe',
            'email'     => 'john@example.test',
            'phone'     => '123456789',
            'province_id' => 1,
            'commune_id'  => 1,
            'zone_id'     => 1,
            'colline_id'  => 1,
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        $db->table('membres_inscrits')->insert($data);
    }
}
