<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Permission extends Seeder
{
    public function run()
    {
        $permissions = [
            ['PermissonName' => 'full_name', 'value' => '1111',],
            ['PermissonName' => 'birthdate', 'value' => '1111'],
            ['PermissonName' => 'gender', 'value' => '1111'],
            ['PermissonName' => 'phone_number', 'value' => '1111'],
            ['PermissonName' => 'address', 'value' => '1111'],
            ['PermissonName' => 'marital_status', 'value' => '1111'],
            ['PermissonName' => 'start_date', 'value' => '1111'],
            ['PermissonName' => 'salary', 'value' => '1111'],
            ['PermissonName' => 'allowance', 'value' => '1111'],
            
            // HR Permissions
            ['PermissonName' => 'salary', 'value' => '0100'],
            ['PermissonName' => 'allowance', 'value' => '0100'],
            // Accounting Permissions
            ['PermissonName' => 'full_name', 'value' => '0100'],
            ['PermissonName' => 'birthdate', 'value' => '0000'],
            ['PermissonName' => 'gender', 'value' => '0000'],
            ['PermissonName' => 'phone_number', 'value' => '0000'],
            ['PermissonName' => 'address', 'value' => '0100'],
            ['PermissonName' => 'marital_status', 'value' => '0000'],
            ['PermissonName' => 'start_date', 'value' => '0000'],
            // Manager Permissions
            ['PermissonName' => 'birthdate', 'value' => '0100'],
            ['PermissonName' => 'gender', 'value' => '0100'],
            ['PermissonName' => 'phone_number', 'value' => '0100'],
            ['PermissonName' => 'marital_status', 'value' => '0100'],
            ['PermissonName' => 'start_date', 'value' => '0100'],
            // Employee Permissions
            ['PermissonName' => 'full_name', 'value' => '0110'],
            ['PermissonName' => 'birthdate', 'value' => '0110'],
            ['PermissonName' => 'gender', 'value' => '0110'],
            ['PermissonName' => 'phone_number', 'value' => '0110'],
            ['PermissonName' => 'address', 'value' => '0110'],
            ['PermissonName' => 'marital_status', 'value' => '0110'],
        ];


        foreach ($permissions as $permission) {
            $this->db->table('Permission')->insert($permission);
        }
    }
}
