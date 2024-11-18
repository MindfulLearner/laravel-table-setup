<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $apartments = [
            [
                'user_id' => 1,
                'title' => 'Appartamento nel centro storico',
                'rooms' => 3,
                'beds' => 2,
                'bathrooms' => 1,
                'square_meters' => 75,
                'address' => 'Via Roma 123, Milano',
                'latitude' => 45.4642,
                'longitude' => 9.1900,
                'image' => 'apartments/default1.jpg',
                'is_visible' => true,
            ],
            [
                'user_id' => 2,
                'title' => 'Attico con vista mare',
                'rooms' => 4,
                'beds' => 3,
                'bathrooms' => 2,
                'square_meters' => 120,
                'address' => 'Via Napoli 45, Roma',
                'latitude' => 41.9028,
                'longitude' => 12.4964,
                'image' => 'apartments/default2.jpg',
                'is_visible' => true,
            ],
        ];

        foreach ($apartments as $apartment) {
            $newApartment = Apartment::create($apartment);
            
            $services = Service::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $newApartment->services()->attach($services);
        }
    }
}
