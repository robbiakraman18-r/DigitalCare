<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\RekamMedis; 

class PasienController extends Controller
{
    public function dashboard()
    {
        // 1. Ambil ID User Pasien yang sedang aktif login
        $pasienId = Auth::id();

        // 2. Ambil 1 data Janji Temu Terdekat milik pasien ini
        $janjiTerdekat = Appointment::where('user_id', $pasienId)
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->first();

        // 3. Ambil data Rekam Medis terakhir SEKALIGUS include data ResepObat di dalamnya
        $rekamMedis = RekamMedis::with('resepObat') // Eager loading relasi resepObat
            ->where('user_id', $pasienId)
            ->latest()
            ->first();

        // 4. Ambil daftar resep obat langsung dari object rekam medis di atas (jika rekam medisnya ada)
        $resepObat = $rekamMedis ? $rekamMedis->resepObat : collect();

        // 5. Hitung total berapa kali pasien ini pernah berkunjung ke klinik
        $totalKunjungan = RekamMedis::where('user_id', $pasienId)->count();

        // 6. Kirimkan semua data dinamis ke dalam halaman Blade
        return view('pasien.dashboard', compact(
            'janjiTerdekat',
            'rekamMedis',
            'resepObat',
            'totalKunjungan'
        ));
    }
}