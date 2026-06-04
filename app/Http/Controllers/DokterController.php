<?php

namespace App\Http\Controllers;

use App\Models\DetailResep;
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
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        $jadwalHariIni = JadwalDokter::where('id_dokter', $dokter->id_dokter)
            ->whereDate('tanggal', today())
            ->get();

        $latestAppointments = Appointment::with('pasien')
            ->where('id_dokter', $dokter->id_dokter)
            ->latest()
            ->take(5)
            ->get();

        $todayAppointments = $dokter->appointments()
            ->whereDate('tanggal_janji', Carbon::today('Asia/Jakarta'))
            ->with('pasien')
            ->orderBy('nomor_antrian')
            ->get();

        $totalPasien       = $dokter->appointments()->distinct('id_pasien')->count('id_pasien');
        $totalAppointment  = $dokter->appointments()->count();
        $totalPending      = $dokter->appointments()->where('status_janji', 'pending')->count();
        $totalCompleted    = $dokter->appointments()->where('status_janji', 'completed')->count();
        $todaySchedule     = $dokter->appointments()->whereDate('tanggal_janji', Carbon::today('Asia/Jakarta'))->count();
        $totalRekamMedis   = RekamMedis::where('id_dokter', $dokter->id_dokter)->count();

        return view('dokter.dashboard', compact(
            'dokter',
            'todayAppointments',
            'jadwalHariIni',
            'totalPasien',
            'totalAppointment',
            'todaySchedule',
            'totalRekamMedis',
            'totalPending',
            'totalCompleted',
            'latestAppointments'
        ));
    }

    /*
    |----------------------------------
    | JADWAL PRAKTIK
    |----------------------------------
    */
    public function jadwal()
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        $tanggal = request('tanggal');
        $query   = JadwalDokter::where('id_dokter', $dokter->id_dokter);

        if ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }

        $jadwal = $query->orderBy('tanggal')->get();

        return view('dokter.jadwal-praktik', compact('jadwal'));
    }

    /*
    |----------------------------------
    | APPOINTMENT
    |----------------------------------
    */
    public function appointment(Request $request)
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        $query = Appointment::with(['pasien.user', 'jadwal'])
            ->where('id_dokter', $dokter->id_dokter);

        if ($request->search) {
            $query->whereHas('pasien.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status_janji', $request->status);
        }

        if ($request->filter == 'today') {
            $query->whereDate('tanggal_janji', today());
        }

        if ($request->filter == 'tomorrow') {
            $query->whereDate('tanggal_janji', now()->addDay());
        }

        $appointments = $query->orderBy('nomor_antrian')->get();

        return view('dokter.appointment', compact('appointments'));
    }

    public function panggilPasien($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status_janji' => 'called']);

        return back()->with('success', 'Pasien dipanggil');
    }

    public function startConsultation($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status_janji' => 'in_consultation']);

        return redirect()
            ->route('dokter.diagnosis', $appointment->id_janji)
            ->with('success', 'Mulai pemeriksaan pasien');
    }

    public function selesaiPasien($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status_janji' => 'completed']);

        return back()->with('success', 'Pemeriksaan selesai');
    }

    public function cancelPasien(int $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status_janji' => 'cancelled']);

        return back()->with('success', 'Janji dibatalkan');
    }

    public function nextPasien()
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        $next = Appointment::where('id_dokter', $dokter->id_dokter)
            ->where('status_janji', 'pending')
            ->whereDate('tanggal_janji', today())
            ->orderBy('nomor_antrian')
            ->first();

        if (!$next) {
            return back()->with('error', 'Tidak ada antrian');
        }

        $next->update(['status_janji' => 'called']);

        return back()->with('success', 'Pasien dipanggil');
    }

    /*
    |----------------------------------
    | DIAGNOSIS
    |----------------------------------
    */
    public function diagnosis($id)
    {
        $appointment = Appointment::with([
            'pasien.user',
            'dokter.user',
            'jadwal'
        ])->findOrFail($id);

        return view('dokter.diagnosis', compact('appointment'));
    }

    // ✅ SATU method saja — storeDiagnosis dihapus, ini yang dipakai
    public function simpanDiagnosis(Request $request, $id)
    {
        $request->validate([
            'keluhan'        => 'required|string',
            'diagnosa'       => 'required|string',
            'catatan_dokter' => 'nullable|string',
            // ✅ Validasi resep: minimal 1 obat wajib diisi
            'nama_obat'      => 'required|array|min:1',
            'nama_obat.*'    => 'required|string',
            'dosis.*'        => 'nullable|string',
            'jumlah.*'       => 'nullable|integer|min:1',
            'aturan_pakai.*' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);

        // Simpan Rekam Medis
        $rekamMedis = RekamMedis::create([
            'id_janji'          => $appointment->id_janji,
            'id_pasien'         => $appointment->id_pasien,
            'id_dokter'         => $appointment->id_dokter,
            'keluhan'           => $request->keluhan,
            'diagnosa'          => $request->diagnosa,
            'catatan_dokter'    => $request->catatan_dokter,
            'waktu_pemeriksaan' => now(),
        ]);

        // ✅ Simpan Detail Resep
        foreach ($request->nama_obat as $index => $obat) {
            if (empty($obat)) continue;

            DetailResep::create([
                'id_rekam_medis' => $rekamMedis->id_rekam_medis,
                'nama_obat'      => $obat,
                'dosis'          => $request->dosis[$index] ?? null,
                'jumlah'         => $request->jumlah[$index] ?? null,
                'aturan_pakai'   => $request->aturan_pakai[$index] ?? null,
            ]);
        }

        // ✅ Update status appointment ke completed
        $appointment->update(['status_janji' => 'completed']);

        return redirect()
            ->route('dokter.rekammedis')
            ->with('success', 'Diagnosis berhasil disimpan');
    }

    public function storeDiagnosis(Request $request, $id)
{
    // 1. ambil appointment
    $appointment = Appointment::findOrFail($id);

    // 2. buat rekam medis
    $rekam = RekamMedis::create([
        'id_janji' => $appointment->id_janji,
        'id_dokter' => $appointment->id_dokter,
        'diagnosa' => $request->diagnosa,
        'keluhan' => $request->keluhan,
        'catatan_dokter' => $request->catatan_dokter,
        'waktu_pemeriksaan' => Carbon::now()
    ]);

    // 3. simpan resep (loop array)
    if ($request->nama_obat) {
        foreach ($request->nama_obat as $key => $obat) {
            DetailResep::create([
                'id_rekam_medis' => $rekam->id_rekam_medis,
                'nama_obat' => $obat,
                'dosis' => $request->dosis[$key] ?? null,
                'jumlah' => $request->jumlah[$key] ?? 1,
                'aturan_pakai' => $request->aturan_pakai[$key] ?? null,
            ]);
        }
    }

    // 4. update status appointment
    $appointment->update([
        'status_janji' => 'completed'
    ]);

    return redirect()->route('dokter.appointment')
    ->with('success', 'Diagnosis berhasil disimpan');
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

        $totalPasien      = $dokter->appointments()->distinct('id_pasien')->count('id_pasien');
        $totalAppointment = $dokter->appointments()->count();
        $totalRekamMedis  = $dokter->rekamMedis()->count();

        return view('dokter.profile', compact(
            'dokter',
            'totalPasien',
            'totalAppointment',
            'totalRekamMedis'
        ));
    }

    /*
    |----------------------------------
    | UPLOAD FOTO
    |----------------------------------
    */
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
            if ($dokter->foto_profil && file_exists(storage_path('app/public/' . $dokter->foto_profil))) {
                unlink(storage_path('app/public/' . $dokter->foto_profil));
            }

            $path = $request->file('foto_profil')->store('dokter', 'public');
            $dokter->foto_profil = $path;
            $dokter->save();
        }

        return back()->with('success', 'Foto profil berhasil diupdate');
    }
}