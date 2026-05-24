<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RekamMedis;

class DetailResep extends Model
{
    protected $table = 'detail_reseps';

    protected $fillable = [
        'id_rekam_medis',
        'nama_obat',
        'dosis',
        'aturan_pakai'
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis');
    }
}