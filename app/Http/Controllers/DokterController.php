<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Appointment;
use App\Models\RekamMedis;

class DokterController extends Controller
{
    public function dashboard()
{
    return view('dokter.dashboard');
}
    public function jadwal()
{
    return view('dokter.jadwal-praktik');
}

public function appointment()
{
    return view('dokter.appointment');
}

public function pasien()
{
    return view('dokter.pasien');
}

public function diagnosis()
{
    return view('dokter.diagnosis');
}

public function rekamMedis()
{
    return view('dokter.rekam-medis');
}

public function medicalHistory()
{
    return view('dokter.medical-history');
}


public function detailPasien($id)
{
    return view('dokter.detail-pasien');
}
public function profile()
{
    
    
    
    $dokter = Dokter::with('user')
        ->where('user_id', auth()->id())
        ->first();

    if (!$dokter) {
        abort(404, 'Dokter tidak ditemukan');
    }

    $totalPasien = $dokter->appointments()
    ->distinct('id_pasien')
    ->count('id_pasien');

$totalAppointment = $dokter->appointments()->count();

$totalRekamMedis = $dokter->rekamMedis()->count();

    return view('dokter.profile', compact(
        'dokter',
        'totalPasien',
        'totalAppointment',
        'totalRekamMedis'
    ));
}

}