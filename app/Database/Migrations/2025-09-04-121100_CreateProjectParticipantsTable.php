<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProjectParticipantsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'project_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'participant_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey(['project_id', 'participant_id'], true);
        $this->forge->addForeignKey('project_id', 'projects', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('participant_id', 'participants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('project_participants');
    }

    public function down()
    {
        $this->forge->dropTable('project_participants');
    }
}