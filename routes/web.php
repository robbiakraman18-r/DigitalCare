<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/list-item', [ListItemController::class, 'index']);

Route::get('/dashboard/{role}', [DashboardController::class, 'index']);

Route::view('/register', 'register');
Route::view('/info_klinik', 'info_klinik');
Route::view('/edit_profil', 'EditProfil');
Route::view('/test', 'test');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');




use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);