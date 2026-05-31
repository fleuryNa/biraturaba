<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateZones extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'commune_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 255],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('commune_id', 'communes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('zones');
    }

    public function down()
    {
        $this->forge->dropTable('zones');
    }
}
