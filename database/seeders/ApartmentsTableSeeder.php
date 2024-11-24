<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Faker\Generator as Faker;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 50; $i++) {
            $apartment = [
                'user_id' => $faker->numberBetween(1, 10),
                'title' => 'Appartamento ' . ($i + 1),
                'rooms' => $faker->numberBetween(1, 5),
                'beds' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'square_meters' => $faker->numberBetween(30, 150),
                'address' => $faker->streetAddress . ', ' . $faker->city,
                'latitude' => $faker->latitude(min: 35, max: 71),
                'longitude' => $faker->longitude(min: -31, max: 39),
                'image' => 'apartments/default' . $faker->numberBetween(1, 5) . '.jpg',
                'is_visible' => $faker->boolean,
            ];

            Apartment::create($apartment);
        }
    }
}
