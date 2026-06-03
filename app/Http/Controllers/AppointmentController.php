<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Appointment;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    /**
     * Menampilkan halaman form buat janji temu.
     */
    public function create()
    {
        // Ambil data user login beserta data pasien
        $user = auth()->user()->load('pasien');

        // Mengambil data Dokter dengan relasi user dan jadwal yang valid
        $dokters = Dokter::with([
            'user',
            'jadwalDokter' => function ($query) {
                $query->where('status_jadwal', 'Available')
                      ->where('tanggal', '>=', now()->toDateString())
                      ->orderBy('tanggal', 'asc');
            }
        ])
        ->whereHas('jadwalDokter', function ($query) {
            $query->where('status_jadwal', 'Available')
                  ->where('tanggal', '>=', now()->toDateString());
        })
        ->get();

        return view('pasien.buat-janji', compact('dokters', 'user'));
    }

    /**
     * Menyimpan data janji temu baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal'     => 'required|exists:jadwal_dokters,id_jadwal',
            'tanggal_janji' => 'required|date|after_or_equal:today',
            'keluhan_utama' => 'required|string|min:5',
        ]);

        try {
            return DB::transaction(function () use ($request) {

                $jadwal = JadwalDokter::lockForUpdate()->find($request->id_jadwal);

                if ($jadwal->tanggal !== $request->tanggal_janji) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Tanggal yang Anda pilih tidak sesuai dengan jadwal praktik dokter.');
                }

                $pasien = auth()->user()->pasien;

                if (!$pasien) {
                    throw new \Exception('Profil data pasien Anda tidak ditemukan.');
                }

                $exists = Appointment::where('id_jadwal', $jadwal->id_jadwal)
                    ->where('id_pasien', $pasien->id_pasien)
                    ->exists();

                if ($exists) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Anda sudah melakukan booking pada jadwal dokter ini.');
                }

                if ($jadwal->terisi >= $jadwal->kuota_harian || $jadwal->status_jadwal === 'Full') {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Kuota dokter pada hari tersebut sudah penuh.');
                }

                $jadwal->increment('current_antrian');
                $nomorAntrian = $jadwal->current_antrian;
                $jadwal->terisi += 1;

                if ($jadwal->terisi >= $jadwal->kuota_harian) {
                    $jadwal->status_jadwal = 'Full';
                }

                $jadwal->save();

                Appointment::create([
                    'id_jadwal'     => $jadwal->id_jadwal,
                    'id_pasien'     => $pasien->id_pasien,
                    'id_dokter'     => $jadwal->id_dokter,
                    'tanggal_janji' => $jadwal->tanggal,
                    'nomor_antrian' => $nomorAntrian,
                    'status_janji'  => 'pending',
                    'keluhan_utama' => $request->keluhan_utama,
                ]);

                return redirect()->route('pasien.dashboard')
                    ->with('success', 'Janji temu berhasil dibuat! Nomor antrian Anda: #' . $nomorAntrian);
            });

        } catch (\Exception $e) {
            Log::error('Gagal membuat appointment: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}