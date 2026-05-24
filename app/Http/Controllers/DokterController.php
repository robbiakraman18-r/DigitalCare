<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Appointment;
use App\Models\RekamMedis;

class DokterController extends Controller
{
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

    return view('dokter.profil', compact(
        'dokter',
        'totalPasien',
        'totalAppointment',
        'totalRekamMedis'
    ));
}
}