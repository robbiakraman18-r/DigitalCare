<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';

    // Kolom bahasa Inggris wajib terdaftar agar sinkron dengan database migration
    protected $fillable = [
        'user_id',
        'no_rm',
        'birth_date',
        'gender',
        'address',
        'phone_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'id_pasien');
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'id_pasien');
    }
}