<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGoogleIdToUserTable extends Migration
{
    public function up()
    {
        $fields = [
            'google_id' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'role_id' // Đặt cột mới sau cột 'role_id'
            ],
        ];

        $this->forge->addColumn('User', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('User', 'google_id');
    }
}
