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
                'name' => 'Mario',
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        for ($i = 0; $i < 9; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
