<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalDokter;

class TutupJadwalKadaluarsa extends Command
{
    protected $signature = 'jadwal:tutup-kadaluarsa';
    protected $description = 'Menutup jadwal dokter yang sudah lewat jam praktiknya';

    public function handle()
    {
        JadwalDokter::tutupJadwalKadaluarsa();
        $this->info('Jadwal kadaluarsa berhasil ditutup.');
    }
}