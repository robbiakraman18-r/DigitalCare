<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Complaint;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // DOCTOR SCHEDULE PAGE
    public function schedule()
    {
        $schedules = Schedule::all();
        return view('admin.doctor_schedule', compact('schedules'));
    }

    // ADD SCHEDULE
    public function storeSchedule(Request $request)
    {
        Schedule::create($request->all());
        return redirect()->back();
    }

    // COMPLAINT PAGE
    public function complaint()
    {
        $complaints = Complaint::all();
        return view('admin.complaint', compact('complaints'));
    }
}