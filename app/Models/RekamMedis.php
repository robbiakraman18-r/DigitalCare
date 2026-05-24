<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $primaryKey = 'id_rekam_medis';

    protected $fillable = [
        'id_dokter',
        'diagnosa',
        'keluhan',
        'catatan_dokter',
        'waktu_pemeriksaan'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function detailResep()
    {
        return $this->hasOne(DetailResep::class, 'id_rekam_medis');
    }
}