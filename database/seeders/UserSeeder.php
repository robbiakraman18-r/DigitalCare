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
        $admin = User::create([
            'nama' => 'Admin Klinik',
            'email' => 'mariajesika12345@gmail.com',
            'password' => Hash::make('00000000'),
            'role' => 'admin'
        ]);

        $dokter = User::create([
            'nama' => 'dr. Robbi Akraman',
            'email' => 'robbiakraman18@gmail.com',
            'password' => Hash::make('Pass000000'),
            'role' => 'dokter'
        ]);

        $pasien = User::create([
            'nama' => 'Budi',
            'email' => 'pasien@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pasien'
        ]);
    }
}