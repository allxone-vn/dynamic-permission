<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'Username' => 'admin',
                'Pass' => password_hash('123', PASSWORD_DEFAULT), // Example of hashing password
                'role_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Username' => 'user2',
                'Pass' => password_hash('123', PASSWORD_DEFAULT),
                'role_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Username' => 'user3',
                'Pass' => password_hash('123', PASSWORD_DEFAULT),
                'role_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Username' => 'user4',
                'Pass' => password_hash('123', PASSWORD_DEFAULT),
                'role_id' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'Username' => 'user5',
                'Pass' => password_hash('123', PASSWORD_DEFAULT),
                'role_id' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert to database
        $this->db->table('User')->insertBatch($data);
    }
}
