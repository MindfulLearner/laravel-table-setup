<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;


class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'apartment_id' => 1,
            'user_id' => 1,
            'sender_email' => 'test@test.com',
            'message' => 'Hello, how are you?',
        ]);
    }
}
