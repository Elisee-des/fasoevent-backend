<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ajoute un utilisateur admin
        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone' => '1234567890',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Ajoute un utilisateur standard
        User::create([
            'id' => Str::uuid(),
            'name' => 'Cesar User',
            'email' => 'cesar@gmail.com',
            'phone' => '0987654321',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}