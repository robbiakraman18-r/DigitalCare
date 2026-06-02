<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JadwalDokter;
use App\Models\RekamMedis;
use App\Models\Appointment;
use App\Models\Pasien;

class Dokter extends Model
{
    protected $table = 'dokters';
    protected $primaryKey = 'id_dokter';

    protected $fillable = [
        'user_id',
        'no_sip',
        'foto_profil',
        'status_ketersediaan',
        'gender'
    ];

    /*
    |----------------------------------
    | RELASI KE USER
    |----------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /*
    |----------------------------------
    | RELASI JADWAL
    |----------------------------------
    */
    public function jadwal()
    {
        return $this->hasMany(JadwalDokter::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI APPOINTMENT
    |----------------------------------
    */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI REKAM MEDIS
    |----------------------------------
    */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI PASIEN UNIK (MANY TO MANY VIA APPOINTMENT)
    |----------------------------------
    */
    public function pasien()
    {
        return $this->belongsToMany(
            Pasien::class,
            'appointments',
            'id_dokter',
            'id_pasien'
        )->distinct();
    }

    /*
    |----------------------------------
    | BUSINESS LOGIC (DASHBOARD READY)
    |----------------------------------
    */

    // Total pasien unik (pernah appointment)
    public function totalPasien()
    {
        return $this->appointments()
            ->distinct('id_pasien')
            ->count('id_pasien');
    }

    // Total appointment
    public function totalAppointment()
    {
        return $this->appointments()->count();
    }

    // Appointment hari ini
    public function appointmentHariIni()
    {
        return $this->appointments()
            ->whereDate('created_at', today());
    }

    // Total jadwal hari ini
    public function totalHariIni()
    {
        return $this->appointmentHariIni()->count();
    }

    // Latest appointment (dashboard card)
    public function latestAppointments($limit = 5)
    {
        return $this->appointments()
            ->latest()
            ->take($limit)
            ->get();
    }
}