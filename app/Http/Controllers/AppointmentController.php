<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function store(Request $request)
{
    $jadwal = JadwalDokter::find($request->id_jadwal);

    if ($jadwal->terisi >= $jadwal->kuota_harian) {
        return back()->with('error', 'Kuota dokter sudah penuh');
    }

    // tambah jumlah terisi
    $jadwal->terisi += 1;

    if ($jadwal->terisi >= $jadwal->kuota_harian) {
        $jadwal->status_jadwal = 'Full';
    }

    $jadwal->save();

    // buat appointment
    Appointment::create([
        'id_pasien' => auth()->user()->id,
        'id_dokter' => $jadwal->id_dokter,
        'tanggal_kunjungan' => $jadwal->tanggal,
        'jam_kunjungan' => $jadwal->jam_mulai,
        'keluhan' => $request->keluhan,
        'status_appointment' => 'pending'
    ]);

    return redirect()->back()->with('success', 'Booking berhasil');
}
}
