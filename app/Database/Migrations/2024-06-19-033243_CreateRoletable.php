<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoletable extends Migration
{
    public function up()
    {
        $fields = [
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('role_id', true);
        $this->forge->createTable('Role');
    }

    public function down()
    {
        $this->forge->dropTable('Role');
    }
}
