<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{

public function store(Request $request)
{
    return DB::transaction(function () use ($request) {

        $jadwal = JadwalDokter::lockForUpdate()
            ->findOrFail($request->id_jadwal);

        $pasien = auth()->user()->pasien;

        if (!$pasien) {
            throw new \Exception('Data pasien tidak ditemukan');
        }

        // cek double booking
        $exists = Appointment::where('id_jadwal', $jadwal->id_jadwal)
            ->where('id_pasien', $pasien->id_pasien)
            ->exists();

        if ($exists) {
            throw new \Exception('Anda sudah booking jadwal ini');
        }

        if ($jadwal->terisi >= $jadwal->kuota_harian) {
            throw new \Exception('Kuota dokter sudah penuh');
        }

        $jadwal->increment('current_antrian');
        $nomorAntrian = $jadwal->current_antrian;


        $jadwal->terisi += 1;

        if ($jadwal->terisi >= $jadwal->kuota_harian) {
            $jadwal->status_jadwal = 'Full';
        }

        $jadwal->save();

        return Appointment::create([
            'id_jadwal' => $jadwal->id_jadwal,
            'id_pasien' => $pasien->id_pasien,
            'id_dokter' => $jadwal->id_dokter,
            'tanggal_janji' => $jadwal->tanggal,
            'nomor_antrian' => $nomorAntrian,
            'status_janji' => 'pending',
            'keluhan_utama' => $request->keluhan_utama,
        ]);
    });
}}
