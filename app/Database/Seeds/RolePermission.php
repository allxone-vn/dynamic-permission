<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolePermission extends Seeder
{
    public function run()
    {
        $rolePermissions = [
            // Admin
            ['role_id' => 1, 'IDPer' => 1],
            ['role_id' => 1, 'IDPer' => 2],
            ['role_id' => 1, 'IDPer' => 3],
            ['role_id' => 1, 'IDPer' => 4],
            ['role_id' => 1, 'IDPer' => 5],
            ['role_id' => 1, 'IDPer' => 6],
            ['role_id' => 1, 'IDPer' => 7],
            ['role_id' => 1, 'IDPer' => 8],
            ['role_id' => 1, 'IDPer' => 9],
            // HR
            ['role_id' => 2, 'IDPer' => 1],
            ['role_id' => 2, 'IDPer' => 2],
            ['role_id' => 2, 'IDPer' => 3],
            ['role_id' => 2, 'IDPer' => 4],
            ['role_id' => 2, 'IDPer' => 5],
            ['role_id' => 2, 'IDPer' => 6],
            ['role_id' => 2, 'IDPer' => 7],
            ['role_id' => 2, 'IDPer' => 10],
            ['role_id' => 2, 'IDPer' => 11],
            // Accounting
            ['role_id' => 3, 'IDPer' => 12],
            ['role_id' => 3, 'IDPer' => 13],
            ['role_id' => 3, 'IDPer' => 14],
            ['role_id' => 3, 'IDPer' => 15],
            ['role_id' => 3, 'IDPer' => 16],
            ['role_id' => 3, 'IDPer' => 17],
            ['role_id' => 3, 'IDPer' => 18],
            ['role_id' => 3, 'IDPer' => 8],
            ['role_id' => 3, 'IDPer' => 9],
            // Manager
            ['role_id' => 4, 'IDPer' => 12],
            ['role_id' => 4, 'IDPer' => 19],
            ['role_id' => 4, 'IDPer' => 20],
            ['role_id' => 4, 'IDPer' => 16],
            ['role_id' => 4, 'IDPer' => 21],
            ['role_id' => 4, 'IDPer' => 22],
            ['role_id' => 4, 'IDPer' => 23],
            ['role_id' => 4, 'IDPer' => 10],
            ['role_id' => 4, 'IDPer' => 11],
            // Employee
            ['role_id' => 5, 'IDPer' => 24],
            ['role_id' => 5, 'IDPer' => 25],
            ['role_id' => 5, 'IDPer' => 26],
            ['role_id' => 5, 'IDPer' => 27],
            ['role_id' => 5, 'IDPer' => 28],
            ['role_id' => 5, 'IDPer' => 29],
            ['role_id' => 5, 'IDPer' => 22],
            ['role_id' => 5, 'IDPer' => 10],
            ['role_id' => 5, 'IDPer' => 11],
        ];

        foreach ($rolePermissions as $rolePermission) {
            $this->db->table('Role_Permission')->insert($rolePermission);
        }
    }
}
