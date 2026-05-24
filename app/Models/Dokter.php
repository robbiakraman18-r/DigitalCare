<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Schedule;
use App\Models\RekamMedis;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $primaryKey = 'id_dokter';

    protected $fillable = [
        'nama',
        'no_sip',
        'email',
        'jenis_kelamin',
        'password',
        'foto_profil'
    ];

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'id_dokter');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'id_dokter');
    }
}