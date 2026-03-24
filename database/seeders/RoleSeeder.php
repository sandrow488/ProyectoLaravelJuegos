<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::insert([
            ['name' => 'admin',   'label' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'player',  'label' => 'Jugador', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Crear Juegos de prueba para el Catálogo
        $admin = \App\Models\User::where('name', 'Admin')->first();
        if($admin) {
            \App\Models\Game::create([
                'title' => 'Runner Galactic 3D',
                'description' => 'Esquiva obstáculos en este frenético runner espacial.',
                'published' => true,
                'url' => '/games/Runner3D/dist/index.html',
                'user_id' => $admin->id
            ]);
            \App\Models\Game::create([
                'title' => 'Planet Escape',
                'description' => 'Logra salir del planeta antes de que colapse.',
                'published' => true,
                'url' => '/games/Runner3D/dist/index.html',
                'user_id' => $admin->id
            ]);
        }
    }
}
