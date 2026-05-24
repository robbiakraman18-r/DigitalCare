<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dokter;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_dokter',
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruang_kuota_harian',
        'status_jadwal'
    ];

    // INI YANG KAMU TANYA
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}