<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Jalan setiap 30 menit, cek appointment yang sudah lewat jam praktik
        $schedule->command('appointment:batalkan-kadaluarsa')->everyThirtyMinutes();
        $schedule->command('jadwal:tutup-kadaluarsa')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}