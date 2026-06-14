<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\RekamMedis;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $primaryKey = 'id_janji';

    protected $fillable = [
        'id_jadwal',
        'id_pasien',
        'id_dokter',
        'tanggal_janji',
        'nomor_antrian',
        'status_janji',
        'keluhan_utama'
    ];

    /*
    |----------------------------------
    | RELASI PASIEN
    |----------------------------------
    */

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'id_janji', 'id_janji');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    /*
    |----------------------------------
    | RELASI DOKTER
    |----------------------------------
    */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    /*
    |----------------------------------
    | RELASI JADWAL
    |----------------------------------
    */
    
    public function jadwal()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }
    
    public function jadwaldokter()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }

    
}