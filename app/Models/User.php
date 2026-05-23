<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function dokter()
    {
        return $this->hasOne(Dokter::class);
    }

    public function pasien()
    {
        return $this->hasOne(Pasien::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE CHECK
    |--------------------------------------------------------------------------
    */

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isDokter()
    {
        return $this->role == 'dokter';
    }

    public function isPasien()
    {
        return $this->role == 'pasien';
    }
}