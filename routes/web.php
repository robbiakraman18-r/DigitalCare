<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest; // Diperlukan untuk validasi signed URL email

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController; // Diimpor untuk menangani halaman instruksi verifikasi
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ListPatientController;
use App\Http\Controllers\ListprescriptionController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AppointmentController;


/*
|--------------------------------------------------------------------------
| WEB
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    return view('app');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// --- LOGIN ROUTES ---
Route::get('/login', [LoginController::class, 'index'])->name('login'); 
Route::post('/login', [LoginController::class, 'login']);

// --- REGISTER ROUTES ---
// 1. Route untuk menampilkan halaman register
Route::get('/register', [RegisterController::class, 'index']);

// 2. Route untuk memproses data form register (Auto-Create Pasien & No. RM)
Route::post('/register', [RegisterController::class, 'store']);

// --- EMAIL VERIFICATION ROUTES ---
// 3. Menampilkan halaman instruksi "Silakan cek email" setelah klik daftar
Route::get('/verification', [VerificationController::class, 'index'])->name('verification');

// 4. Memproses verifikasi ketika user MENGEKLIK LINK dari inbox email mereka
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    // Menandai status email_verified_at di database secara otomatis
    $request->fulfill();

    // Alihkan ke halaman login dengan membawa pesan sukses
    return redirect('/login')->with('success', 'Register berhasil, Login menggunakan akun anda');
})->middleware(['auth', 'signed'])->name('verification.verify');

/*
|--------------------------------------------------------------------------
| PASIEN
|--------------------------------------------------------------------------
*/

Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
    // AJAX: ambil jadwal dokter
    Route::get('/dokter/{id}/jadwal', [AppointmentController::class, 'getJadwal']);
    Route::post('/appointment', [AppointmentController::class, 'store']);
    Route::get('/dashboard', [PasienController::class, 'dashboard']);
    Route::view('/buat-janji', 'pasien.buat-janji');
    Route::view('/janji-temu', 'pasien.janji-temu');
    Route::view('/on-going', 'pasien.on-going');
    Route::view('/rekam-medis', 'pasien.rekam-medis');
    Route::view('/detail-rekam-medis', 'pasien.detail-rekam-medis');
    Route::view('/download-rekam-medis', 'pasien.download-rekam-medis');
    Route::view('/payment', 'pasien.payment');
    Route::view('/info-klinik', 'pasien.info-clinic');
    Route::view('/edit-profile', 'pasien.edit-profil');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| DOKTER
|--------------------------------------------------------------------------
*/

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {

    Route::get('/dashboard', [DokterController::class, 'dashboard'])
        ->name('dokter.dashboard');

    Route::get('/profile', [DokterController::class, 'profile'])
    ->name('dokter.profile');

    Route::get('/pasien', [DokterController::class, 'pasien'])
        ->name('dokter.pasien');

    Route::get('/appointment', [DokterController::class, 'appointment'])
        ->name('dokter.appointment');

    Route::get('/jadwal-praktik', [DokterController::class, 'jadwal'])
        ->name('dokter.jadwal');

    Route::get('/rekam-medis', [DokterController::class, 'rekamMedis'])
        ->name('dokter.rekammedis');

    Route::get('/diagnosis-prescription', [DokterController::class, 'diagnosis'])
        ->name('dokter.diagnosis');

    Route::get('/detail-pasien/{id}', [DokterController::class, 'detailPasien'])
        ->name('dokter.detailpasien');

    Route::view('/info-klinik', 'dokter.info-klinik-dokter')
        ->name('dokter.info');

    Route::get('/medical-history', [DokterController::class, 'medicalHistory'])
        ->name('dokter.medicalhistory');
});
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::view('/user-management', 'admin.user-management');
    Route::view('/appointment', 'admin.appointment');
    Route::view('/schedule-management', 'admin.schedule-management');
    Route::view('/medical-records', 'admin.medical-records');
    Route::view('/reports', 'admin.reports');
    Route::view('/payments', 'admin.payments');
    Route::view('/settings', 'admin.settings');
    Route::view('/profile', 'admin.profile');

    Route::get('/listpatient', [ListPatientController::class, 'show']);
    Route::get('/listprescription', [ListprescriptionController::class, 'show']);
});

Route::get('/test-users', function () {
    return App\Models\User::all();
});
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::view('/user-management', 'admin.user-management');
    Route::view('/appointment', 'admin.appointment');
    Route::view('/schedule-management', 'admin.schedule-management');
    Route::view('/medical-records', 'admin.medical-records');
    Route::view('/reports', 'admin.reports');
    Route::view('/payments', 'admin.payments');
    Route::view('/settings', 'admin.settings');
    Route::view('/profile', 'admin.profile');

    // DOCTOR SCHEDULE
    Route::get('/doctor-schedule', [AdminController::class, 'schedule']);
    Route::post('/doctor-schedule', [AdminController::class, 'storeSchedule']);

    // COMPLAINT
    Route::get('/complaint', [AdminController::class, 'complaint']);

    Route::get('/listpatient', [ListPatientController::class, 'show']);
    Route::get('/listprescription', [ListprescriptionController::class, 'show']);
});
