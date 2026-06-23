<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\JadwalDokter;
use Carbon\Carbon;

class BatalkanAppointmentKadaluarsa extends Command
{
    protected $signature   = 'appointment:batalkan-kadaluarsa';
    protected $description = 'Batalkan appointment yang sudah melewati jam selesai jadwal dokter';

    public function handle()
    {
        $now = Carbon::now();

        // Ambil semua appointment pending/called yang jadwalnya sudah lewat jam_selesai
        $appointments = Appointment::with('jadwaldokter')
            ->whereIn('status_janji', ['pending', 'called'])
            ->whereHas('jadwaldokter', function ($q) use ($now) {
                $q->where('tanggal', '<=', $now->toDateString())
                  ->where('jam_selesai', '<', $now->format('H:i:s'));
            })
            ->get();

        $total = $appointments->count();

        foreach ($appointments as $appointment) {
            $appointment->update(['status_janji' => 'cancelled']);
        }

        $this->info("Selesai: {$total} appointment dibatalkan.");
    }
}