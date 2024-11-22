<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\View;
use Faker\Generator as Faker;
class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            $apartment_id = $faker->numberBetween(1, 50);
            $fakeIp = $this->fakeIPCreator();
            $date = now()->subDays(rand(1, 30));
            View::create([
                'apartment_id' => $apartment_id,
                'ip_address' => $fakeIp,
                'date' => $date,
            ]);
        }
    }

    public function fakeIPCreator(): string
    {
        $ip = (floor(random_int(0, 255)) + 1) . "." . (floor(random_int(0, 255))) . "." . (floor(random_int(0, 255))) . "." . (floor(random_int(0, 255)));
        return $ip;
    }
}
