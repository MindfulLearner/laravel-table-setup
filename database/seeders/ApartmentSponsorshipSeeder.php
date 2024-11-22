<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Sponsorship;

class ApartmentSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = Apartment::all();
        $sponsorships = Sponsorship::all();
        foreach ($apartments as $apartment) {
            $apartment->sponsorships()->attach($sponsorships->random(rand(1, 3)));
        }
    }
}
