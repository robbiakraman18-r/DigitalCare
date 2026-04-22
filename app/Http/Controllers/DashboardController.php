<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($role)
{
    if ($role == 'admin') {
        return view('admin.dashboard');
    }

    if ($role == 'dokter') {
        return view('dokter.dashboard');
    }

    return view('dashboard'); // pasien
}
}
