<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Appointment;
use Carbon\Carbon;

class DokterController extends Controller
{

public function dashboard()
{
    $dokter = Dokter::where('user_id', auth()->id())->first();
    $jadwalHariIni = JadwalDokter::where('id_dokter', $dokter->id_dokter)
    ->whereDate('tanggal', today())
    ->get();

    if (!$dokter) {
        abort(403, 'Dokter belum terhubung dengan user ini');
    }

    // 🔥 FIX UTAMA DI SINI
    $todayAppointments = $dokter->appointments()
        ->whereDate('tanggal_janji', \Carbon\Carbon::today('Asia/Jakarta'))
        ->with('pasien')
        ->orderBy('nomor_antrian')
        ->get();

    $totalPasien = $dokter->appointments()
        ->distinct('id_pasien')
        ->count('id_pasien');

    $totalAppointment = $dokter->appointments()->count();

    $todaySchedule = $dokter->appointments()
        ->whereDate('tanggal_janji', \Carbon\Carbon::today('Asia/Jakarta'))
        ->count();

    $totalRekamMedis = \App\Models\RekamMedis::where('id_dokter', $dokter->id_dokter)->count();

    return view('dokter.dashboard', compact(
    'dokter',
    'todayAppointments',
    'jadwalHariIni',
    'totalPasien',
    'totalAppointment',
    'todaySchedule',
    'totalRekamMedis'
));
}

public function uploadPhoto(Request $request)
{
    $request->validate([
        'foto_profil' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $dokter = auth()->user()->dokter ?? null;

if (!$dokter) {
    abort(403, 'Data dokter tidak ditemukan');
}

    if ($request->hasFile('foto_profil')) {

        // hapus foto lama (optional)
        if ($dokter->foto_profil && file_exists(storage_path('app/public/' . $dokter->foto_profil))) {
            unlink(storage_path('app/public/' . $dokter->foto_profil));
        }

        // simpan foto baru
        $file = $request->file('foto_profil');
        $path = $file->store('dokter', 'public');

        $dokter->foto_profil = $path;
        $dokter->save();
    }

    return back()->with('success', 'Foto profil berhasil diupdate');
}
    /*
    |----------------------------------
    | JADWAL PRAKTIK
    |----------------------------------
    */
    public function jadwal()
{
     $dokter = Dokter::where('user_id', auth()->id())->first();
    if (!$dokter) {
        abort(403, 'Data dokter tidak ditemukan');
    }

    $tanggal = request('tanggal');

    $query = JadwalDokter::where('id_dokter', $dokter->id_dokter);

    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    }

    $jadwal = $query->orderBy('tanggal')->get();

    return view('dokter.jadwal-praktik', compact('jadwal'));
}

    /*
    |----------------------------------
    | APPOINTMENT / ANTRIAN HARI INI
    |----------------------------------
    */
  public function appointment(Request $request)
{
    $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

    $query = Appointment::with(['pasien.user', 'jadwal'])
        ->where('id_dokter', $dokter->id_dokter);

    // SEARCH (fix)
    if ($request->search) {
        $query->whereHas('pasien.user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER STATUS (optional)
    if ($request->status) {
        $query->where('status_janji', $request->status);
    }

    $appointments = $query->orderBy('nomor_antrian')->get();

    return view('dokter.appointment', compact('appointments'));
}

    //PANGGIL PASIEN
    public function panggilPasien($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'status_janji' => 'called'
    ]);

    return back()->with('success', 'Pasien dipanggil');
}


public function startConsultation($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'status_janji' => 'in_consultation'
    ]);

    return redirect()
        ->route('dokter.diagnosis', $appointment->id)
        ->with('success', 'Mulai pemeriksaan pasien');
}


    //SELESAI PERIKSA PASIEN
    public function selesaiPasien($id)
{
    $appointment = Appointment::findOrFail($id);

    $appointment->update([
        'status_janji' => 'completed'
    ]);

    return back()->with('success', 'Pemeriksaan selesai');
}

    //BATAL PASIEN
    public function cancelPasien(int $id)
    {
        $appointment = Appointment::findOrFail($id);
        
        $appointment->update([
            'status_janji' => 'cancelled'
            ]);
            
        return back()->with('success', 'Janji dibatalkan');
    }

    // PANGGIL PASIEN SELANJUTNYA
    public function nextPasien()
{
    $dokter = auth()->user()->dokter;

    $next = Appointment::with(['pasien', 'jadwal'])
        ->where('id_dokter', $dokter->id_dokter)
        ->where('status_janji', 'pending')
        ->whereDate('tanggal_janji', today())
        ->orderBy('nomor_antrian')
        ->first();

    if (!$next) {
        return back()->with('error', 'Tidak ada antrian');
    }

    $next->update([
        'status_janji' => 'called'
    ]);

    return back()->with('success', 'Pasien dipanggil');
}



    /*
    |----------------------------------
    | PASIEN
    |----------------------------------
    */
    public function pasien()
    {
        return view('dokter.pasien');
    }

    /*
    |----------------------------------
    | DIAGNOSIS
    |----------------------------------
    */
    public function diagnosis()
    {
        return view('dokter.diagnosis');
    }

    /*
    |----------------------------------
    | REKAM MEDIS
    |----------------------------------
    */
    public function rekamMedis()
    {
        return view('dokter.rekam-medis');
    }

    /*
    |----------------------------------
    | MEDICAL HISTORY
    |----------------------------------
    */
    public function medicalHistory()
    {
        return view('dokter.medical-history');
    }

    /*
    |----------------------------------
    | DETAIL PASIEN
    |----------------------------------
    */

public function detailPasien($id)
{
    $pasien = Pasien::where('id_pasien', $id)->firstOrFail();

    return view('dokter.detail-pasien', compact('pasien'));
}
    /*
    |----------------------------------
    | PROFILE DOKTER
    |----------------------------------
    */
    public function profile()
    {
        $dokter = Dokter::with('user')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $totalPasien = $dokter->appointments()
            ->distinct('id_pasien')
            ->count('id_pasien');

        $totalAppointment = $dokter->appointments()->count();

        $totalRekamMedis = $dokter->rekamMedis()->count();

        return view('dokter.profile', compact(
            'dokter',
            'totalPasien',
            'totalAppointment',
            'totalRekamMedis'
        ));
    }
}