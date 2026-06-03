<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;
use App\Models\DetailResep;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_medis';

    protected $fillable = [
        'id_janji',
        'id_dokter',
        'diagnosa',
        'keluhan',
        'catatan_dokter',
        'waktu_pemeriksaan'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'id_janji', 'id_janji');
    }

    public function detailResep()
    {
        return $this->hasMany(DetailResep::class, 'id_rekam_medis');
    }
    
}
