<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker): void
    {
        $users = [
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
                'role' => 'URA',
                'birth_date' => '1990-01-01',
            ]
        ];

        for ($i = 0; $i < 9; $i++) {
            $users[] = [
                'email' => $faker->email,
                'password' => Hash::make('password123'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'role' => 'URA',
                'birth_date' => $faker->date,
            ];
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
