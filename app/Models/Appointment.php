<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'appointments';

    /*
    |--------------------------------------------------------------------------
    | PRIMARY KEY
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'id_appointment';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'keluhan',
        'nomor_antrian',
        'status_appointment'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // appointment belongs to patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pasien');
    }

    // appointment belongs to doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_dokter');
    }
}