<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            ['evento' => 'Evento 1'],
            ['evento' => 'Evento 2'],
            ['evento' => 'Evento 3'],
        ];
    }
}
