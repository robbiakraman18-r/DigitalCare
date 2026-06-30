<?php

namespace App\Http\Controllers;

use App\Models\ClinicSetting;
use App\Models\Dokter;

class WelcomeController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')
            ->where('status_ketersediaan', 'Available')
            ->latest()
            ->take(4)
            ->get();

        $clinic = ClinicSetting::first();

        return view('welcome', compact('dokters', 'clinic'));
    }
}