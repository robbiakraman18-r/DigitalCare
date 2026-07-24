<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\RekamMedis; 
use App\Models\Dokter;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;
use App\Models\ClinicSetting;
use App\Models\Complaint;
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
        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $janjiTerdekat = Appointment::with([
            'dokter.user',
            'jadwal'
        ])
        ->where('id_pasien', $pasienId)
        ->whereIn('status_janji', ['pending', 'called', 'in_consultation'])
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

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }


    // =========================================
    // COMPLAINT (PASIEN)
    // =========================================

    /**
     * List komplain milik pasien yang sedang login.
     */
    public function complaint()
    {
        $complaints = Complaint::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pasien.complaint', compact('complaints'));
    }

    /**
     * Pasien mengirim komplain baru -> otomatis status 'pending'.
     */
    public function storeComplaint(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Complaint::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'status'  => 'pending',
        ]);

        return back()->with('success', 'Komplain berhasil dikirim, mohon tunggu tanggapan admin.');
    }

    /**
     * Pasien konfirmasi puas dengan tanggapan admin -> status jadi 'closed'.
     * Hanya bisa dilakukan kalau status saat ini 'resolved', dan hanya
     * untuk komplain miliknya sendiri.
     */
    public function confirmComplaint($id)
    {
        $complaint = Complaint::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($complaint->status !== 'resolved') {
            return back()->with('error', 'Komplain hanya bisa dikonfirmasi setelah admin memberi tanggapan (status Resolved).');
        }

        $complaint->update([
            'status'       => 'closed',
            'confirmed_at' => now(),
        ]);

        return back()->with('success', 'Terima kasih atas konfirmasinya!');
    }
}