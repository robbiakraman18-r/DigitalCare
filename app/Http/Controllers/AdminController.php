<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Schedule;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Appointment;

class AdminController extends Controller
{
    // STORE DOKTER (SUDAH FIX LOGIN + DOKTER)
    public function storeDokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_sip' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 1. BUAT USER LOGIN
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        // 2. BUAT DATA DOKTER
        Dokter::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'no_sip' => $request->no_sip,
            'status_ketersediaan' => 'Available',
        ]);

        return redirect()->back()->with('success', 'Dokter & akun login berhasil dibuat');
    }

    // ADMIN DASHBOARD
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

    // DOCTOR SCHEDULE
    public function schedule()
    {
        $schedules = Schedule::latest()->get();
        return view('admin.doctor_schedule', compact('schedules'));
    }

    public function storeSchedule(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'day' => 'required|string|max:50',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::create([
            'doctor_name' => $request->doctor_name,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Schedule added successfully');
    }

    // COMPLAINT
    public function complaint()
    {
        $complaints = Complaint::latest()->get();
        return view('admin.complaint', compact('complaints'));
    }
}