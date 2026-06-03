<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    use HasFactory;

    // Disesuaikan dengan nama tabel yang ada di phpMyAdmin Anda (menggunakan akhiran 's')
    protected $table = 'jadwal_dokters'; 
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
        'current_antrian', // Menambahkan kolom ini karena ada di database dan di-increment di Controller
        'status_jadwal'
    ];

    /**
     * Relasi ke model Dokter (Many-to-One)
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}