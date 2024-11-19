<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Apartment;
use App\Models\User;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $users = User::all();
        foreach (Apartment::all() as $apartment) {
            $apartmentId = $apartment->id;
            foreach ($users as $user) {
                $user_id = $user->id;
                // Create multiple messages for each user
                for ($i = 0; $i < rand(1, 3); $i++) {
                    $sender_email = $faker->email;
                    $message = $faker->sentence;
                    Message::create([
                        'apartment_id' => $apartmentId,
                        'user_id' => $user_id,
                        'sender_email' => $sender_email,
                        'message' => $message,
                    ]);
                }
            }
        }
    }
}
