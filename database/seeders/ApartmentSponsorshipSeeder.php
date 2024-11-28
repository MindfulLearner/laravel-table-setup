<?php

namespace Database\Seeders;

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
            // random random sponsorships
            $randomSponsorships = rand(1, 4);

            if ($randomSponsorships > 0) {
                $selectedSponsorship = $sponsorships->where('id', $randomSponsorships)->first();

                if ($selectedSponsorship) {
                    $apartment->sponsorships()->attach($selectedSponsorship->id);
                }
            }
        }
    }
}
