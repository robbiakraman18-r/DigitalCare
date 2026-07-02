<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;

class JadwalController extends Controller
{
    public function jadwal()
{
    JadwalDokter::tutupJadwalKadaluarsa();
    $dokter = auth()->user()->dokter;

    $jadwal = JadwalDokter::where('id_dokter', $dokter->id_dokter)
        ->orderBy('tanggal', 'asc')
        ->get();

    return view('dokter.jadwal-praktik', compact('jadwal'));
}
}