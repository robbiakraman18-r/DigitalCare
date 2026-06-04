<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================
        $admin = User::updateOrCreate(
            ['email' => 'mariajesika12345@gmail.com'],
            [
                'nama' => 'Admin Klinik',
                'password' => Hash::make('00000000'),
                'role' => 'admin'
            ]
        );

        // =========================
        // DOKTER USER
        // =========================
        $dokterUser = User::updateOrCreate(
            ['email' => 'robbiakraman18@gmail.com'],
            [
                'nama' => 'dr. Robbi Akraman',
                'password' => Hash::make('Pass000000'),
                'role' => 'dokter'
            ]
        );

        // =========================
        // DOKTER DETAIL
        // =========================
        $dokter = Dokter::updateOrCreate(
            ['user_id' => $dokterUser->id],
            [
                'no_sip' => 'SIP-001',
                'status_ketersediaan' => 'Available',
                'gender' => 'Male'
            ]
        );

        // =========================
        // PASIEN USER
        // =========================
        $pasienUser = User::updateOrCreate(
            ['email' => 'pasien@gmail.com'],
            [
                'nama' => 'Carolina',
                'password' => Hash::make('12345678'),
                'role' => 'pasien'
            ]
        );

        // =========================
        // PASIEN DETAIL (INI YANG KAMU KURANG)
        // =========================
        Pasien::updateOrCreate(
            ['user_id' => $pasienUser->id],
            [
                'no_rm' => 'RM-0001',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'Female',
                'alamat' => 'Batam',
                'no_hp' => '08123456789'
            ]
        );
    }
}