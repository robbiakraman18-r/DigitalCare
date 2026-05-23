<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login'); 

// BAGIAN INI DIUBAH: Mengarah ke LoginController, bukan AuthController
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
});

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
    Route::view('/info-klinik', 'pasien.info-klinik');
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

    Route::get('/dashboard', [DokterController::class, 'dashboard']);
    Route::view('/jadwal-praktik', 'dokter.jadwal-praktik');
    Route::view('/appointment', 'dokter.appointment');
    Route::view('/diagnosis-prescription', 'dokter.diagnosis');
    Route::view('/medical-history', 'dokter.medical-history');
    Route::view('/pasien', 'dokter.pasien');
    Route::view('/detail-pasien', 'dokter.detail-pasien');
    Route::view('/rekam-medis', 'dokter.rekam-medis');
    Route::view('/info-klinik', 'dokter.info-klinik-dokter');
    Route::view('/profile', 'dokter.profil');
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