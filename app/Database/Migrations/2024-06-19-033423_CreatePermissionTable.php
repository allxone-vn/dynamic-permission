<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionTable extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'IDPer' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'PermissonName' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'Value' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
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

        $this->forge->addKey('IDPer', true);
        $this->forge->createTable('Permission');
    }

    public function down()
    {
        $this->forge->dropTable('Role_Permission');
    }
}
