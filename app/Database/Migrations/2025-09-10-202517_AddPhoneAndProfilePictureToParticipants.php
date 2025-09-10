<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPhoneAndProfilePictureToParticipants extends Migration
{
    public function up()
    {
        $this->forge->addColumn('participants', [
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('participants', ['phone', 'profile_picture']);
    }
}
