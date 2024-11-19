<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Sponsorship;
use App\Models\Apartment;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            Sponsorship::create([
                'name' => 'Sponsorship ' . ($i + 1),
                'price' => $faker->numberBetween(1, 100),
            ]);
        }
    }
}
