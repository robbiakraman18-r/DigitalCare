<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Tandai satu notifikasi sebagai sudah dibaca, lalu redirect ke link tujuannya.
     */
    public function markAsRead(Notifikasi $notifikasi)
    {
        $dokter = Auth::user()->dokter;

        // pastikan notifikasi ini memang milik dokter yang login
        if ($dokter && $notifikasi->dokter_id === $dokter->id_dokter) {
            $notifikasi->update(['is_read' => true]);
        }

        return redirect($notifikasi->link ?? url()->previous());
    }

    /**
     * Tandai semua notifikasi dokter yang login sebagai sudah dibaca.
     */
    public function markAllAsRead(Request $request)
    {
        $dokter = Auth::user()->dokter;

        if ($dokter) {
            Notifikasi::where('dokter_id', $dokter->id_dokter)
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return back();
    }
}