<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Perlu di-import
use App\Models\User; // Pastikan model User di-import

class LoginController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman login (sudah Anda punya sebelumnya)
    public function index()
    {
        return view('auth.login');
    }

    // 2. FUNGSI BARU: Untuk memproses data ketika tombol login ditekan
    public function login(Request $request)
    {
        // Validasi input email dan password dari form HTML
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Proses Autentikasi: Cocokkan email & password dengan database
        if (Auth::attempt($credentials)) {
            // Jika sukses, amankan session user
            $request->session()->regenerate();

            // Ambil role dari user yang berhasil login
            $role = Auth::user()->role;

            // Alihkan halaman otomatis berdasarkan role-nya
            return match ($role) {
                'admin' => redirect('/admin/dashboard'),
                'dokter' => redirect('/dokter/dashboard'),
                default => redirect('/pasien/dashboard'), // pasien atau role lainnya
            };
        }

        // Jika email atau password salah, balikkan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
}