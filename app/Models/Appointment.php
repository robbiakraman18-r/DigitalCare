<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'id_janji';

    protected $fillable = [
        'id_janji',
        'id_pasien',
        'id_jadwal',
        'id_dokter',
        'tanggal_janji',
        'nomor_antrian',
        'status_janji',
        'keluhan_utama',
        'jam_konsultasi',
    ];
    
    protected $casts = [
        'tanggal_janji'  => 'date',
    ];

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'id_janji', 'id_janji');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }

    // alias — biar kompatibel dengan kode lama yang pakai jadwaldokter
    public function jadwaldokter()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }
}