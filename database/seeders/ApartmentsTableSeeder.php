<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Apartment;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Http;

class ApartmentsTableSeeder extends Seeder
{
    public function run(Faker $faker): void
    {

     
        for ($i = 0; $i < 50; $i++) {
            $latitude = $this->createLatitude($faker);
            $longitude = $this->createLongitude($faker);
            $address = $this->findAdress($latitude, $longitude);
            $apartment = [
                'user_id' => $faker->numberBetween(1, 10),
                'title' => 'Appartamento ' . ($i + 1),
                'rooms' => $faker->numberBetween(1, 5),
                'beds' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'square_meters' => $faker->numberBetween(30, 150),
                'description' => $faker->paragraph,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $address,
                'image' => 'apartments/default' . $faker->numberBetween(1, 5) . '.jpg',
                'is_visible' => $faker->boolean,
            ];


            Apartment::create($apartment);
        }

    }
    
    // funzione che crea le coordinate intorno a Milano fake
    function createLatitude(Faker $faker) {
        return $faker->randomFloat(6, 45.45, 45.48);
    }
    function createLongitude(Faker $faker) {
        return $faker->randomFloat(6, 9.15, 9.21);
    }
    function findAdress($latitude, $longitude){
        $apiTomTomKey = env('API_TOMTOM_KEY');
        // delay per evitare di superare il limite di richieste al giorno
        usleep(100000);
        $response = Http::get('https://api.tomtom.com/search/2/reverseGeocode/' . $latitude . ',' . $longitude . '.json?key=' . $apiTomTomKey . '&language=it-IT');
        $response = $response->json();
        $freeFormAddress = $response['addresses'][0]['address']['freeformAddress'];
        return $freeFormAddress;
    }

}
