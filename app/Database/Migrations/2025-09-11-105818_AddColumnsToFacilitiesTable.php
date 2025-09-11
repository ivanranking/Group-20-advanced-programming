<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToFacilitiesTable extends Migration
{
    public function up()
    {
        $fields = [
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
        ];

        foreach ($fields as $field => $details) {
            if (! $this->db->fieldExists($field, 'facilities')) {
                $this->forge->addColumn('facilities', [$field => $details]);
            }
        }
    }

    public function down()
    {
        $this->forge->dropColumn('facilities', ['location', 'type', 'status']);
    }
}
