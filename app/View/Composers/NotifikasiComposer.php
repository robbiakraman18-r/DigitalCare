<?php

namespace App\View\Composers;

use App\Models\Notifikasi;
use Illuminate\View\View;

class NotifikasiComposer
{
    public function compose(View $view): void
    {
        $dokter = auth()->check() ? auth()->user()->dokter : null;

        if (!$dokter) {
            $view->with([
                'notifikasiList'    => collect(),
                'notifJadwal'       => 0,
                'notifAppointment'  => 0,
                'notifPasien'       => 0,
                'notifPemeriksaan'  => 0,
                'notifTotalUnread'  => 0,
            ]);
            return;
        }

        $notifikasi = Notifikasi::where('dokter_id', $dokter->id_dokter)
            ->latest()
            ->get();

        $view->with([
            'notifikasiList'    => $notifikasi->take(5),
            'notifJadwal'       => $notifikasi->where('tipe', 'jadwal')->where('is_read', false)->count(),
            'notifAppointment'  => $notifikasi->where('tipe', 'appointment')->where('is_read', false)->count(),
            'notifPasien'       => $notifikasi->where('tipe', 'pasien')->where('is_read', false)->count(),
            'notifPemeriksaan'  => $notifikasi->where('tipe', 'pemeriksaan')->where('is_read', false)->count(),
            'notifTotalUnread'  => $notifikasi->where('is_read', false)->count(),
        ]);
    }
}