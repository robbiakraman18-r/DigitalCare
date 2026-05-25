<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokter';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_dokter',
        'tanggal',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruang',
        'kuota_harian',
        'terisi',
        'status_jadwal'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}