<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Creación de usuario administrador
        User::create([
            'name' => 'admin',
            'email' => 'admin@uoc.edu',
            'password' => Hash::make('uoc2024tfg'),
            'rol' => 'administrador',
        ]);

        // Creación de usuario soporte
        User::create([
            'name' => 'soporte',
            'email' => 'soporte@uoc.edu',
            'password' => Hash::make('uoc2024tfg'),
            'rol' => 'soporte',
        ]);

        // Creación de usuario mantenimiento
        User::create([
            'name' => 'mantenimiento',
            'email' => 'mantenimiento@uoc.edu',
            'password' => Hash::make('uoc2024tfg'),
            'rol' => 'mantenimiento',
        ]);
    }
}