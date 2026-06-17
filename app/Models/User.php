<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pasien;

/**
 * @property-read \App\Models\Pasien|null $pasien
 * @property-read \App\Models\Dokter|null $dokter
 */
class User extends Authenticatable implements MustVerifyEmail 
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama', 'email', 'password', 'role', 'department', 'status', 'hari_praktik', 'jam_mulai', 'jam_selesai'
    ];

public function pasien()
{
    return $this->hasOne(Pasien::class, 'user_id'); 
}

    public function dokter() {
        return $this->hasOne(Dokter::class, 'user_id');
    }

    public function setStatusAttribute($value)
    {
        if ($this->role === 'admin') {
            $this->attributes['status'] = 'active';
            return;
        }

        $this->attributes['status'] = $value;
    }
}