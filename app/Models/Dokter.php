<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JadwalDokter;
use App\Models\RekamMedis;
use App\Models\Appointment;
use App\Models\Pasien;

class Dokter extends Model
{
    use HasFactory;

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
    |--------------------------------------------------------------------------
    | RELASI KE USER
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE JADWAL DOKTER
    |--------------------------------------------------------------------------
    | Dipanggil di AppointmentController::create() via eager loading bertingkat
    */
    public function jadwalDokter()
    {
        return $this->hasMany(JadwalDokter::class, 'id_dokter', 'id_dokter');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI APPOINTMENT
    |--------------------------------------------------------------------------
    */
    public function appointments()
    {
        return $this->hasManyThrough(
            Appointment::class,
            JadwalDokter::class,
            'id_dokter', // FK di jadwal_dokters, nunjuk ke dokters
            'id_jadwal', // FK di appointments, nunjuk ke jadwal_dokters
            'id_dokter', // local key di dokters
            'id_jadwal'  // local key di jadwal_dokters
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI REKAM MEDIS
    |--------------------------------------------------------------------------
    */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_dokter', 'id_dokter');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI PASIEN UNIK (MANY TO MANY VIA APPOINTMENT)
    |--------------------------------------------------------------------------
    */
    public function pasien()
    {
        return Pasien::whereIn('id_pasien', function ($q) {
            $q->select('id_pasien')
            ->from('appointments')
            ->whereIn('id_jadwal', function ($sub) {
                $sub->select('id_jadwal')
                    ->from('jadwal_dokters')
                    ->where('id_dokter', $this->id_dokter);
            });
        });
    }

    /*
    |--------------------------------------------------------------------------
    | BUSINESS LOGIC (DASHBOARD READY)
    |--------------------------------------------------------------------------
    */
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
        ->whereDate('tanggal_janji', today());
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