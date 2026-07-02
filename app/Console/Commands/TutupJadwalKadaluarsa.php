<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalDokter;
use Carbon\Carbon;

class TutupJadwalKadaluarsa extends Command
{
    protected $signature = 'jadwal:tutup-kadaluarsa';
    protected $description = 'Menutup jadwal dokter yang sudah lewat jam praktiknya';

    public function handle()
{
    date_default_timezone_set('Asia/Jakarta');

    $now = \Carbon\Carbon::now();

    $jumlah = JadwalDokter::where('status_jadwal', '!=', 'Closed')
        ->get()
        ->filter(function ($jadwal) use ($now) {

            $selesai = \Carbon\Carbon::parse(
                $jadwal->tanggal.' '.$jadwal->jam_selesai
            );

            return $selesai->lte($now);
        })
        ->each(function ($jadwal) {
            $jadwal->update([
                'status_jadwal' => 'Closed'
            ]);
        })
        ->count();

    $this->info("$jumlah jadwal berhasil ditutup.");
}
}