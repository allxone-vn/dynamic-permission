<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionsTableSeeder extends Seeder
{
    public function run()
    {
        
        $permissionsMatrix = [
            'full_name' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '0100',  // Accounting
                4 => '0100',  // Manager
                5 => '0110',  // Employee
            ],
            'date_of_birth' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '0000',  // Accounting
                4 => '0100',  // Manager
                5 => '0110',  // Employee
            ],
            'address' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '1111',  // Accounting
                4 => '0100',  // Manager
                5 => '0100',  // Employee
            ],
            'gender' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '0000',  // Accounting
                4 => '0100',  // Manager
                5 => '0110',  // Employee
            ],
            'phone_number' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '0000',  // Accounting
                4 => '0100',  // Manager
                5 => '0110',  // Employee
            ],
            'marital_status' => [
                1 => '1111',  // Admin
                2 => '1111',  // HR
                3 => '0000',  // Accounting
                4 => '0100',  // Manager
                5 => '0110',  // Employee
            ],
            'salary' => [
                1 => '1111',  // Admin
                2 => '0100',  // HR
                3 => '1111',  // Accounting
                4 => '0100',  // Manager
                5 => '0100',  // Employee
            ],
        ];

        foreach ($permissionsMatrix as $attribute => $roles) {
            foreach ($roles as $role_id => $crudValue) {
                $permission = Permission::where('attribute', $attribute)->where('crud_value', $crudValue)->first();
                if ($permission) {
                    RolePermission::create([
                        'role_id' => $role_id,
                        'permission_id' => $permission->id,
                    ]);
                }
            }
        }
    }
}
    