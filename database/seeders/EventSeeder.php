<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run()
    {
        $city = City::first(); // Prend la première ville disponible

        // Événement 1
        Event::create([
            'id' => Str::uuid(),
            'title' => 'Festival de musique',
            'description' => 'Un festival annuel de musique traditionnelle et moderne',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(12),
            'city_id' => $city->id,
            'price' => 5000,
            'image' => 'festival.jpg',
            'is_active' => true,
        ]);

        // Événement 2
        Event::create([
            'id' => Str::uuid(),
            'title' => 'Conférence sur le numérique',
            'description' => 'Conférence annuelle sur les innovations technologiques',
            'start_date' => now()->addDays(20),
            'end_date' => now()->addDays(21),
            'city_id' => $city->id,
            'price' => 3000,
            'image' => 'conference.jpg',
            'is_active' => true,
        ]);
    }
}