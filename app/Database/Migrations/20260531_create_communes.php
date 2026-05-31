<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCommunes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'province_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('province_id', 'provinces', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('communes');
    }

    public function down()
    {
        $this->forge->dropTable('communes');
    }
}
