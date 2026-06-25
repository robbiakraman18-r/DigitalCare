<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Update password — dipakai oleh Admin dan Pasien.
     * (Dokter sudah pakai DokterController@updatePassword yang ada)
     *
     * ─────────────────────────────────────────────────────────────
     * TAMBAHKAN 2 route berikut di web.php Anda:
     *
     * // Di dalam group prefix('admin'):
     * Route::put('/password', [ChangePasswordController::class, 'update'])
     *      ->name('admin.password.update');
     *
     * // Di dalam group prefix('pasien'):
     * Route::put('/password', [ChangePasswordController::class, 'update'])
     *      ->name('pasien.password.update');
     * ─────────────────────────────────────────────────────────────
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required'         => 'Password baru wajib diisi.',
            'password.min'              => 'Password baru minimal 8 karakter.',
            'password.confirmed'        => 'Konfirmasi password tidak cocok.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifikasi password lama
        if (! Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput();
        }

        // Simpan password baru
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke profil sesuai role
        $profileRoute = match ($user->role) {
            'admin'  => 'admin.profile',
            'pasien' => 'profile.show',   // sesuai route di web.php
            default  => 'profile.show',
        };

        return redirect()->route($profileRoute)
            ->with('success', 'Password berhasil diperbarui.');
    }
}