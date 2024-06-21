<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Admin', 'HR', 'Accounting', 'Manager', 'Employee'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}

