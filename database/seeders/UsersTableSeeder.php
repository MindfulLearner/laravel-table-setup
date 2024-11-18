<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'user1@example.com',
                'password' => Hash::make('password123'),
                'first_name' => 'Mario',
                'last_name' => 'Rossi',
                'role' => 'URA',
                'birth_date' => '1990-01-01',
            ],
            [
                'email' => 'user2@example.com',
                'password' => Hash::make('password123'),
                'first_name' => 'Luigi',
                'last_name' => 'Verdi',
                'role' => 'UR',
                'birth_date' => '1992-05-15',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
