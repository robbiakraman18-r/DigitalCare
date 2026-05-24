<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\AdminController;

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

Route::get('/admin/doctor-schedule', [AdminController::class, 'schedule']);
Route::post('/admin/doctor-schedule', [AdminController::class, 'storeSchedule']);

Route::get('/admin/complaint', [AdminController::class, 'complaint']);