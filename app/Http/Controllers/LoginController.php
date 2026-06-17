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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            // ✅ BLOCK USER INACTIVE
            if (Auth::user()->status !== 'active') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun Anda dinonaktifkan oleh admin.'
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

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
    
}