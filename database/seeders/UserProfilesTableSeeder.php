<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserProfile;
use App\Models\User;
use Faker\Factory as Faker;

class UserProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (User::all() as $user) {
            UserProfile::create([
                'user_id' => $user->id,
                'full_name' => $faker->name,
                'date_of_birth' => $faker->date(),
                'gender' => $faker->randomElement(['Male', 'Female']),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'marital_status' => $faker->randomElement(['Single', 'Married', 'Devorced']),
                'salary' => $faker->numberBetween(30000, 100000),
            ]);
        }
    }
}

