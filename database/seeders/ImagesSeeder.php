<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment;
use App\Models\Image;
use Faker\Generator as Faker;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
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

        foreach (Apartment::all() as $apartment) {
            $apartmentId = $apartment->id;

            // create between 1 and 5 images for each apartment
            for ($i = 0; $i < rand(1, 5); $i++) {
                Image::create([
                    'image_path' => $faker->randomElement($apartmentImages),
                    'description' => $faker->sentence(),
                    'apartment_id' => $apartmentId,
                ]);
            }
        }
    }
}
