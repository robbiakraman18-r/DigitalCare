<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Complaint;

class AdminController extends Controller
{
    // ADMIN DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // DOCTOR SCHEDULE PAGE
    public function schedule()
    {
        $schedules = Schedule::latest()->get();

        return view('admin.doctor_schedule', compact('schedules'));
    }

    // SAVE DOCTOR SCHEDULE
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

    // COMPLAINT PAGE
    public function complaint()
    {
        $complaints = Complaint::latest()->get();

        return view('admin.complaint', compact('complaints'));
    }
}