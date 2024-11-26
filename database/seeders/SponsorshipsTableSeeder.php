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

        for ($i = 0; $i < 50; $i++) {
            Sponsorship::create([
                'name'  => $faker->word . ' Sponsorship',
                // prezzo in euro
                'price' => $faker->randomFloat(2, 1, 100),
            ]);
        }
    }
}
