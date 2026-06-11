<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;

class DashboardController extends Controller
{

public function index($role)
{
    $jadwal = JadwalDokter::all(); // atau query kamu

    if ($role == 'dokter') {
        return view('dokter.dashboard', compact('jadwal'));
    }

    if ($role == 'admin') {
        return view('admin.dashboard', compact('jadwal'));
    }

    return view('dashboard', compact('jadwal'));
    
}
}
