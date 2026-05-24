<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Schedule;
use App\Models\RekamMedis;
use App\Models\Appointment;

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
    | RELASI KE SCHEDULE
    |----------------------------------
    */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI KE APPOINTMENT
    |----------------------------------
    */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI KE REKAM MEDIS
    |----------------------------------
    */
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_dokter', 'id_dokter');
    }
}