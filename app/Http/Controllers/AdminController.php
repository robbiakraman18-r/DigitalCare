<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Appointment;
use Carbon\Carbon;

class AdminController extends Controller
{
    // =========================================
    // STORE DOKTER
    // =========================================
    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_sip' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        Dokter::create([
            'user_id' => $user->id,
            'no_sip' => $request->no_sip,
            'status_ketersediaan' => 'Available',
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
    public function complaint()
    {
        return view('admin.complaint', [
            'complaints' => Complaint::latest()->get()
        ]);
    }

    // =========================================
    // UPDATE COMPLAINT (NO RESPONSE)
    // =========================================
    public function updateComplaint(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Complaint berhasil diupdate');
    }

    // =========================================
    // TOGGLE STATUS USER
    // =========================================
    public function toggleStatus(int $id)
    {
        $user = User::findOrFail($id);

        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'Status updated');
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
    public function appointment()
    {
        return view('admin.appointment', [
            'appointments' => Appointment::with(['pasien', 'dokter'])
                ->latest()
                ->get()
        ]);
    }

    // =========================================
    // STORE APPOINTMENT
    // =========================================
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'nama_dokter' => 'required',
            'tanggal_janji' => 'required',
            'keluhan_utama' => 'required',
        ]);

        Appointment::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tanggal_janji' => $request->tanggal_janji,
            'nomor_antrian' => rand(1, 999),
            'status_janji' => 'pending',
            'keluhan_utama' => $request->keluhan_utama,
        ]);

        return back()->with('success', 'Appointment successfully created!');
    }

    // =========================================
    // UPDATE STATUS APPOINTMENT
    // =========================================
    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'status_janji' => $request->status_janji
        ]);

        return back()->with('success', 'Status antrean berhasil diupdate');
    }

    // =========================================
    // DELETE APPOINTMENT
    // =========================================
    public function deleteAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return back()->with('success', 'Appointment successfully deleted!');
    }
}