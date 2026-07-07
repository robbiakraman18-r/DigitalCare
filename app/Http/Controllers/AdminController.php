<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Notifikasi;
use App\Models\Appointment;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function profile()
    {
        return view('admin.profile');
    }
    // =========================================
    // STORE DOKTER
    // =========================================
    public function storeDokter(Request $request)
    {
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_sip' => 'required|string|max:255',
            'gender' => 'required',
            'status_ketersediaan' => 'required',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        $foto = null;

        if ($request->hasFile('foto_profil')) {
            $foto = $request->file('foto_profil')->store('dokter', 'public');
        }

        Dokter::create([
            'user_id' => $user->id,
            'no_sip' => $request->no_sip,
            'gender' => $request->gender,
            'status_ketersediaan' => $request->status_ketersediaan,
            'foto_profil' => $foto,
        ]);
        
        Notifikasi::create([
            'dokter_id' => null,
            'tipe'      => 'dokter',
            'judul'     => 'Dokter Baru Ditambahkan',
            'pesan'     => 'Dr. ' . $user->nama . ' berhasil ditambahkan ke sistem.',
            'link'      => route('admin.dashboard'), // ganti kalau ada halaman detail dokter
            'is_read'   => false,
        ]);

        return redirect()->back()
            ->with('success', 'Doctor berhasil ditambahkan');
    }

    // =========================================
    // DASHBOARD
    // =========================================

    public function dashboard()
    {
        $totalDokter = Dokter::count();

        $totalPasien = Pasien::count();

        $totalAppointment = Appointment::count();

        $dokterAktif = Dokter::where('status_ketersediaan', 'Available')->count();

        $pasienHariIni = Appointment::whereDate(
            'tanggal_janji',
            Carbon::today()
        )->count();

        $appointmentPending = Appointment::where(
            'status_janji',
            'pending'
        )->count();

        $appointmentsToday = Appointment::with([
            'pasien.user',
            'dokter.user'
        ])
        ->whereDate('tanggal_janji', Carbon::today())
        ->latest()
        ->take(5)
        ->get();

        $dokters = Dokter::with('user')
            ->where('status_ketersediaan', 'Available')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'totalDokter',
            'totalPasien',
            'totalAppointment',
            'dokterAktif',
            'pasienHariIni',
            'appointmentPending',
            'appointmentsToday',
            'dokters'
        ));
    }

    // =========================================
    // USER MANAGEMENT
    // =========================================
    public function userManagement(Request $request)
    {
        $query = User::with('dokter');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('role', 'like', "%{$request->search}%");
            });
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return view('admin.user-management', [
            'users' => $query->latest()->get()
        ]);
    }

    // =========================================
    // UPDATE USER
    // =========================================
    public function updateUser(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user->update($request->only('nama', 'email', 'role'));

        if ($user->role == 'dokter') {
            $dokter = Dokter::where('user_id', $user->id)->first();

            $dokter->update([
                'hari_praktik' => $request->hari_praktik,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'no_sip' => $request->no_sip,
                'status_ketersediaan' => $request->status_ketersediaan,
            ]);
        }

        return back()->with('success', 'User updated successfully');
    }

    // =========================================
    // DELETE USER
    // =========================================
    public function deleteUser(int $id)
    {
        $user = User::findOrFail($id);

        Dokter::where('user_id', $user->id)->delete();
        Pasien::where('user_id', $user->id)->delete();

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    // =========================================
    // COMPLAINT
    // =========================================

    /**
     * List semua komplain, bisa difilter by status lewat ?status=pending dst.
     * Sudah eager-load 'user' supaya nama pengirim (pasien/dokter) tampil tanpa N+1.
     */
    public function complaint(Request $request)
    {
        $query = Complaint::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $complaints = $query->get();

        $countPending    = Complaint::where('status', 'pending')->count();
        $countInProgress = Complaint::where('status', 'in_progress')->count();
        $countResolved   = Complaint::where('status', 'resolved')->count();
        $countClosed     = Complaint::where('status', 'closed')->count();

        return view('admin.complaint', compact(
            'complaints',
            'countPending',
            'countInProgress',
            'countResolved',
            'countClosed'
        ));
    }

    /**
     * Admin menangani komplain: bisa set ke 'in_progress' (baru mulai ditangani)
     * atau 'resolved' (sudah dikasih tanggapan/solusi).
     * Admin TIDAK bisa langsung set 'closed' -> itu wewenang pasien/dokter
     * lewat endpoint confirmComplaint (konfirmasi puas).
     */
    public function updateComplaint(Request $request, $id)
    {
        $request->validate([
            'status'   => 'required|in:in_progress,resolved',
            'response' => 'nullable|string|max:2000',
        ]);

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status === 'closed') {
            return back()->with('error', 'Komplain ini sudah closed dan tidak bisa diubah lagi.');
        }

        $complaint->update([
            'status'   => $request->status,
            'response' => $request->filled('response') ? $request->response : $complaint->response,
        ]);

        // Kirim notifikasi ke pengirim komplain (pasien atau dokter)
        $pasien = Pasien::where('user_id', $complaint->user_id)->first();
        $dokter = Dokter::where('user_id', $complaint->user_id)->first();

        Notifikasi::create([
            'pasien_id' => $pasien->id_pasien ?? null,
            'dokter_id' => $dokter->id_dokter ?? null,
            'tipe'      => 'complaint',
            'judul'     => 'Update Komplain Anda',
            'pesan'     => 'Status komplain Anda diperbarui menjadi "' . $complaint->status_label . '".',
            'link'      => '#',
            'is_read'   => false,
        ]);

        return back()->with('success', 'Complaint berhasil diupdate');
    }

    // =========================================
    // TOGGLE STATUS USER
    // =========================================
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak bisa dinonaktifkan.');
        }

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'Status user berhasil diubah.');
    }

    // =========================================
    // UPDATE JADWAL DOKTER
    // =========================================
    public function updateJadwalDokter(Request $request, int $id)
    {
        $dokter = Dokter::where('user_id', $id)->firstOrFail();

        $dokter->update($request->only(
            'hari_praktik',
            'jam_mulai',
            'jam_selesai'
        ));

        return back()->with('success', 'Jadwal praktik dokter berhasil diperbarui');
    }

    // =========================================
    // APPOINTMENT LIST
    // =========================================
    public function appointment(Request $request)
    {
        // Default selalu hari ini kalau tidak ada filter tanggal
        $tanggal = $request->filled('tanggal') ? $request->tanggal : today()->format('Y-m-d');

        $query = Appointment::with(['pasien.user', 'dokter.user', 'jadwal'])
            ->whereDate('tanggal_janji', $tanggal);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pasien.user', function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('dokter.user', function ($sub) use ($search) {
                    $sub->where('nama', 'like', "%{$search}%");
                })
                ->orWhere('nomor_antrian', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status_janji', $request->status);
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
            ->orderBy('nomor_antrian')
            ->get();

        $total        = $appointments->count();
        $pending      = $appointments->where('status_janji', 'pending')->count();
        $called       = $appointments->where('status_janji', 'called')->count();
        $consultation = $appointments->where('status_janji', 'in_consultation')->count();
        $completed    = $appointments->where('status_janji', 'completed')->count();
        $cancelled    = $appointments->where('status_janji', 'cancelled')->count();

        return view('admin.appointment', compact(
            'appointments',
            'tanggal',
            'total',
            'pending',
            'called',
            'consultation',
            'completed',
            'cancelled'
        ));
    }

    // =========================================
    // STORE APPOINTMENT
    // =========================================
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'id_pasien'=>'required',
            'id_jadwal'=>'required',
            'keluhan_utama'=>'required',
        ]);

        $nomorAntrian = Appointment::where('id_dokter', $request->id_dokter)
    ->whereDate('tanggal_janji', $request->tanggal_janji)
    ->max('nomor_antrian');

