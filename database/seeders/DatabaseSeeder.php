<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        
// Inserción de datos en la tabla servicios
        DB::table('servicios')->insert([
            [
                'id' => 16,
                'nombre' => '10 MG',
                'precio' => 10.00,
                'font_color' => NULL,
                'bg_color' => NULL,
                'created_at' => '2024-06-02 13:40:04',
                'updated_at' => '2024-06-02 13:40:04',
            ],
            [
                'id' => 17,
                'nombre' => '20 Mg',
                'precio' => 20.00,
                'font_color' => NULL,
                'bg_color' => NULL,
                'created_at' => '2024-06-02 13:40:12',
                'updated_at' => '2024-06-02 13:40:12',
            ],
        ]);

        // Inserción de datos en la tabla estados
        DB::table('estados')->insert([
            [
                'id' => 4,
                'nombre' => 'Facturable',
                'default' => 'no',
                'font_color' => '#4d4d4d',
                'bg_color' => '#35c918',
                'created_at' => '2024-06-02 13:40:33',
                'updated_at' => '2024-06-02 13:42:45',
            ],
            [
                'id' => 5,
                'nombre' => 'En pausa',
                'default' => 'no',
                'font_color' => '#171717',
                'bg_color' => '#f09414',
                'created_at' => '2024-06-02 13:42:28',
                'updated_at' => '2024-06-02 13:42:45',
            ],
            [
                'id' => 6,
                'nombre' => 'Solicitado',
                'default' => 'si',
                'font_color' => '#f2f2f2',
                'bg_color' => '#f31616',
                'created_at' => '2024-06-02 13:42:40',
                'updated_at' => '2024-06-02 13:42:45',
            ],
            [
                'id' => 7,
                'nombre' => 'Un esado',
                'default' => 'no',
                'font_color' => '#291e1e',
                'bg_color' => '#2a8341',
                'created_at' => '2024-06-03 15:05:23',
                'updated_at' => '2024-06-03 15:05:23',

            ],
        ]);

        // Inserción de datos en la tabla clientes
        DB::table('clientes')->insert([
            [
                'id' => 22,
                'nombre' => 'Vicen',
                'apellidos' => 'Font',
                'telefono' => 6555544,
                'movil' => 637844664,
                'dni' => '76866023V',
                'email' => 'vfont@uoc.edu',
                'direccion' => 'adsdf',
                'ciudad' => 'A Estrada',
                'provincia' => 'Lugo',
                'codigo_postal' => '36680',
                'created_at' => '2024-06-03 15:10:30',
                'updated_at' => '2024-06-03 15:12:48',
                'servicio_id' => 16,
                'estado_id' => 4,
                'disponibilidad' => 'Total',
            ],
            [
                'id' => 29,
                'nombre' => 'Javier',
                'apellidos' => 'Rramos',
                'telefono' => 637844664,
                'movil' => 637844664,
                'dni' => '76855902T',
                'email' => 'javier.aestrada@gmail.com',
                'direccion' => 'Zarabeto 11',
                'ciudad' => 'A Estrada',
                'provincia' => 'Pontevedra',
                'codigo_postal' => '36680',
                'created_at' => '2024-06-06 09:10:15',
                'updated_at' => '2024-06-06 09:10:19',
                'servicio_id' => 16,
                'estado_id' => 6,
                'disponibilidad' => 'ff',
            ],
        ]);

        // Inserción de datos adicionales en la tabla users
        DB::table('users')->insert([
            [
                'id' => 35,
                'name' => 'Vicen',
                'email' => 'vfont@uoc.edu',
                'email_verified_at' => NULL,
                'password' => '$2y$12$4/W10.5Hy0Ul5aJBku0WDuaPOcQ7MCyQDGf3sG5UKq2WrEHMXqkGe',
                'rol' => 'cliente',
                'remember_token' => NULL,
                'created_at' => '2024-06-03 15:10:31',
                'updated_at' => '2024-06-03 15:10:31',
            ],
            [
                'id' => 42,
                'name' => 'Javier',
                'email' => 'javier.aestrada@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$QfTShz2ol5qW3RoSC8UbWeDMjD.fcH/D2tAJvERNBgYwQpX57jipe',
                'rol' => 'cliente',
                'remember_token' => NULL,
                'created_at' => '2024-06-06 09:10:15',
                'updated_at' => '2024-06-06 09:11:08',
            ],
        ]);
    }
}
