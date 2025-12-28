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
        // Admin user (idempotent)
        User::firstOrCreate([
            'email' => 'admin@hanglekiu.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Doctor user (idempotent)
        User::firstOrCreate([
            'email' => 'dokter@hanglekiu.com',
        ], [
            'name' => 'Dr. John Doe',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        // Staff user (idempotent)
        User::firstOrCreate([
            'email' => 'staff@hanglekiu.com',
        ], [
            'name' => 'Staff Klinik',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);
    }
}
