<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;
use App\Models\DetailResep;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'diagnosis',
        'tindakan'
    ];

    // ke dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    // ke detail resep
    public function detailResep()
    {
        return $this->hasMany(DetailResep::class, 'id_rekam_medis');
    }
}