<?php

namespace App\Providers;

use App\View\Composers\AdminNotifikasiComposer;
use App\View\Composers\NotifikasiComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Pakai '*' (semua view) karena topbar dipanggil sebagai Blade Component
        // (<x-topbar-admin />), bukan lewat @include(), jadi nama view internalnya
        // beda dan tidak bisa ditarget pakai string 'auth.components.topbar-admin'.
        // Aman dipakai di semua view karena masing-masing composer sudah cek
        // kondisinya sendiri (role admin / relasi dokter) sebelum isi data.
        View::composer('*', NotifikasiComposer::class);
        View::composer('*', AdminNotifikasiComposer::class);
    }
}