<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class JadwalDokter extends Model
{
    use HasFactory;
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
        'current_antrian',
        'status_jadwal'
    ];

    /**
     * Relasi ke model Dokter (Many-to-One)
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_jadwal', 'id_jadwal');
    }

    public function updateStatus()
    {
        if (now()->toDateString() > $this->tanggal) {
            $this->status_jadwal = 'Closed';
        } elseif ($this->terisi >= $this->kuota_harian) {
            $this->status_jadwal = 'Full';
        } else {
            $this->status_jadwal = 'Available';
        }

        $this->save();
    }

    public static function tutupJadwalKadaluarsa()
    {
        static::where('status_jadwal', '!=', 'Closed')
            ->whereRaw("TIMESTAMP(tanggal, jam_selesai) < ?", [now()])
            ->update(['status_jadwal' => 'Closed']);
    }
}