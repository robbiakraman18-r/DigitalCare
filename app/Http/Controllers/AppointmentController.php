<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Appointment;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // =========================
    // FORM BUAT JANJI
    // =========================
    public function create()
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if (!$user) {
            abort(403);
        }

        $user->load('pasien');

        $pasien = $user->pasien;

         if (!$pasien) {
              return redirect()->route('profile.edit')
                  ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
         }

        $dokters = Dokter::with([
            'user',
            'jadwalDokter' => function ($query) { 
                $today = Carbon::today()->toDateString();
                $nowTime = Carbon::now()->format('H:i:s');

                $query->where('status_jadwal', 'Available')
                    ->where(function ($q) use ($today, $nowTime) {

                        $q->where('tanggal', '>', $today)
                            ->orWhere(function ($sub) use ($today, $nowTime) {
                                $sub->where('tanggal', $today)
                                    ->where('jam_mulai', '>', $nowTime);
                            });

                    })
                    ->orderBy('tanggal')
                    ->orderBy('jam_mulai');
            }
        ])
        ->whereHas('jadwalDokter', function ($query) { 

            $today = Carbon::today()->toDateString();
            $nowTime = Carbon::now()->format('H:i:s');

            $query->where('status_jadwal', 'Available')
                ->where(function ($q) use ($today, $nowTime) {

                    $q->where('tanggal', '>', $today)
                        ->orWhere(function ($sub) use ($today, $nowTime) {
                            $sub->where('tanggal', $today)
                                ->where('jam_mulai', '>', $nowTime);
                        });

                });
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
            
        /** @var \App\Models\Appointment|null $appointment */
        $appointment = null;

        try {
            DB::transaction(function () use ($request, &$appointment) {

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

                $appointment = Appointment::create([
                    'id_jadwal'     => $jadwal->id_jadwal,
                    'id_pasien'     => $pasien->id_pasien,
                    'id_dokter'     => $jadwal->id_dokter,
                    'tanggal_janji' => $jadwal->tanggal,
                    'nomor_antrian' => $nomorAntrian,
                    'status_janji'  => 'pending',
                    'keluhan_utama' => $request->keluhan_utama,
                ]);
            });

            if (!$appointment) {
                return back()->with('error', 'Gagal membuat appointment.');
}
            return redirect()->route('nomor.antrian', $appointment->id_janji)
                ->with('success', 'Janji berhasil dibuat!');

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }

    // =========================
    // TAMPILKAN NOMOR ANTRIAN
    // =========================
    public function showQueue($id)
    {
        $appointment = Appointment::with(['dokter', 'jadwaldokter', 'rekammedis'])->findOrFail($id);

        return view('/pasien/nomor-antrian', compact('appointment'));
    }

    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $user->load('pasien');

        $pasien = $user->pasien;

        
        $appointments = Appointment::with(['dokter', 'jadwaldokter'])
            ->where('id_pasien', $pasien->id_pasien)
            ->latest()
            ->get();

        return view('pasien.buat-janji', compact('appointments', 'user'));
    }
}