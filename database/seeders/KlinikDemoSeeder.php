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

        // ==================================================
        // 2. DOKTER USER
        // ==================================================
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
                'no_sip' => 'SIP-' . rand(1000, 9999),
                'gender' => 'Male',
                'status_ketersediaan' => 'Available'
            ]
        );

        // ==================================================
        // 3. JADWAL (HARI INI + BESOK)
        // ==================================================
        $today = Carbon::now('Asia/Jakarta');
        $tomorrow = Carbon::now('Asia/Jakarta')->addDay();

        $jadwalHariIni = JadwalDokter::create([
            'id_dokter' => $dokter->id_dokter,
            'tanggal' => $today->toDateString(),
            'hari' => $today->format('l'),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'ruang' => 'Poli 1',
            'kuota_harian' => 20,
            'terisi' => 0,
            'current_antrian' => 0,
            'status_jadwal' => 'Available'
        ]);

        $jadwalBesok = JadwalDokter::create([
            'id_dokter' => $dokter->id_dokter,
            'tanggal' => $tomorrow->toDateString(),
            'hari' => $tomorrow->format('l'),
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'ruang' => 'Poli 2',
            'kuota_harian' => 20,
            'terisi' => 0,
            'current_antrian' => 0,
            'status_jadwal' => 'Available'
        ]);

        // ==================================================
        // 4. PASIEN + APPOINTMENT (10 DATA)
        // ==================================================
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
                    'no_rm' => 'RM-' . rand(1000, 9999),
                    'birth_date' => '2000-01-01',
                    'gender' => 'Male',
                    'address' => 'Batam',
                    'phone_number' => '08123456789'
                ]
            );

            $jadwalDipakai = $i <= 5 ? $jadwalHariIni : $jadwalBesok;

            Appointment::create([
                'id_jadwal' => $jadwalDipakai->id_jadwal,
                'id_pasien' => $pasien->id_pasien,
                'id_dokter' => $dokter->id_dokter,
                'tanggal_janji' => $jadwalDipakai->tanggal,
                'nomor_antrian' => $i,
                'status_janji' => 'pending',
                'keluhan_utama' => "Demam / batuk pasien ke-$i"
            ]);
        }
    }
}