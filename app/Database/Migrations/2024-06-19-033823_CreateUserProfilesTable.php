<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProfilesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IDProfiles' => [
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true,
             ],
             'full_name' => [
                 'type' => 'VARCHAR',
                 'constraint' => '255',
             ],
             'birthdate' => [
                 'type' => 'DATE',
             ],
             'gender' => [
                 'type' => 'VARCHAR',
                 'constraint' => '10',
             ],
             'phone_number' => [
                 'type' => 'VARCHAR',
                 'constraint' => '20',
             ],
             'address' => [
                 'type' => 'TEXT',
             ],
             'marital_status' => [
                 'type' => 'VARCHAR',
                 'constraint' => '20',
             ],
             'start_date' => [
                 'type' => 'DATE',
             ],
             'salary' => [
                 'type' => 'DECIMAL',
                 'constraint' => '10,2',
             ],
             'allowance' => [
                 'type' => 'DECIMAL',
                 'constraint' => '10,2',
             ],
             'department_id' => [
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
             ],
             'UserID' => [
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
 
         $this->forge->addKey('IDProfiles', true);
         $this->forge->addForeignKey('department_id', 'Department', 'id', 'CASCADE', 'CASCADE');
         $this->forge->addForeignKey('UserID', 'User', 'UserID', 'CASCADE', 'CASCADE');
         $this->forge->createTable('UserProfiles');

    }

    public function down()
    {
        //
    }
}
