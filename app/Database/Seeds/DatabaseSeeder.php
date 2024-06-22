<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('Department');
        $this->call('Role');
        $this->call('User');
        $this->call('UserProfiles');
        $this->call('Permission');
        $this->call('RolePermission');
    }
}
