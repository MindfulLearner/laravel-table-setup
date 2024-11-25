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
                'name' => 'Mario',
            ]
        ];

        for ($i = 0; $i < 9; $i++) {
            $users[] = [
                'email' => $faker->email,
                'password' => Hash::make('password123'),
                'name' => $faker->firstName,
            ];
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
