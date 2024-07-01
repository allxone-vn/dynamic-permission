<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Salary;
use Faker\Factory as Faker;

class SalariesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user) {
            $basicSalary = $faker->randomFloat(2, 5000000, 20000000); // Lương cơ bản
            $allowance = $faker->randomFloat(2, 500000, 5000000); // Phụ cấp
            $socialInsurance = $basicSalary * 0.08; // Bảo hiểm xã hội 8%
            $healthInsurance = $basicSalary * 0.015; // Bảo hiểm y tế 1.5%
            $unemploymentInsurance = $basicSalary * 0.01; // Bảo hiểm thất nghiệp 1%
            $personalIncomeTax = $faker->randomFloat(2, 500000, 3000000); // Thuế thu nhập cá nhân
            $totalSalary = $basicSalary + $allowance - $socialInsurance - $healthInsurance - $unemploymentInsurance - $personalIncomeTax; // Tổng lương

            Salary::create([
                'user_id' => $user->id,
                'basic_salary' => $basicSalary,
                'allowance' => $allowance,
                'social_insurance' => $socialInsurance,
                'health_insurance' => $healthInsurance,
                'unemployment_insurance' => $unemploymentInsurance,
                'personal_income_tax' => $personalIncomeTax,
                'total_salary' => $totalSalary,
            ]);
        }
    }
}
