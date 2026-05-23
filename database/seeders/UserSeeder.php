<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'nama' => 'Admin Klinik',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin'
        ]);

        // DOCTOR
        User::create([
            'nama' => 'dr. Andi',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'dokter'
        ]);

        // PATIENT
        User::create([
            'nama' => 'Budi',
            'email' => 'pasien@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pasien'
        ]);
    }
}