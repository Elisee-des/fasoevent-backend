<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = ['Koudougou', 'Ouagadougou', 'Ouahigouya', 'Bobo Djoulasso', 'Tenkodogo'];
        
        foreach ($cities as $city) {
            City::create([
                'id' => Str::uuid(),
                'name' => $city,
            ]);
        }
    }
}