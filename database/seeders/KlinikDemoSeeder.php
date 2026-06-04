<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Appointment;
use App\Models\RekamMedis;
use App\Models\DetailResep;
use Carbon\Carbon;

class KlinikDemoSeeder extends Seeder
{
    public function run(): void
    {
        // ==================================================
        // 1. ADMIN
        // ==================================================
        $admin = User::updateOrCreate(
            ['email' => 'admin@clinic.com'],
            [
                'nama' => 'Admin Klinik',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ]
        );

        
        // =========================
        // USER DOKTER
        // =========================
        $dokterUser = User::updateOrCreate(
            ['email' => 'dokter@test.com'],
            [
                'nama' => 'Dr Test',
                'password' => bcrypt('123456'),
                'role' => 'dokter'
            ]
        );

        $dokter = Dokter::updateOrCreate(
            ['user_id' => $dokterUser->id],
            [
                'no_sip' => 'SIP-' . rand(1000,9999),
                'gender' => 'Male',
                'status_ketersediaan' => 'Available'
            ]
        );

        // =========================
        // JADWAL
        // =========================
        $jadwal = JadwalDokter::create([
            'id_dokter' => $dokter->id_dokter,
            'tanggal' => Carbon::today(),
            'hari' => Carbon::now()->format('l'),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'ruang' => 'Poli 1',
            'kuota_harian' => 20,
            'terisi' => 0,
            'current_antrian' => 0,
            'status_jadwal' => 'Available'
        ]);

        // =========================
        // MULTI PASIEN + APPOINTMENT
        // =========================
        for ($i = 1; $i <= 10; $i++) {

            $user = User::updateOrCreate(
                ['email' => "pasien$i@test.com"],
                [
                    'nama' => "Pasien $i",
                    'password' => bcrypt('123456'),
                    'role' => 'pasien'
                ]
            );

            $pasien = Pasien::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'no_rm' => 'RM-' . rand(1000,9999),
                    'birth_date' => '2000-01-01',
                    'gender' => 'Male',
                    'address' => 'Batam',
                    'phone_number' => '08123456789'
                ]
            );

            $appointment = Appointment::create([
                'id_jadwal' => $jadwal->id_jadwal,
                'id_pasien' => $pasien->id_pasien,
                'id_dokter' => $dokter->id_dokter,
                'tanggal_janji' => Carbon::today(),
                'nomor_antrian' => $i,
                'status_janji' => 'pending',
                'keluhan_utama' => "Demam / batuk pasien ke-$i"
            ]);
        }
    }
}