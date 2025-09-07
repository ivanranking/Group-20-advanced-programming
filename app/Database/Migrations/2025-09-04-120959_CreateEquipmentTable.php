<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'capability' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'domain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'facility_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('facility_id', 'facilities', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('equipment');
    }

    public function down()
    {
        $this->forge->dropTable('equipment');
    }
}
