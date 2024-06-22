<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermissionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'IDPer' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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

        $this->forge->addForeignKey('role_id', 'Role', 'role_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('IDPer', 'Permission', 'IDPer', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Role_Permission');
    }

    public function down()
    {
       
    }
}
