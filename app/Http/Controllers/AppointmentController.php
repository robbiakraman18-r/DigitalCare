<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Appointment;
use App\Models\Dokter;
use App\Models\Notifikasi;
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

        // Kalau data pasien belum ada
        if (!$pasien) {
            return redirect()->route('profile.edit')
                ->with('error', 'Silakan lengkapi profil Anda terlebih dahulu.');
        }

        // Kalau data pasien ada tapi belum lengkap
        if (!$pasien->isProfileComplete()) {
            return redirect()->route('profile.edit')
                ->with('warning', 'Lengkapi profil terlebih dahulu sebelum membuat appointment.');
        }

        // Cek apakah pasien sudah punya janji aktif
        $janjiAktif = Appointment::where('id_pasien', $pasien->id_pasien)
            ->whereIn('status_janji', ['pending', 'called', 'in_consultation'])
            ->first();

        if ($janjiAktif) {
            return redirect()->route('pasien.on-going')
                ->with('info', 'Kamu masih memiliki janji temu yang aktif.');
        }

        $dokters = Dokter::with([
            'user',
            'jadwalDokter' => function ($query) {
                $today   = Carbon::today()->toDateString();
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
            $today   = Carbon::today()->toDateString();
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
            'keluhan_utama' => 'required|string|min:5|max:1000',
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

                // Cek apakah profil pasien sudah lengkap
                if (!$pasien->isProfileComplete()) {
                    throw new \Exception('Lengkapi profil terlebih dahulu sebelum membuat appointment.');
                }

                // Cek sudah punya janji aktif
                $janjiAktif = Appointment::where('id_pasien', $pasien->id_pasien)
                    ->whereIn('status_janji', ['pending', 'called', 'in_consultation'])
                    ->exists();

                if ($janjiAktif) {
                    throw new \Exception('Kamu masih memiliki janji temu yang aktif.');
                }

                // Cek sudah booking jadwal ini
                $exists = Appointment::where('id_jadwal', $jadwal->id_jadwal)
                    ->where('id_pasien', $pasien->id_pasien)
                    ->exists();

                if ($exists) {
                    throw new \Exception('Anda sudah booking jadwal ini.');
                }

                if ($jadwal->terisi >= $jadwal->kuota_harian) {
                    throw new \Exception('Kuota penuh.');
                }

                // Nomor antrian & jam konsultasi otomatis
                $jadwal->current_antrian++;
                $nomorAntrian = $jadwal->current_antrian;

                // Interval 30 menit per pasien dari jam_mulai
                $jamKonsultasi = Carbon::parse($jadwal->jam_mulai)
                    ->addMinutes(($nomorAntrian - 1) * 30)
                    ->format('H:i');

                $jadwal->terisi += 1;

                if ($jadwal->terisi >= $jadwal->kuota_harian) {
                    $jadwal->status_jadwal = 'Full';
                }

                $jadwal->save();

                $appointment = Appointment::create([
                    'id_jadwal'      => $jadwal->id_jadwal,
                    'id_pasien'      => $pasien->id_pasien,
                    'id_dokter'      => $jadwal->id_dokter,
                    'tanggal_janji'  => $jadwal->tanggal,
                    'nomor_antrian'  => $nomorAntrian,
                    'jam_konsultasi' => $jamKonsultasi,
                    'status_janji'   => 'pending',
                    'keluhan_utama'  => $request->keluhan_utama,
                ]);
                
                Notifikasi::create([
                    'dokter_id' => $jadwal->id_dokter,
                    'tipe'      => 'appointment',
                    'judul'     => 'Appointment Baru',
                    'pesan'     => 'Pasien membuat janji konsultasi tanggal '
                                    . Carbon::parse($jadwal->tanggal)->format('d M Y')
                                    . ' pukul ' . $jamKonsultasi,
                    'link'      => route('dokter.appointment'),
                    'is_read'   => false,
                ]);

                Notifikasi::create([
                    'dokter_id' => null,
                    'tipe'      => 'appointment',
                    'judul'     => 'Appointment Baru',
                    'pesan'     => 'Pasien booking konsultasi tanggal '
                                    . Carbon::parse($jadwal->tanggal)->format('d M Y')
                                    . ' pukul ' . $jamKonsultasi,
                    'link'      => route('admin.appointment'),
                    'is_read'   => false,
                ]);

                Notifikasi::create([
                    'pasien_id' => $pasien->id_pasien,
                    'tipe'      => 'appointment',
                    'judul'     => 'Appointment Berhasil Dibuat',
                    'pesan'     => 'Janji konsultasi berhasil dibuat pada '
                                    . Carbon::parse($jadwal->tanggal)->format('d M Y')
                                    . ' pukul ' . $jamKonsultasi,
                    'link'      => route('pasien.on-going'),
                    'is_read'   => false,
                ]);
            });

            if (!$appointment) {
                return back()->with('error', 'Gagal membuat appointment.');
            }

            return redirect()->route('nomor.antrian', $appointment->id_janji)
                ->with('success', 'Janji berhasil dibuat!');

        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return back()->with('error', $e->getMessage());
        }
    }

    // =========================
    // TAMPILKAN NOMOR ANTRIAN
    // =========================
    public function showQueue($id)
    {
        $user   = auth()->user();
        $pasien = $user->pasien;

        $appointment = Appointment::with(['dokter.user', 'jadwaldokter'])
            ->where('id_janji', $id)
            ->where('id_pasien', $pasien->id_pasien)
            ->firstOrFail();

        return view('pasien.nomor-antrian', compact('appointment'));
    }

    // =========================
    // ON GOING — STATUS AKTIF
    // =========================
    public function onGoing()
    {
        $user   = auth()->user();
        $pasien = $user->pasien;

        $appointment = Appointment::with(['dokter.user', 'jadwaldokter'])
            ->where('id_pasien', $pasien->id_pasien)
            ->whereIn('status_janji', ['pending', 'called', 'in_consultation'])
            ->latest()
            ->first();

        // Tidak ada yang aktif → redirect ke buat janji
        if (!$appointment) {
            return redirect()->route('pasien.buat-janji')
                ->with('info', 'Kamu belum memiliki janji temu aktif.');
        }

        // Cek lewat jam_selesai jadwal
        if ($appointment) {
            $jadwal = $appointment->jadwaldokter;
            $jamSelesai = Carbon::parse($appointment->tanggal_janji->format('Y-m-d') . ' ' . $jadwal->jam_selesai);

            if (Carbon::now()->greaterThan($jamSelesai)) {
                $appointment->update(['status_janji' => 'cancelled']);
                return redirect()->route('pasien.buat-janji')
                    ->with('info', 'Janji temu kamu sudah melewati jam praktik dan otomatis dibatalkan.');
            }
        }

        return view('pasien.on-going', compact('appointment'));
    }

    // =========================
    // INDEX (LIST SEMUA JANJI PASIEN)
    // =========================
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $user->load('pasien');
        $pasien = $user->pasien;

        $appointments = Appointment::with(['dokter.user', 'jadwaldokter'])
            ->where('id_pasien', $pasien->id_pasien)
            ->latest()
            ->get();

        return view('pasien.janji-temu', compact('appointments', 'user'));
    }
}