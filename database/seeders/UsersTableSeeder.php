<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'thanhphu2643',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role_id' => 1 // Admin
        ]);

        User::create([
            'username' => 'vanhung0809',
            'email' => 'hr@example.com',
            'password' => Hash::make('123'),
            'role_id' => 2 // HR
        ]);

        User::create([
            'username' => 'Accounting123',
            'email' => 'accounting@example.com',
            'password' => Hash::make('123'),
            'role_id' => 3 // Accounting
        ]);

        User::create([
            'username' => 'Employee123',
            'email' => 'employee@example.com',
            'password' => Hash::make('123'),
            'role_id' => 4 // Employee
        ]);
    }
}
