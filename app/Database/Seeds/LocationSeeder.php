<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run()
    {
        $db = db();

        $provinces = [
            ['id'=>1,'name'=>'Province A'],
            ['id'=>2,'name'=>'Province B'],
        ];
        $db->table('provinces')->insertBatch($provinces);

        $communes = [
            ['id'=>1,'province_id'=>1,'name'=>'Commune A1'],
            ['id'=>2,'province_id'=>1,'name'=>'Commune A2'],
            ['id'=>3,'province_id'=>2,'name'=>'Commune B1'],
        ];
        $db->table('communes')->insertBatch($communes);

        $zones = [
            ['id'=>1,'commune_id'=>1,'name'=>'Zone 1'],
            ['id'=>2,'commune_id'=>2,'name'=>'Zone 2'],
            ['id'=>3,'commune_id'=>3,'name'=>'Zone 3'],
        ];
        $db->table('zones')->insertBatch($zones);

        $collines = [
            ['id'=>1,'zone_id'=>1,'name'=>'Colline 1'],
            ['id'=>2,'zone_id'=>2,'name'=>'Colline 2'],
            ['id'=>3,'zone_id'=>3,'name'=>'Colline 3'],
        ];
        $db->table('collines')->insertBatch($collines);
    }
}
