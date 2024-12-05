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
            "https://a0.muscache.com/im/pictures/9d84d692-4a63-4a8c-afa5-a8e451f17961.jpg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/1454805/pexels-photo-1454805.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://a0.muscache.com/im/pictures/miso/Hosting-43726531/original/1ed39041-f67d-4542-bbc2-12335ba9be06.jpeg?im_w=720&im_format=avif",
            "https://a0.muscache.com/im/ml/photo_enhancement/pictures/miso/Hosting-899937502735336071/original/ed346527-838d-4f2f-9140-f7d4e065ec9c.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/271800/pexels-photo-271800.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276727/pexels-photo-276727.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/7601277/pexels-photo-7601277.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/11262209/pexels-photo-11262209.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/5502249/pexels-photo-5502249.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://a0.muscache.com/im/pictures/miso/Hosting-669376957567633514/original/df6fb2df-f2cd-4502-8c6c-7af50949794c.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/261145/pexels-photo-261145.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276701/pexels-photo-276701.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/276665/pexels-photo-276665.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/27626181/pexels-photo-27626181/free-photo-of-sagoma-casa-architettura-lusso.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load",
            "https://images.pexels.com/photos/276691/pexels-photo-276691.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://a0.muscache.com/im/pictures/miso/Hosting-17955891/original/53678180-6105-4ee9-ac18-2055eb938422.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/5556179/pexels-photo-5556179.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://a0.muscache.com/im/pictures/b42b9cc1-8ba8-4533-831c-7d9a4ad97070.jpg?im_w=720&im_format=avif",
            "https://a0.muscache.com/im/ml/photo_enhancement/pictures/miso/Hosting-43726673/original/8d3375a3-f5af-4f38-b328-733e04b88b9d.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/2079237/pexels-photo-2079237.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1986105/pexels-photo-1986105.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://a0.muscache.com/im/pictures/miso/Hosting-882755229618149063/original/c03bcb9b-50a8-4d35-8605-d3777374dbf8.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg",
            "https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg",
            "https://images.pexels.com/photos/1643389/pexels-photo-1643389.jpeg",
            "https://images.pexels.com/photos/24245781/pexels-photo-24245781/free-photo-of-case-casa-cucina-in-legno.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/7515855/pexels-photo-7515855.png?auto=compress&cs=tinysrgb&w=600&lazy=load",
            "https://images.pexels.com/photos/261143/pexels-photo-261143.jpeg",
            "https://images.pexels.com/photos/5353878/pexels-photo-5353878.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/1986104/pexels-photo-1986104.jpeg",
            "https://images.pexels.com/photos/276693/pexels-photo-276693.jpeg",
            "https://a0.muscache.com/im/pictures/miso/Hosting-29230759/original/3ae30bfb-40c4-4f2d-9ae0-3593a6276746.jpeg?im_w=720&im_format=avif",
            "https://a0.muscache.com/im/pictures/airflow/Hosting-13797755/original/7ff14938-8eb8-4235-b9e1-1ab3bbaced13.jpg?im_w=720&im_format=avif",
            "https://a0.muscache.com/im/ml/photo_enhancement/pictures/miso/Hosting-899937502735336071/original/ed346527-838d-4f2f-9140-f7d4e065ec9c.jpeg?im_w=720&im_format=avif",
            "https://images.pexels.com/photos/6489127/pexels-photo-6489127.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1",
            "https://images.pexels.com/photos/2079238/pexels-photo-2079238.jpeg",
            "https://images.pexels.com/photos/276666/pexels-photo-276666.jpeg",
            "https://images.pexels.com/photos/276702/pexels-photo-276702.jpeg",
            "https://images.pexels.com/photos/1643383/pexels-photo-1643383.jpeg",
            "https://images.pexels.com/photos/276692/pexels-photo-276692.jpeg",
            "https://images.pexels.com/photos/261146/pexels-photo-261146.jpeg",
            "https://images.pexels.com/photos/276727/pexels-photo-276727.jpeg",
            "https://a0.muscache.com/im/ml/photo_enhancement/pictures/miso/Hosting-49964422/original/eb4cf7a0-a94f-4d15-a8e2-c875554a91be.jpeg?im_w=720&im_format=avif",
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
                'price' => $faker->randomFloat(2, 50, 200),
                'is_visible' => $faker->boolean,
            ];


            Apartment::create($apartment);
        }

    }

   /**
 * genera una latitudine casuale all'interno della Lombardia.
 */
function createLatitude(Faker $faker) {
        return $faker->randomFloat(6, 45.2, 46.5);
    }

    /**
     * genera una longitudine casuale all'interno della Lombardia.
     */
function createLongitude(Faker $faker) {
    return $faker->randomFloat(6, 8.5, 10.5);
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
