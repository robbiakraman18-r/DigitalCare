<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\RekamMedis; 
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    /**
     * Menampilkan Dashboard Pasien
     */
    public function dashboard()
    {
        $user = Auth::user();
        $pasienId = $user->pasien->id_pasien;
        $janjiTerdekat = Appointment::with([
            'dokter.user',
            'jadwalDokter'
        ])
        ->where('id_pasien', $pasienId)
        ->whereDate('tanggal_janji', '>=', now())
        ->orderBy('tanggal_janji')
        ->first();

        $rekamMedis = RekamMedis::with(['resepObat', 'appointment.dokter']) 
            ->whereHas('appointment', function($query) use ($pasienId) {
                $query->where('id_pasien', $pasienId);
            })
            ->latest('waktu_pemeriksaan') 
            ->first();

        $resepObat = $rekamMedis ? $rekamMedis->resepObat : collect();

        $totalKunjungan = RekamMedis::whereHas('appointment', function($query) use ($pasienId) {
            $query->where('id_pasien', $pasienId);
        })->count();

        return view('pasien.dashboard', compact(
            'janjiTerdekat',
            'rekamMedis',
            'resepObat',
            'totalKunjungan'
        ));
    }

    /**
     * Menampilkan Form Buat Janji Temu (Aesthetic Form)
     */
    public function createAppointment()
    {
        $dokters = Dokter::all();

        return view('pasien.buat-janji', compact('dokters'));
    }

    /**
     * Menyimpan data Janji Temu yang di-submit dari front-end
     */
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'id_dokter'     => 'required|exists:dokters,id_dokter',
            'tanggal_janji' => 'required|date|after_or_equal:today',
            'keluhan_utama' => 'required|string|min:5',
        ]);

        $user = Auth::user();
        $pasienId = $user->pasien->id_pasien;

        $adaJanjiPending = Appointment::where('id_pasien', $pasienId)
            ->where('status_janji', 'pending')
            ->exists();

        if ($adaJanjiPending) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You already have a pending appointment request.');
        }

        try {
            DB::beginTransaction();

            $nomorAntrianTerakhir = Appointment::where('id_dokter', $request->id_dokter)
                ->where('tanggal_janji', $request->tanggal_janji)
                ->lockForUpdate()
                ->max('nomor_antrian');
            
            $nomorAntrianBaru = $nomorAntrianTerakhir ? $nomorAntrianTerakhir + 1 : 1;

            // Simpan data janji temu baru
            $appointment = new Appointment();
            $appointment->id_pasien     = $pasienId;
            $appointment->id_dokter     = $request->id_dokter;
            $appointment->id_jadwal     = 1;
            $appointment->tanggal_janji = $request->tanggal_janji;
            $appointment->nomor_antrian = $nomorAntrianBaru;
            $appointment->status_janji  = 'pending';
            $appointment->keluhan_utama = $request->keluhan_utama;
            $appointment->save();

            DB::commit();

            return redirect()->route('pasien.dashboard')->with('success', 'Appointment booked successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Mengembalikan error jika sistem gagal memproses antrian
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong while booking. Please try again.');
        }
    }
}