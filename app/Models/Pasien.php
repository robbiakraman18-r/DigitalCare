<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';
    protected $fillable = [
        'user_id',
        'no_rm',
        'nik',
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

    public function rekamMedis()
    {
        return $this->hasManyThrough(
            RekamMedis::class,
            Appointment::class,
            'id_pasien',
            'id_janji',
            'id_pasien',
            'id_janji'
        );
    }
}