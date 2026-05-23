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
        // 1. Validasi server-side
        $request->validate([
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // 2. Transaksi Database (Hasil 'return' di dalam sini akan langsung disimpan ke variabel $user)
        $user = DB::transaction(function () use ($request) {
            
            // A. Membuat Akun Utama Login
            $createdUser = User::create([
                'nama'     => $request->nama, 
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'pasien',
            ]);

            // B. Logika Pembuatan Kode Rekam Medis (RM) Otomatis
            $tahun = date('Y');
            $jumlahPasienTahunIni = Pasien::whereYear('created_at', $tahun)->count();
            $urutan = str_pad($jumlahPasienTahunIni + 1, 4, '0', STR_PAD_LEFT);
            $noRM = 'RM' . $tahun . $urutan;

            // C. Membuat Profil Pasien Kosong
            Pasien::create([
                'user_id' => $createdUser->id,
                'no_rm'   => $noRM,
            ]);

            // Wajib kembalikan data user agar ditangkap oleh variabel $user di atas
            return $createdUser;
        });

        // 3. Memicu email verifikasi otomatis via SMTP Gmail (DIJAMIN TIDAK MERAH)
        event(new Registered($user));

        // 4. Melakukan login otomatis agar session terbentuk
        Auth::login($user);

        // 5. Melempar ke halaman verifikasi akun
        return redirect('/verification')
            ->with('success', 'Akun berhasil dibuat!')
            ->with('email', $user->email); 
    }
}