<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;
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

Route::get('/login', [LoginController::class, 'index']);

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});

/*
|--------------------------------------------------------------------------
| PASIEN
|--------------------------------------------------------------------------
*/

Route::view('/dashboard', 'pasien.dashboard');

Route::view('/buat-janji', 'pasien.buat-janji');

Route::view('/janji-temu', 'pasien.janji-temu');

Route::view('/on-going', 'pasien.on-going');

Route::view('/rekam-medis', 'pasien.rekam-medis');

Route::view('/detail-rekam-medis', 'pasien.detail-rekam-medis');

Route::view('/download-rekam-medis', 'pasien.download-rekam-medis');

Route::view('/payment', 'pasien.payment');

Route::view('/info-klinik', 'pasien.Info_klinik');

Route::view('/edit-profile', 'pasien.edit-profil');

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

Route::view('/dokter-dashboard', 'dokter.dashboard');

Route::view('/jadwal-praktik', 'dokter.jadwal-praktik');

Route::view('/appointment', 'dokter.appointment');

Route::view('/diagnosis-prescription', 'dokter.diagnosis');

Route::view('/medical-history', 'dokter.medical-history');

Route::view('/dokter-pasien', 'dokter.pasien');

Route::view('/dokter/detail-pasien', 'dokter.detail-pasien');

Route::view('/dokter/rekam-medis', 'dokter.rekam-medis');

Route::view('/info-klinik-dokter', 'dokter.info-klinik-dokter');

Route::view('/profil-dokter', 'dokter.profil');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::view('/dashboard-admin', 'admin.dashboard');

Route::view('/admin-user-management', 'admin.user-management');

Route::view('/admin-appointment', 'admin.appointment');

Route::view('/admin-schedule-management', 'admin.schedule-management');

Route::view('/admin-medical-records', 'admin.medical-records');

Route::view('/admin-reports', 'admin.reports');

Route::view('/admin-payments', 'admin.payments');

Route::view('/admin-settings', 'admin.settings');

Route::view('/profil-admin', 'admin.profile');

use App\Http\Controllers\ListPatientController;

Route::get('/listpatient', [ListPatientController::class, 'show']);

use App\Http\Controllers\ListprescriptionController;

Route::get('/listprescription', [ListprescriptionController::class, 'show']);