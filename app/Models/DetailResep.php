<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    protected $table = 'detail_resep';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_rekam_medis',
        'nama_obat',
        'dosis',
        'jumlah',
        'aturan_pakai'
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis');
    }
}