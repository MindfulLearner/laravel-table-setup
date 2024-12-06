<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $sponsorships = [
            [
                'type' => 'No sponsorship',
                'price' => 0,
                'duration' => 0,
            ],
            [
                'type' => 'Bronze',
                'price' => 2.99,
                'duration' => 24,
            ],
            [
                'type' => 'Silver',
                'price' => 5.99,
                'duration' => 72,
            ],
            [
                'type' => 'Gold',
                'price' => 9.99,
                'duration' => 144,
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            Sponsorship::create([
                'name'  => $sponsorship['type'],
                'price' => $sponsorship['price'],
                'duration' => $sponsorship['duration'],
            ]);
        }
    }
}
