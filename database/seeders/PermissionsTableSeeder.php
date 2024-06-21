<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $attributes = ['full_name', 'date_of_birth', 'address', 'gender', 'phone_number', 'marital_status', 'salary'];
        $crudValues = [
            '0000', '0001', '0010', '0011',
            '0100', '0101', '0110', '0111',
            '1000', '1001', '1010', '1011',
            '1100', '1101', '1110', '1111'
        ];

        foreach ($attributes as $attribute) {
            foreach ($crudValues as $crudValue) {
                Permission::create([
                    'attribute' => $attribute,
                    'crud_value' => $crudValue,
                ]);
            }
        }
    }
}

