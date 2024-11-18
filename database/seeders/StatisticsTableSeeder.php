<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Statistics;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = Apartment::all();
        foreach ($apartments as $apartment) {
            $views = rand(1, 100);
            $messages = rand(1, 10);
            $clicks = rand(1, 100);
            Statistics::create([
                'apartment_id' => $apartment->id,
                'views' => $views,
                'messages' => $messages,
                'clicks' => $clicks,
            ]);
        }
    }
}
