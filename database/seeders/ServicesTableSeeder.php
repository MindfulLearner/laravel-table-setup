<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'WiFi'],
            ['name' => 'Parcheggio'],
            ['name' => 'Piscina'],
            ['name' => 'Aria Condizionata'],
            ['name' => 'Cucina'],
            ['name' => 'Lavatrice'],
            ['name' => 'TV'],
            ['name' => 'Riscaldamento'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
