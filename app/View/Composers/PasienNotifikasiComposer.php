<?php

namespace App\View\Composers;

use App\Models\Notifikasi;
use Illuminate\View\View;

class PasienNotifikasiComposer
{
    public function compose(View $view): void
    {
        $pasien = auth()->check() ? auth()->user()->pasien : null;

        if (!$pasien) {
            $view->with([
                'notifikasiListPasien'   => collect(),
                'notifAppointmentPasien' => 0,
                'notifRekamMedis'        => 0,
                'notifKomplainPasien'    => 0,
                'notifTotalUnreadPasien' => 0,
            ]);
            return;
        }

        $notifikasi = Notifikasi::where('pasien_id', $pasien->id_pasien)
            ->latest()
            ->get();

        logger()->info('PASIEN COMPOSER', [
    'pasien_id' => $pasien->id_pasien,
    'count' => $notifikasi->count(),
    'unread' => $notifikasi->where('is_read', false)->count(),
]);

        $view->with([
            'notifikasiListPasien'   => $notifikasi->take(5),
            'notifAppointmentPasien' => $notifikasi->where('tipe', 'appointment')->where('is_read', false)->count(),
            'notifRekamMedis'        => $notifikasi->where('tipe', 'rekam_medis')->where('is_read', false)->count(),
            'notifKomplainPasien'    => $notifikasi->where('tipe', 'komplain')->where('is_read', false)->count(),
            'notifTotalUnreadPasien' => $notifikasi->where('is_read', false)->count(),
        ]);
    }
}