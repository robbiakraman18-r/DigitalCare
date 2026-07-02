<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use Carbon\Carbon;

class BatalkanAppointmentKadaluarsa extends Command
{
    protected $signature   = 'appointment:batalkan-kadaluarsa';
    protected $description = 'Batalkan appointment (pending/called) yang sudah melewati jam selesai jadwal dokter';

    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');

        $appointments = Appointment::with('jadwaldokter')
            ->whereIn('status_janji', ['pending', 'called'])
            ->whereHas('jadwaldokter', function ($q) use ($now) {
                $q->where(function ($sub) use ($now) {
                    // Tanggal jadwal sudah lewat (kemarin atau lebih lama)
                    $sub->where('tanggal', '<', $now->toDateString())
                        // ATAU hari ini tapi jam_selesai sudah lewat
                        ->orWhere(function ($today) use ($now) {
                            $today->where('tanggal', $now->toDateString())
                                  ->where('jam_selesai', '<', $now->format('H:i:s'));
                        });
                });
            })
            ->get();

        $total = 0;

        foreach ($appointments as $appointment) {
            $appointment->update(['status_janji' => 'cancelled']);

            $jadwal = $appointment->jadwaldokter;
            if ($jadwal) {
                $jadwal->decrement('terisi');
                if ($jadwal->status_jadwal === 'Full') {
                    $jadwal->update(['status_jadwal' => 'Closed']);
                }
            }

            $total++;
        }

        $this->info("Selesai: {$total} appointment dibatalkan.");
    }
}