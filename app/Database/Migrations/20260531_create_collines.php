<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCollines extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'zone_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('zone_id', 'zones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('collines');
    }

    public function down()
    {
        $this->forge->dropTable('collines');
    }
}
