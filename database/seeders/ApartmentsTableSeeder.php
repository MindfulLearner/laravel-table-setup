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
       $apartmentImages = [
            "https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg",
            "https://images.pexels.com/photos/3639655/pexels-photo-3639655.jpeg",
            "https://images.pexels.com/photos/3705526/pexels-photo-3705526.jpeg",
            "https://images.pexels.com/photos/276672/pexels-photo-276672.jpeg",
            "https://images.pexels.com/photos/276692/pexels-photo-276692.jpeg",
            "https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg",
            "https://images.pexels.com/photos/2099649/pexels-photo-2099649.jpeg",
            "https://images.pexels.com/photos/534220/pexels-photo-534220.jpeg",
            "https://images.pexels.com/photos/271800/pexels-photo-271800.jpeg",
            "https://images.pexels.com/photos/276727/pexels-photo-276727.jpeg",
            "https://images.pexels.com/photos/1571464/pexels-photo-1571464.jpeg",
            "https://images.pexels.com/photos/1643387/pexels-photo-1643387.jpeg",
            "https://images.pexels.com/photos/3639661/pexels-photo-3639661.jpeg",
            "https://images.pexels.com/photos/3705524/pexels-photo-3705524.jpeg",
            "https://images.pexels.com/photos/261145/pexels-photo-261145.jpeg",
            "https://images.pexels.com/photos/276701/pexels-photo-276701.jpeg",
            "https://images.pexels.com/photos/276665/pexels-photo-276665.jpeg",
            "https://images.pexels.com/photos/2102581/pexels-photo-2102581.jpeg",
            "https://images.pexels.com/photos/276691/pexels-photo-276691.jpeg",
            "https://images.pexels.com/photos/1866152/pexels-photo-1866152.jpeg",
            "https://images.pexels.com/photos/2099644/pexels-photo-2099644.jpeg",
            "https://images.pexels.com/photos/534212/pexels-photo-534212.jpeg",
            "https://images.pexels.com/photos/271808/pexels-photo-271808.jpeg",
            "https://images.pexels.com/photos/2079237/pexels-photo-2079237.jpeg",
            "https://images.pexels.com/photos/1986105/pexels-photo-1986105.jpeg",
            "https://images.pexels.com/photos/276694/pexels-photo-276694.jpeg",
            "https://images.pexels.com/photos/276672/pexels-photo-276672.jpeg",
            "https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg",
            "https://images.pexels.com/photos/1643389/pexels-photo-1643389.jpeg",
            "https://images.pexels.com/photos/3639654/pexels-photo-3639654.jpeg",
            "https://images.pexels.com/photos/3705525/pexels-photo-3705525.jpeg",
            "https://images.pexels.com/photos/261143/pexels-photo-261143.jpeg",
            "https://images.pexels.com/photos/2079243/pexels-photo-2079243.jpeg",
            "https://images.pexels.com/photos/1986104/pexels-photo-1986104.jpeg",
            "https://images.pexels.com/photos/276693/pexels-photo-276693.jpeg",
            "https://images.pexels.com/photos/1866151/pexels-photo-1866151.jpeg",
            "https://images.pexels.com/photos/2099643/pexels-photo-2099643.jpeg",
            "https://images.pexels.com/photos/534215/pexels-photo-534215.jpeg",
            "https://images.pexels.com/photos/271809/pexels-photo-271809.jpeg",
            "https://images.pexels.com/photos/2079238/pexels-photo-2079238.jpeg",
            "https://images.pexels.com/photos/276666/pexels-photo-276666.jpeg",
            "https://images.pexels.com/photos/276702/pexels-photo-276702.jpeg",
            "https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg",
            "https://images.pexels.com/photos/276692/pexels-photo-276692.jpeg",
            "https://images.pexels.com/photos/261146/pexels-photo-261146.jpeg",
            "https://images.pexels.com/photos/276727/pexels-photo-276727.jpeg",
            "https://images.pexels.com/photos/534220/pexels-photo-534220.jpeg",
            "https://images.pexels.com/photos/271800/pexels-photo-271800.jpeg"
          ];

     
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
                'image' => $apartmentImages[$faker->numberBetween(0, count($apartmentImages) - 1)],
                'is_visible' => $faker->boolean,
            ];


            Apartment::create($apartment);
        }

    }
    
    /**
     * funzione che crea le coordinate intorno a Milano fake
     * genera una latitudine casuale intorno a Milano (45.4642) con un raggio di 20 km
     */
    function createLatitude(Faker $faker) {
        return $faker->randomFloat(6, 45.2642, 45.6642);
    }
    /**
     * funzione che crea le coordinate intorno a Milano fake
     * genera una longitudine casuale intorno a Milano (9.1918) con un raggio di 20 km
     */
    function createLongitude(Faker $faker) {
        return $faker->randomFloat(6, 8.9900, 9.3900);
    }
    /**
     * funzione che trova l'indirizzo a partire dalle coordinate
     */
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
