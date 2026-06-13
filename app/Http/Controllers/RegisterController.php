<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Auth\Events\Registered; 

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = DB::transaction(function () use ($request) {
            $createdUser = User::create([
                'nama'     => $request->nama, 
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'pasien',
            ]);
            $tahun = date('Y');
            $jumlahPasienTahunIni = Pasien::whereYear('created_at', $tahun)->count();
            $urutan = str_pad($jumlahPasienTahunIni + 1, 4, '0', STR_PAD_LEFT);
            $noRM = 'RM' . $tahun . $urutan;
            Pasien::create([
                'user_id' => $createdUser->id,
                'no_rm'   => $noRM,
            ]);
            return $createdUser;
        });
        event(new Registered($user));
        Auth::login($user);
        return redirect('/verification')
            ->with('success', 'Akun berhasil dibuat!')
            ->with('email', $user->email); 
    }
}