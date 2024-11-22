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
       
        // get all apartments to send messages to 
        foreach (Apartment::all() as $apartment) {
            $apartmentId = $apartment->id;
            // get all users 
            foreach (User::all() as $user) {
                $recipient_name = $user->first_name . ' ' . $user->last_name;
                // Create multiple messages for each user
                for ($i = 0; $i < rand(1, 3); $i++) {
                    $message = $faker->sentence;
                    $sender_name = $faker->name;
                    Message::create([
                        'message' => $message,
                        'sender_name' => $sender_name,
                        'recipient_name' => $recipient_name,
                        'apartment_id' => $apartmentId,
                    ]);
                }
            }
        }
    }
}
