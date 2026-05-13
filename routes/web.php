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