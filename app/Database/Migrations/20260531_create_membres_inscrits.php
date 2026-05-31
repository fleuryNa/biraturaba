<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembresInscrits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'firstname' => ['type' => 'VARCHAR', 'constraint' => 120],
            'lastname' => ['type' => 'VARCHAR', 'constraint' => 120],
            'email' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'province_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'commune_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'zone_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'colline_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('province_id', 'provinces', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('commune_id', 'communes', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('zone_id', 'zones', 'id', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('colline_id', 'collines', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('membres_inscrits');
    }

    public function down()
    {
        $this->forge->dropTable('membres_inscrits');
    }
}
