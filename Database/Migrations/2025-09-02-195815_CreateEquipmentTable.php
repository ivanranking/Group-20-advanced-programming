<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGSERIAL',
                'null' => false,
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 120,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('equipment');
    }

    public function down()
    {
        $this->forge->dropTable('equipment');
    }
}
