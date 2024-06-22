<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'HR',
            ],
            [
                'role_name' => 'Accounting',
            ],
            [
                'role_name' => 'Manager',
            ],
            [
                'role_name' => 'Employee',
            ],
        ];

        foreach ($data as $item) {
            $this->db->table('Role')->insert($item);
        }
    }
}
