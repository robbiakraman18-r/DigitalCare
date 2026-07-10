<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_medis';

    protected $fillable = [
        'id_janji',
        'id_dokter',
        'id_pasien',
        'status',
        'diagnosa',
        'keluhan',
        'catatan_dokter',
        'waktu_pemeriksaan'
    ];

    public function dokter()
    {
        return $this->belongsTo(
            Dokter::class,
            'id_dokter',
            'id_dokter'
        );
    }

    public function pasien()
    {
        return $this->belongsTo(
            Pasien::class,
            'id_pasien',
            'id_pasien'
        );
    }
    
    public function appointment()
    {
        return $this->belongsTo(
            Appointment::class,
            'id_janji',
            'id_janji'
        );
    }

    public function detailResep()
    {
        return $this->hasMany(
            DetailResep::class,
            'id_rekam_medis',
            'id_rekam_medis'
        );
    }
}