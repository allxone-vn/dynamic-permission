<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addidroleper extends Migration
{
    public function up()
    {
     
     $fields = [
        'ID' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
    ];

    $this->forge->addColumn('role_permission', $fields);
    }

    public function down()
    {
        //
    }
}
