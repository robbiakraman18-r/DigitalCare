<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect('/admin/dashboard'),
                'dokter' => redirect('/dokter/dashboard'),
                default => redirect('/pasien/dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }
}