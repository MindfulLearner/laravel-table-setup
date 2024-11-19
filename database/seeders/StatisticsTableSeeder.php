<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Statistics;
use Faker\Generator as Faker;
class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            $date = now()->subDays(rand(1, 30));
            $views = $faker->numberBetween(1, 100);
            $messages = $faker->numberBetween(1, 10);
            $clicks = $faker->numberBetween(1, 100);
            Statistics::create([
                'apartment_id' => $faker->numberBetween(1, 50),
                'views' => $views,
                'messages' => $messages,
                'clicks' => $clicks,
                'date' => $date,
            ]);
        }
    }
}
