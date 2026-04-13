<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\AboutController;


Route::get('/', function () {
    return view('welcome'); // atau halaman utama kamu
});
Route::get('/app', function () {
return view('app');
});

Route::get('/login', [LoginController::class, 'index']);
Route::get('/list-item', [ListItemController::class, 'index']);
Route::get('/About_view', [AboutController::class, 'index']);



Route::view('/dashboard', 'dashboard');
Route::view('/info_klinik', 'info_klinik');
Route::view('/edit_profil', 'EditProfil');