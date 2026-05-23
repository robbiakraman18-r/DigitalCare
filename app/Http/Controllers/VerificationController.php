<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Menampilkan halaman instruksi verifikasi akun setelah user klik daftar.
     */
    public function index()
    {
        // PENGAMAN: Jika tidak ada session 'success' (artinya user coba tembak langsung lewat URL),
        // dan tidak ada session 'verified' (bukan setelah klik link email), paksa tendang balik ke register.
        if (!session('success') && !session('verified')) {
            return redirect('/register');
        }

        return view('auth.verification');
    }
}