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
            "https://images.pexels.com/photos/439391/pexels-photo-439391.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/129494/pexels-photo-129494.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1454805/pexels-photo-1454805.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/2099649/pexels-photo-2099649.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/534220/pexels-photo-534220.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/271800/pexels-photo-271800.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276727/pexels-photo-276727.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/7601277/pexels-photo-7601277.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/11262209/pexels-photo-11262209.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/5502249/pexels-photo-5502249.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/3705524/pexels-photo-3705524.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/261145/pexels-photo-261145.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276701/pexels-photo-276701.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276665/pexels-photo-276665.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/27626181/pexels-photo-27626181/free-photo-of-sagoma-casa-architettura-lusso.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load",
            "https://images.pexels.com/photos/276691/pexels-photo-276691.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1866152/pexels-photo-1866152.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/5556179/pexels-photo-5556179.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/534212/pexels-photo-534212.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/271808/pexels-photo-271808.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/2079237/pexels-photo-2079237.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1986105/pexels-photo-1986105.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276694/pexels-photo-276694.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg",
            "https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg",
            "https://images.pexels.com/photos/1643389/pexels-photo-1643389.jpeg",
            "https://images.pexels.com/photos/24245781/pexels-photo-24245781/free-photo-of-case-casa-cucina-in-legno.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/7515855/pexels-photo-7515855.png?auto=compress&cs=tinysrgb&w=600&lazy=load",
            "https://images.pexels.com/photos/261143/pexels-photo-261143.jpeg",
            "https://images.pexels.com/photos/5353878/pexels-photo-5353878.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1986104/pexels-photo-1986104.jpeg",
            "https://images.pexels.com/photos/276693/pexels-photo-276693.jpeg",
            "https://images.pexels.com/photos/1866151/pexels-photo-1866151.jpeg",
            "https://images.pexels.com/photos/2099643/pexels-photo-2099643.jpeg",
            "https://images.pexels.com/photos/534215/pexels-photo-534215.jpeg",
            "https://images.pexels.com/photos/6489127/pexels-photo-6489127.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
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
                'title' => $this->generateTitle($faker),
                'rooms' => $faker->numberBetween(1, 5),
                'beds' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 3),
                'square_meters' => $faker->numberBetween(30, 150),
                'description' => $faker->paragraph,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $address,
                'cover_image' => $apartmentImages[$faker->numberBetween(0, count($apartmentImages) - 1)],
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

    function generateTitle(Faker $faker){
        $titles = [
            "Casa su attico",
            "Appartamento elegante",
            "Monolocale moderno",
            "Bilocale luminoso",
            "Appartamento con vista",
            "Casa accogliente",
            "Appartamento chic",
            "Loft artistico",
            "Appartamento raffinato",
            "Casa storica",
            "Appartamento con terrazza",
            "Casa di design",
            "Monolocale affacciato sul canale",
            "Appartamento vintage",
            "Casa con giardino",
            "Appartamento luminoso",
            "Loft spazioso",
            "Casa in stile industriale",
            "Appartamento con vista panoramica",
            "Bilocale accogliente",
            "Casa moderna",
            "Appartamento con balcone",
            "Monolocale elegante",
            "Casa con piscina",
            "Appartamento in stile minimalista",
            "Casa con camino",
            "Appartamento con soffitti alti",
            "Loft contemporaneo",
            "Casa in stile classico",
            "Appartamento con vista sul parco",
            "Casa di charme",
            "Appartamento con arredi di design",
            "Monolocale accogliente",
            "Attico di lusso",
            "Appartamento con spa",
            "Casa con terrazza panoramica",
            "Appartamento in stile bohemien",
            "Loft con soppalco",
            "Casa con giardino pensile",
            "Appartamento con camino",
            "Monolocale con angolo cottura",
            "Casa con vista sul lago",
            "Appartamento con piscina privata",
            "Casa in stile rustico",
            "Appartamento con area barbecue",
            "Loft con pareti in mattoni",
            "Casa con studio",
            "Appartamento con zona living ampia",
            "Monolocale con design innovativo",
            "Casa con soffitti a volta",
            "Appartamento con angolo lettura",
            "Casa con elementi storici",
            "Appartamento con cucina gourmet",
            "Loft con finestre a tutta altezza",
            "Casa con dettagli artigianali",
            "Appartamento con zona notte separata",
            "Monolocale con decorazioni artistiche",
            "Casa con accesso diretto al rooftop",
            "Appartamento con vista sulla città",
            "Casa con spazi aperti",
            "Appartamento con arredi vintage",
            "Loft con area relax",
            "Casa con dettagli in legno",
            "Appartamento con illuminazione d'atmosfera",
            "Monolocale con design scandinavo",
            "Casa con elementi moderni",
            "Appartamento con zona pranzo all'aperto",
            "Loft con cucina a vista",
            "Casa con spazi multifunzionali",
            "Appartamento con dettagli di lusso",
            "Monolocale con vista sul tramonto",
            "Casa con accesso a giardino condiviso",
            "Appartamento con decorazioni floreali",
            "Loft con area di lavoro",
            "Casa con elementi di design contemporaneo",
            "Appartamento con zona relax",
            "Monolocale con dettagli colorati",
            "Casa con accesso a terrazza comune",
            "Appartamento con vista sul fiume",
            "Loft con spazi aperti e luminosi",
            "Casa con dettagli storici",
            "Appartamento con angolo cottura attrezzato",
            "Monolocale con decorazioni artistiche",
            "Casa con accesso a piscina condominiale",
            "Appartamento con vista sul giardino",
            "Loft con elementi industriali",
            "Casa con spazi verdi",
            "Appartamento con dettagli eleganti",
            "Monolocale con angolo lettura accogliente",
            "Casa con accesso a terrazza privata",
            "Appartamento con vista sulla skyline",
            "Loft con arredi moderni",
            "Casa con spazi per eventi",
            "Appartamento con dettagli unici",
            "Monolocale con decorazioni vintage",
            "Casa con accesso a giardino pensile",
            "Appartamento con vista sul mare",
            "Loft con spazi per la creatività",
            "Casa con dettagli in ferro battuto",
            "Appartamento con angolo cottura open space",
            "Monolocale con decorazioni artistiche",
            "Casa con accesso a terrazza panoramica",
            "Appartamento con vista sulla città vecchia",
            "Loft con spazi per il relax",
            "Casa con dettagli in pietra",
            "Appartamento con angolo lettura luminoso",
            "Monolocale con accesso a giardino",
            "Casa con spazi per la meditazione",
            "Appartamento con vista sul parco",
            "Loft con arredi di design",
            "Casa con dettagli in legno naturale",
            "Appartamento con angolo cottura attrezzato",
            "Monolocale con decorazioni artistiche",
            "Casa con accesso a piscina condominiale",
            "Appartamento con vista sul giardino",
            "Loft con elementi industriali",
            "Casa con spazi verdi",
            "Appartamento con dettagli eleganti",
            "Monolocale con angolo lettura accogliente",
            "Casa con accesso a terrazza privata",
            "Appartamento con vista sulla skyline",
            "Loft con arredi moderni",
            "Casa con spazi per eventi",
            "Appartamento con dettagli unici",
            "Monolocale con decorazioni vintage",
            "Casa con accesso a giardino pensile",
            "Appartamento con vista sul mare",
            "Loft con spazi per la creatività",
            "Casa con dettagli in ferro battuto",
            "Appartamento con angolo cottura open space",
        ];
        return $faker->randomElement($titles);
    }
}
