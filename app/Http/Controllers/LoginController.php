<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'ends_with:@gmail.com'
            ],
            'password' => [
                'required',
                'min:8'
            ]
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.ends_with' => 'Email harus menggunakan @gmail.com.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus lebih dari 8 karakter.',
        ]);


        // cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.'
            ])->onlyInput('email');
        }


        // cek password + login
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            return back()->withErrors([
                'password' => 'Kata sandi salah.'
            ])->onlyInput('email');
        }


        // BLOCK USER INACTIVE
        if (Auth::user()->status !== 'active') {

            Auth::logout();

            return back()->withErrors([
                'email' => 'Akun Anda dinonaktifkan oleh admin.'
            ])->onlyInput('email');
        }

        // BLOCK jika email belum diverifikasi
        if (Auth::user()->email_verified_at === null) {

            $user->sendEmailVerificationNotification();

            Auth::logout();

            return back()->withErrors([
                'email' => 'Email belum diverifikasi. Email verifikasi baru telah dikirim. Silakan cek Gmail Anda.'
            ])->onlyInput('email');
        }


        $request->session()->regenerate();


        $role = Auth::user()->role;
        

        return match ($role) {
            'admin' => redirect('/admin/dashboard'),
            'dokter' => redirect('/dokter/dashboard'),
            default => redirect('/pasien/dashboard'),
        };
    }
    
}