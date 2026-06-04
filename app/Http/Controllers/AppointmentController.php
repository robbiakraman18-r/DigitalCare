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
    // =========================
    // FORM BUAT JANJI
    // =========================
    public function create()
    {
        $user = auth()->user()->load('pasien');

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

    // =========================
    // SIMPAN APPOINTMENT
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal'     => 'required|exists:jadwal_dokters,id_jadwal',
            'tanggal_janji' => 'required|date|after_or_equal:today',
            'keluhan_utama' => 'required|string|min:5',
        ]);

        try {
            DB::transaction(function () use ($request) {

                $jadwal = JadwalDokter::lockForUpdate()
                    ->findOrFail($request->id_jadwal);

                if ($jadwal->tanggal != $request->tanggal_janji) {
                    throw new \Exception('Tanggal tidak sesuai jadwal dokter.');
                }

                $pasien = auth()->user()->pasien;

                if (!$pasien) {
                    throw new \Exception('Data pasien tidak ditemukan.');
                }

                $exists = Appointment::where('id_jadwal', $jadwal->id_jadwal)
                    ->where('id_pasien', $pasien->id_pasien)
                    ->exists();

                if ($exists) {
                    throw new \Exception('Anda sudah booking jadwal ini.');
                }

                if ($jadwal->terisi >= $jadwal->kuota_harian) {
                    throw new \Exception('Kuota penuh.');
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
            });

            return redirect()->route('pasien.dashboard')
                ->with('success', 'Janji berhasil dibuat!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }

    // =========================
    // INI YANG KAMU KURANG (UI APPOINTMENT)
    // =========================
    public function index()
    {
        $user = auth()->user()->load('pasien');

        $pasien = $user->pasien;

        $appointments = Appointment::with(['dokter', 'jadwalDokter'])
            ->where('id_pasien', $pasien->id_pasien)
            ->latest()
            ->get();

        return view('pasien.appointment', compact('appointments', 'user'));
    }
}