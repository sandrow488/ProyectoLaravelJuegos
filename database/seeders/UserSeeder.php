<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name'     => 'Admin',
            'email'    => 'admin@plataforma.com',
            'password' => bcrypt('password'),
            'role_id'  => \App\Models\Role::where('name', 'admin')->first()->id,
        ]);
    }
}
