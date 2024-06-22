<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'UserID' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Username' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'Pass' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'role_id' => [
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

        $this->forge->addKey('UserID', true);
        $this->forge->addForeignKey('role_id', 'Role', 'role_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('User');
    }

    public function down()
    {
        $this->forge->dropTable('User');
    }
}
