<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail; // Tambahkan ini
use Illuminate\Notifications\Messages\MailMessage; // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Kustomisasi pesan email verifikasi ke Bahasa Indonesia
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email - DigitalCare')
                ->greeting('Halo, ' . $notifiable->nama . '!')
                ->line('Terima kasih telah mendaftar di DigitalCare PoliBatam.')
                ->line('Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun rekam medis Anda.')
                ->action('Verifikasi Email Saya', $url)
                ->line('Jika Anda tidak merasa membuat akun ini, abaikan saja email ini.');
        });
    }
}