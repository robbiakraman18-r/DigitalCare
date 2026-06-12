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
        if (!session('success') && !session('verified')) {
            return redirect('/register');
        }

        return view('auth.verification');
    }
}