<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin CampRent',
            'email' => 'admin@gmail.com', // Email untuk login admin
            'password' => Hash::make('passwordadmin123'), // Password untuk login admin (bisa kamu ganti)
            'nohp' => '081234567890',
            'role' => 'admin',
        ]);
    }
}
