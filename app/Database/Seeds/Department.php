<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Department extends Seeder
{
    public function run()
    {
        $data = [
            [
                'department_name' => 'Human resouces department',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'department_name' => 'Accounting department ',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'department_name' => 'Technical Department',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'department_name' => 'Business Department',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($data as $item) {
            $this->db->table('Department')->insert($item);
        }
    }
}