$nomorAntrian = ($nomorAntrian ?? 0) + 1;

        Appointment::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tanggal_janji' => $request->tanggal_janji,
            'nomor_antrian' => $nomorAntrian,
            'status_janji' => 'pending',
            'keluhan_utama' => $request->keluhan_utama,
        ]);

        return back()->with('success', 'Appointment successfully created!');
    }

    // =========================================
    // UPDATE STATUS APPOINTMENT (CANCEL ONLY)
    // =========================================
    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::with('jadwal')->findOrFail($id);

        // Status final tidak bisa diubah lagi
        if (in_array($appointment->status_janji, ['completed', 'cancelled'])) {
            return back()->with('error', 'Appointment yang sudah ' . $appointment->status_janji . ' tidak bisa diubah.');
        }

        // Admin hanya boleh membatalkan, bukan bebas pindah status
        if ($request->status_janji !== 'cancelled') {
            return back()->with('error', 'Admin hanya bisa membatalkan appointment yang masih aktif.');
        }

        if ($appointment->jadwal) {
            $appointment->jadwal->decrement('terisi');
            if ($appointment->jadwal->status_jadwal === 'Full') {
                $appointment->jadwal->update(['status_jadwal' => 'Available']);
            }
        }

        $appointment->update(['status_janji' => 'cancelled']);
        
        Notifikasi::create([
            'pasien_id' => $appointment->id_pasien,
            'tipe'      => 'appointment',
            'judul'     => 'Appointment Dibatalkan',
            'pesan'     => 'Janji konsultasi Anda telah dibatalkan oleh admin.',
            'link'      => route('pasien.janji-temu'),
            'is_read'   => false,
        ]);

        return back()->with('success', 'Appointment berhasil dibatalkan');
    }

    // =========================================
    // DELETE APPOINTMENT
    // =========================================
    public function deleteAppointment($id)
    {
        $appointment = Appointment::with('jadwal')->findOrFail($id);

        // Appointment yang sudah completed punya rekam medis terkait,
        // jangan sampai riwayat medis pasien nyangkut tanpa induknya
        if ($appointment->status_janji === 'completed') {
            return back()->with('error', 'Appointment yang sudah selesai diperiksa tidak bisa dihapus karena punya rekam medis terkait.');
        }

        // Kalau appointment masih aktif (belum cancelled) pas dihapus,
        // kuota jadwal ikut dibalikin biar tetap konsisten
        if ($appointment->jadwal && $appointment->status_janji !== 'cancelled') {
            $appointment->jadwal->decrement('terisi');
            if ($appointment->jadwal->status_jadwal === 'Full') {
                $appointment->jadwal->update(['status_jadwal' => 'Available']);
            }
        }

        $appointment->delete();

        return back()->with('success', 'Appointment successfully deleted!');
    }
}