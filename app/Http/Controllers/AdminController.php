<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Appointment;

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

        // BUAT USER LOGIN
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
            'status' => 'active',
        ]);

        // BUAT DATA DOKTER
        Dokter::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'no_sip' => $request->no_sip,
            'status_ketersediaan' => 'Available',
        ]);

        return redirect()->back()
            ->with('success', 'Dokter & akun login berhasil dibuat');
    }

    // =========================================
    // ADMIN DASHBOARD
    // =========================================
    public function dashboard()
    {
        $totalDokter = Dokter::count();
        $totalPasien = Pasien::count();
        $totalAppointment = Appointment::count();

        $dokterAktif = Dokter::where('status_ketersediaan', 'Available')->count();

        $appointmentsToday = Appointment::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalDokter',
            'totalPasien',
            'totalAppointment',
            'dokterAktif',
            'appointmentsToday'
        ));
    }

    // =========================================
    // USER MANAGEMENT + SEARCH
    // =========================================

public function userManagement(Request $request)
{
    $query = User::query();

    // SEARCH
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%')
              ->orWhere('role', 'like', '%' . $request->search . '%');
        });
    }

    // FILTER ROLE
    if ($request->role) {
        $query->where('role', $request->role);
    }

    // FILTER STATUS (INI YANG KAMU ERROR TADI)
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $users = $query->latest()->get();

    return view('admin.user-management', compact('users'));
}


    // =========================================
    // UPDATE USER
    // =========================================
    public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'status' => 'required',
    ]);

    $user->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'status' => $request->status,
    ]);

    return redirect()->back()
        ->with('success', 'User updated');
}

    // =========================================
    // DELETE USER
    // =========================================
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()
            ->with('success', 'User deleted successfully');
    }

    // =========================================
    // COMPLAINT
    // =========================================
    public function complaint()
    {
        $complaints = Complaint::latest()->get();

        return view('admin.complaint', compact('complaints'));
    }


    public function toggleStatus($id)
{
    $user = User::findOrFail($id);

    $user->status = $user->status === 'active' ? 'inactive' : 'active';
    $user->save();

    return back()->with('success', 'Status updated');
}

}
