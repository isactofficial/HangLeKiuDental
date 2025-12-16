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
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hanglekiu.com',
            'password' => Hash::make('password123'),
        ]);

        // Doctor user
        User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dokter@hanglekiu.com',
            'password' => Hash::make('password123'),
        ]);

        // Staff user
        User::create([
            'name' => 'Staff Klinik',
            'email' => 'staff@hanglekiu.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
