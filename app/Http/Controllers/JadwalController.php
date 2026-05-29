<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;

class JadwalController extends Controller
{
    public function jadwal()
{
    $jadwal = JadwalDokter::orderBy('tanggal', 'asc')->get();

    return view('dokter.jadwal-praktik', compact('jadwal'));
}
}