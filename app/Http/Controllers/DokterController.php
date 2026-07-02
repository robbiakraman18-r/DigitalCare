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
use App\Models\ClinicSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{

    public function dashboard()
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();

        $dari = Carbon::today('Asia/Jakarta')->subDays(29);
        $sampai = Carbon::today('Asia/Jakarta');

        $jadwalHariIni = JadwalDokter::where('id_dokter', $dokter->id_dokter)
            ->whereDate('tanggal', today())
            ->get();

        $todayAppointments = $dokter->appointments()
            ->whereDate('tanggal_janji', Carbon::today('Asia/Jakarta'))
            ->with('pasien.user')
            ->orderBy('nomor_antrian')
            ->get();

        // Semua stat berdasarkan 30 hari terakhir
        $dari   = Carbon::today('Asia/Jakarta')->subDays(29);
        $sampai = Carbon::today('Asia/Jakarta');

        $base = $dokter->appointments()
            ->whereBetween('tanggal_janji', [$dari, $sampai]);

        $totalPasien      = (clone $base)->distinct('id_pasien')->count('id_pasien');
        $totalAppointment = (clone $base)->count();
        $totalPending     = (clone $base)->where('status_janji', 'pending')->count();
        $totalCompleted   = (clone $base)->where('status_janji', 'completed')->count();
        $totalCalled      = (clone $base)->where('status_janji', 'called')->count();
        $totalInConsultation = (clone $base)->where('status_janji', 'in_consultation')->count();
        $totalCancelled   = (clone $base)->where('status_janji', 'cancelled')->count();
        $totalRekamMedis  = RekamMedis::where('id_dokter', $dokter->id_dokter)
            ->whereBetween('waktu_pemeriksaan', [$dari, $sampai])
            ->count();

        $todaySchedule = $dokter->appointments()
            ->whereDate('tanggal_janji', Carbon::today('Asia/Jakarta'))
            ->count();

        // Trend 30 hari
        $appointmentTrendLabels = [];
        $appointmentTrendData   = [];

        for ($i = 29; $i >= 0; $i--) {
            $tanggal = Carbon::today('Asia/Jakarta')->subDays($i);
            $appointmentTrendLabels[] = $tanggal->format('d M');
            $appointmentTrendData[]   = $dokter->appointments()
                ->whereDate('tanggal_janji', $tanggal)
                ->count();
        }

        $latestAppointments = Appointment::with('pasien.user')
            ->where('id_dokter', $dokter->id_dokter)
            ->latest()
            ->take(5)
            ->get();

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
            'totalCalled',
            'totalInConsultation',
            'totalCancelled',
            'latestAppointments',
            'appointmentTrendLabels',
            'appointmentTrendData'
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

        // Default ke hari ini kalau tidak ada filter
        $tanggal = request('tanggal', today()->format('Y-m-d'));

        $jadwal = JadwalDokter::where('id_dokter', $dokter->id_dokter)
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam_mulai')
            ->get();

        return view('dokter.jadwal-praktik', compact('jadwal', 'tanggal'));
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
        
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_janji', $request->tanggal);
            } else {
                $query->whereDate('tanggal_janji', '>=', today());
        }

        if ($request->search) {
            $query->whereHas('pasien.user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
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

        $appointments = $query
        ->orderByRaw("
        CASE
            WHEN status_janji = 'pending' THEN 1
            WHEN status_janji = 'called' THEN 2
            WHEN status_janji = 'in_consultation' THEN 3
            WHEN status_janji = 'completed' THEN 4
            WHEN status_janji = 'cancelled' THEN 5
            ELSE 6
            END
        ")
            ->orderBy('tanggal_janji')
            ->orderBy('nomor_antrian')
            ->get();
            return view('dokter.appointment', compact('appointments'));
        }

    public function panggilPasien($id)
    {
        $appointment = Appointment::with('jadwal')->findOrFail($id);

        if (!$this->appointmentSudahDimulai($appointment)) {
            return back()->with(
                'error',
                'Belum waktunya memanggil pasien.'
            );
        }

        $appointment->update([
            'status_janji' => 'called'
        ]);

        return back()->with('success','Pasien dipanggil');
    }

    public function startConsultation($id)
    {
        $appointment = Appointment::with('jadwal')->findOrFail($id);

        if (!$this->appointmentSudahDimulai($appointment)) {

            return back()->with(
                'error',
                'Belum waktunya memulai pemeriksaan.'
            );
        }

        $appointment->update([
            'status_janji'=>'in_consultation'
        ]);

        session([
            'active_patient'=>$appointment->id_janji
        ]);

        return redirect()
            ->route('dokter.diagnosis',$appointment->id_janji);
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

        $next = Appointment::with('jadwal')
            ->where('id_dokter', $dokter->id_dokter)
            ->where('status_janji', 'pending')
            ->whereDate('tanggal_janji', today())
            ->orderBy('nomor_antrian')
            ->first();

        if (!$next) {
            return back()->with('error', 'Tidak ada antrian.');
        }

        if (!$this->appointmentSudahDimulai($next)) {
            return back()->with(
                'error',
                'Belum ada pasien yang jadwalnya dimulai.'
            );
        }

        $next->update([
            'status_janji' => 'called'
        ]);

        return back()->with('success', 'Pasien dipanggil.');
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

        if ($appointment->status_janji != 'in_consultation') {
        return redirect()
            ->route('dokter.appointment')
            ->with(
                'error',
                'Pasien belum memasuki proses pemeriksaan.'
            );
    }
        return view('dokter.diagnosis', compact('appointment'));
    }

    public function simpanDiagnosis(Request $request, $id)
    {
        $request->validate([
            'keluhan'        => 'required|string',
            'diagnosa'       => 'required|string',
            'catatan_dokter' => 'nullable|string',
            'nama_obat'      => 'required|array|min:1',
            'nama_obat.*'    => 'required|string',
            'dosis.*'        => 'nullable|string',
            'jumlah.*'       => 'nullable|integer|min:1',
            'aturan_pakai.*' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($id);
    if ($appointment->status_janji != 'in_consultation') {

        return back()->with(
            'error',
            'Pasien belum diperiksa.'
        );
    }

        // Simpan Rekam Medis
        $rekamMedis = RekamMedis::create([
            'id_janji'          => $appointment->id_janji,
            'id_dokter'         => $appointment->id_dokter,
            'keluhan'           => $request->keluhan,
            'diagnosa'          => $request->diagnosa,
            'catatan_dokter'    => $request->catatan_dokter,
            'waktu_pemeriksaan' => now(),
        ]);

        // Simpan Detail Resep
        foreach ($request->nama_obat as $index => $obat) {
            if (empty($obat)) continue;

            DetailResep::create([
                'id_rekam_medis' => $rekamMedis->id_rekam_medis,
                'nama_obat'      => $obat,
                'dosis' => $request->dosis[$index] ?? 'tidak ada dosis',
                'jumlah' => $request->jumlah[$index] ?? 0,
                'aturan_pakai' => $request->aturan_pakai[$index] ?? 'tidak ada aturan',
            ]);
        }

        // Update status appointment
        $appointment->update([
            'status_janji' => 'completed'
        ]);

        session()->forget('active_patient');

        return redirect()
        ->route('dokter.appointment')
        ->with('success', 'Diagnosis berhasil disimpan');
    }
        
    /*
    |----------------------------------
    | REKAM MEDIS
    |----------------------------------
    */
    public function rekamMedis(Request $request)
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();
        $query = RekamMedis::with([
            'appointment.pasien.user',
            'dokter.user',
            'detailResep'
        ]);

        $query->whereHas('appointment', function ($q) use ($dokter) {
        $q->whereHas('pasien.appointments', function ($sub) use ($dokter) {
            $sub->where('id_dokter', $dokter->id_dokter);
            });
        });

        $filterPasien = null;

        // Filter berdasarkan pasien
        if ($request->filled('id_pasien')) {

            $filterPasien = Pasien::with('user')
                ->whereHas('appointments', function ($q) use ($dokter) {
                    $q->where('id_dokter', $dokter->id_dokter);
                })
                ->findOrFail($request->id_pasien);

            $query->whereHas('appointment', function ($q) use ($request) {
                $q->where('id_pasien', $request->id_pasien);
            });
        }

        // Cari diagnosis
        if ($request->filled('search')) {
            $query->where('diagnosa', 'like', '%' . $request->search . '%');
        }

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('waktu_pemeriksaan', $request->tanggal);
        }

        $rekamMedis = $query
            ->orderByDesc('waktu_pemeriksaan')
            ->paginate(10)
            ->withQueryString();

        return view('dokter.rekam-medis', compact(
            'rekamMedis',
            'filterPasien'
        ));
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
        $pasien = Pasien::with([
            'user',
            'appointments.jadwal',
            'appointments.rekammedis'
        ])->findOrFail($id);

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

    
    public function pemeriksaan($id_janji = null)
    {
        if (!$id_janji) {
            $id_janji = session('active_patient');
        }
        
        $appointment = null;
        if ($id_janji) {
            $appointment = Appointment::with([
                'pasien.user',
                'dokter.user',
                'jadwal'
            ])
        
            ->where('id_janji', $id_janji)
            ->where('status_janji', 'in_consultation')
            ->first();
            
            if (!$appointment) {
                session()->forget('active_patient');
            }
        }
            
        return view('dokter.pemeriksaan', compact('appointment'));
    }

    public function pasien(Request $request)
    {
        $dokter = Dokter::where('user_id', auth()->id())->firstOrFail();
        
        $query = Pasien::with([
            'user',
            'appointments.rekammedis'
        ])
            ->whereHas('appointments', function ($q) use ($dokter) {
                $q->where('id_dokter', $dokter->id_dokter);
            });

            if ($request->filled('search')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        $pasiens = $query->paginate(10);
    
        return view('dokter.pasien', compact('pasiens'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::find(auth()->id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        // 🔥 INI LETAKNYA
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    private function appointmentSudahDimulai(Appointment $appointment): bool
    {
        $waktuAppointment = Carbon::parse(
            $appointment->tanggal_janji->format('Y-m-d') . ' ' . $appointment->jadwal->jam_mulai
        );

        return now('Asia/Jakarta')->greaterThanOrEqualTo($waktuAppointment);
    }

    public function passwordPage()
    {
        return view('dokter.password');
    }

    public function clinicInfo()
    {
        $setting = ClinicSetting::instance();
        return view('dokter.info-klinik-dokter', compact('setting'));
    }
}