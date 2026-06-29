<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\RekamMedis; 
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use App\Models\ClinicSetting;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Menampilkan Dashboard Pasien
     */
    public function dashboard()
    {
        $user = Auth::user();
        $pasienId = $user->pasien->id_pasien;
        $now = \Carbon\Carbon::parse('2026-06-29 17:00:00');

        $janjiTerdekat = Appointment::with([
            'dokter.user',
            'jadwal'
        ])
        ->where('id_pasien', $pasienId)
        ->whereIn('status_janji', ['pending', 'waiting', 'called'])
        ->where(function ($query) use ($now) {

            // Appointment setelah hari ini
            $query->whereDate('tanggal_janji', '>', $now->toDateString())

                // Appointment hari ini tetapi jam selesai belum lewat
                ->orWhere(function ($q) use ($now) {

                    $q->whereDate('tanggal_janji', $now->toDateString())
                        ->whereHas('jadwal', function ($jadwal) use ($now) {

                            $jadwal->where('jam_selesai', '>', $now->format('H:i:s'));

                        });

                });

        })
        ->orderBy('tanggal_janji')
        ->first();

        $rekamMedis = RekamMedis::with(['detailResep', 'appointment.dokter']) 
            ->whereHas('appointment', function($query) use ($pasienId) {
                $query->where('id_pasien', $pasienId);
            })
            ->latest('waktu_pemeriksaan') 
            ->first();

        $detailResep = $rekamMedis ? $rekamMedis->detailResep : collect();

        $totalKunjungan = RekamMedis::whereHas('appointment', function($query) use ($pasienId) {
            $query->where('id_pasien', $pasienId);
        })->count();

        return view('pasien.dashboard', compact(
            'janjiTerdekat',
            'rekamMedis',
            'detailResep',
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
            $appointment->id_jadwal     = $request->id_jadwal;
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
    public function clinicInfo()
    {
        $setting = ClinicSetting::instance();
        return view('pasien.info-klinik', compact('setting'));
    }


        /**
     * List Rekam Medis Pasien
     */
    public function listRekamMedis()
    {
        $user     = Auth::user();
        $pasienId = $user->pasien->id_pasien;

        $rekamMedisList = RekamMedis::with(['detailResep', 'appointment.jadwal'])
            ->whereHas('appointment', function ($q) use ($pasienId) {
                $q->where('id_pasien', $pasienId);
            })
            ->orderByDesc('waktu_pemeriksaan')
            ->get();

        return view('pasien.listrekam-medis', compact('rekamMedisList'));
    }

    /**
     * Detail Rekam Medis
     */
    
    public function detailRekamMedis($id)
    {
        $user     = Auth::user();
        $pasienId = $user->pasien->id_pasien;

        $rekamMedis = RekamMedis::with([
            'dokter.user',
            'detailResep',
            'appointment.jadwal'
        ])
        ->whereHas('appointment', function ($q) use ($pasienId) {
            $q->where('id_pasien', $pasienId);
        })
        ->findOrFail($id);

        if (request('download') == 1) {
            $setting  = ClinicSetting::instance();
            $pasien   = $user->pasien;

            $pdf = Pdf::loadView('pasien.pdf-rekam-medis', compact(
                'rekamMedis',
                'setting',
                'pasien'
            ))->setPaper('a4', 'portrait');

            $filename = 'RekamMedis-' 
                . str_replace(' ', '_', $user->nama) . '-'
                . \Carbon\Carbon::parse($rekamMedis->waktu_pemeriksaan)->format('d-m-Y') 
                . '.pdf';

            return $pdf->download($filename);
        }

        return view('pasien.detail-rekam-medis', compact('rekamMedis'));
    }

    /**
     * Halaman Bantuan
     */
    public function help()
    {
        return view('pasien.help');
    }

    public function showChangePasswordForm()
    {
        return view('pasien.change-password');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}