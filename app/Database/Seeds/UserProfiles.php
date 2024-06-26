<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserProfiles extends Seeder
{
    public function run()
    {
        $data = [
            [
                'full_name' => 'John Doe',
                'birthdate' => '1990-05-15',
                'gender' => 'Male',
                'phone_number' => '123456789',
                'address' => '123 Main St, Anytown, USA',
                'marital_status' => 'Single',
                'start_date' => '2023-01-01',
                'salary' => '5000.00',
                'allowance' => '500.00',
                'department_id' => 1,  // Ví dụ ID của phòng ban
                'UserID' =>21,          // Tương ứng với UserID trong bảng User
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Jane Smith',
                'birthdate' => '1985-08-20',
                'gender' => 'Female',
                'phone_number' => '987654321',
                'address' => '456 Elm St, Othertown, USA',
                'marital_status' => 'Married',
                'start_date' => '2022-03-15',
                'salary' => '6000.00',
                'allowance' => '600.00',
                'department_id' => 2,  // Ví dụ ID của phòng ban khác
                'UserID' => 22,          // Tương ứng với UserID khác trong bảng User
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'David Johnson',
                'birthdate' => '1988-12-10',
                'gender' => 'Male',
                'phone_number' => '555666777',
                'address' => '789 Pine Ave, Anycity, USA',
                'marital_status' => 'Single',
                'start_date' => '2021-07-01',
                'salary' => '5500.00',
                'allowance' => '400.00',
                'department_id' => 1,
                'UserID' => 23,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Emily Brown',
                'birthdate' => '1992-04-25',
                'gender' => 'Female',
                'phone_number' => '777888999',
                'address' => '567 Oak Blvd, Anothercity, USA',
                'marital_status' => 'Married',
                'start_date' => '2020-10-15',
                'salary' => '6200.00',
                'allowance' => '700.00',
                'department_id' => 2,
                'UserID' => 24,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Michael Davis',
                'birthdate' => '1987-06-30',
                'gender' => 'Male',
                'phone_number' => '111222333',
                'address' => '890 Maple Ln, Anyvillage, USA',
                'marital_status' => 'Single',
                'start_date' => '2019-05-20',
                'salary' => '4800.00',
                'allowance' => '300.00',
                'department_id' => 1,
                'UserID' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Lâm Văn Hưng',
                'birthdate' => '1987-06-30',
                'gender' => 'Male',
                'phone_number' => '111222333',
                'address' => '890 Maple Ln, Anyvillage, USA',
                'marital_status' => 'Single',
                'start_date' => '2019-05-20',
                'salary' => '4800.00',
                'allowance' => '300.00',
                'department_id' => 1,
                'UserID' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert dữ liệu vào cơ sở dữ liệu
        $this->db->table('UserProfiles')->insertBatch($data);
    }
}
