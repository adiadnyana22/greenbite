<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mitra::create([
            'name' => 'Dunkin Donuts Edutown',
            'Address' => 'MJXR+JGM, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339',
            'latitude' => -6.3009109,
            'longitude' => 106.6412832,
            'logo' => 'Dunkin.png',
            'status' => 1,
        ]);

        Mitra::create([
            'name' => 'J.CO DONUTS & COFFEE Foresta',
            'Address' => 'MJXR+JGM, Pagedangan, Kec. Pagedangan, Kabupaten Tangerang, Banten 15339',
            'latitude' => -6.2952846,
            'longitude' => 106.6406,
            'logo' => 'Jco.png',
            'status' => 1,
        ]);

        Mitra::create([
            'name' => 'Pasar Modern Intermoda BSD City',
            'Address' => 'Jl. Raya Serpong - Cisauk, Sampora, Kec. Cisauk, Kabupaten Tangerang, Banten 15345',
            'latitude' => -6.3201773,
            'longitude' => 106.6433267,
            'logo' => 'Dunkin2.png',
            'status' => 1,
        ]);
    }
}
