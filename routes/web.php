<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
});

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

Route::get('/dashboard', function () {
    return view('pasien.dashboard');
});

Route::get('/buat-janji', function () {
    return view('pasien.buat-janji');
});

Route::get('/janji-temu', function () {
    return view('pasien.janji-temu');
});

Route::get('/on-going', function () {
    return view('pasien.on-going');
});

Route::get('/rekam-medis', function () {
    return view('pasien.rekam-medis');
});

Route::view('/detail-rekam-medis', 'pasien.detail-rekam-medis');

Route::view('/download-rekam-medis', 'pasien.download-rekam-medis');

Route::view('/payment', 'pasien.payment');

Route::get('/info-klinik', function () {
    return view('pasien.Info_klinik');
});

Route::get('/edit-profile', function () {
    return view('pasien.edit-profil');
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

Route::view('/dokter-dashboard', 'dokter.dashboard');

Route::view('/jadwal-praktik', 'dokter.jadwal-praktik');

Route::view('/appointment', 'dokter.appointment');

Route::view('/medical-history', 'dokter.medical-history');

Route::view('/dokter-pasien', 'dokter.pasien');

Route::get('/dokter/detail-pasien', function () {
    return view('dokter.detail-pasien');
});

Route::get('/dokter/rekam-medis', function () {
    return view('dokter.rekam-medis');
});

Route::get('/info-klinik-dokter', function () {
    return view('dokter.info-klinik-dokter');
});

Route::view('/profil-dokter', 'dokter.profil');






Route::view('/dashboard-admin', 'admin.dashboard');

Route::view('/admin-user-management', 'admin.user-management');

Route::view('/admin-appointment', 'admin.appointment');

Route::view('/admin-schedule-management', 'admin.schedule-management');

Route::view('/admin-medical-records', 'admin.medical-records');

Route::view('/admin-reports', 'admin.reports');

Route::view('/admin-payments', 'admin.payments');

Route::view('/admin-settings', 'admin.settings');

Route::view('/profil-admin', 'admin.profile');