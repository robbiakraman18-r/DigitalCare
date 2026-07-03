<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $fillable = ['dokter_id', 'pasien_id', 'tipe', 'judul', 'pesan', 'link', 'is_read'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }
}