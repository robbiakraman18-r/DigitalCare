<?php

namespace App\View\Composers;

use App\Models\Notifikasi;
use Illuminate\View\View;

class AdminNotifikasiComposer
{
    public function compose(View $view): void
    {
        // GANTI kondisi ini sesuai cara kamu menandai user sebagai admin,
        // misalnya kalau ada kolom role di tabel users:
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        if (!$isAdmin) {
            $view->with([
                'notifikasiListAdmin'   => collect(),
                'notifAppointmentAdmin' => 0,
                'notifDokterAdmin'      => 0,
                'notifPasienAdmin'      => 0,
                'notifLaporanAdmin'     => 0,
                'notifTotalUnreadAdmin' => 0,
            ]);
            return;
        }

        // Notifikasi admin bersifat GLOBAL (dokter_id kosong / null),
        // semua admin lihat daftar yang sama.
        $notifikasi = Notifikasi::whereNull('dokter_id')
            ->latest()
            ->get();

        $view->with([
            'notifikasiListAdmin'   => $notifikasi->take(5),
            'notifAppointmentAdmin' => $notifikasi->where('tipe', 'appointment')->where('is_read', false)->count(),
            'notifDokterAdmin'      => $notifikasi->where('tipe', 'dokter')->where('is_read', false)->count(),
            'notifPasienAdmin'      => $notifikasi->where('tipe', 'pasien')->where('is_read', false)->count(),
            'notifLaporanAdmin'     => $notifikasi->where('tipe', 'laporan')->where('is_read', false)->count(),
            'notifTotalUnreadAdmin' => $notifikasi->where('is_read', false)->count(),
        ]);
    }
}