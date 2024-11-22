<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = Apartment::all();
        $services = Service::all();
        foreach ($apartments as $apartment) {
            $apartment->services()->attach($services->random(rand(2, 5)));
        }
    }
}
