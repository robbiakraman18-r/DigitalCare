<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ListPatientController;
use App\Http\Controllers\ListprescriptionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\JadwalController;



/*
|--------------------------------------------------------------------------
| WEB
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('welcome'));
Route::get('/app', fn () => view('app'));

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/verification', [VerificationController::class, 'index'])->name('verification');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('success', 'Register berhasil, Login menggunakan akun anda');
})->middleware(['auth', 'signed'])->name('verification.verify');

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
| PASIEN
|--------------------------------------------------------------------------
*/

Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {

    Route::get('/dashboard', [PasienController::class, 'dashboard']);

    Route::get('/dokter/{id}/jadwal', [AppointmentController::class, 'getJadwal']);
    Route::post('/appointment', [AppointmentController::class, 'store']);

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
| DOKTER
|--------------------------------------------------------------------------
*/

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->group(function () {

    Route::get('/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');
    Route::get('/profile', [DokterController::class, 'profile'])->name('dokter.profile');
    Route::get('/jadwal-praktik', [DokterController::class, 'jadwal'])->name('dokter.jadwal');
    Route::get('/appointment', [DokterController::class, 'appointment'])->name('dokter.appointment');
    Route::post('/appointment/panggil/{id}', [DokterController::class, 'panggilPasien'])->name('dokter.panggil');
    
    Route::post('/appointment/selesai/{id}', [DokterController::class, 'selesaiPasien'])->name('dokter.selesai');
    Route::post('/appointment/cancel/{id}', [DokterController::class, 'cancelPasien'])->name('dokter.cancel');
    Route::post('/appointment/next', [DokterController::class, 'nextPasien'])->name('dokter.next');



    Route::get('/pasien', [DokterController::class, 'pasien'])->name('dokter.pasien');
    Route::get('/rekam-medis', [DokterController::class, 'rekamMedis'])->name('dokter.rekammedis');
    Route::get('/diagnosis-prescription', [DokterController::class, 'diagnosis'])->name('dokter.diagnosis');
    Route::get('/detail-pasien/{id}', [DokterController::class, 'detailPasien'])->name('dokter.detailpasien');
    Route::get('/medical-history', [DokterController::class, 'medicalHistory'])->name('dokter.medicalhistory');

    Route::view('/info-klinik', 'dokter.info-klinik-dokter')->name('dokter.info');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/user-management', [AdminController::class, 'userManagement']);


    Route::view('/appointment', 'admin.appointment');
    Route::view('/schedule-management', 'admin.schedule-management');
    Route::view('/medical-records', 'admin.medical-records');
    Route::view('/reports', 'admin.reports');
    Route::view('/payments', 'admin.payments');
    Route::view('/settings', 'admin.settings');
    Route::view('/profile', 'admin.profile');

    // CRUD DOCTOR
    Route::post('/doctor', [AdminController::class, 'storeDokter'])
    ->name('admin.doctor.store');

    // BUAT EDIT USER
    Route::put('/user/{id}', [AdminController::class, 'updateUser'])
    ->name('admin.user.update');

    // BUAT DELETE USER 
    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])
    ->name('admin.user.delete');

    // TOGGLE STATUS USER
    Route::put('/user/{id}/toggle-status', [AdminController::class, 'toggleStatus'])
    ->name('admin.user.toggleStatus');

    // DOCTOR SCHEDULE
    Route::get('/doctor-schedule', [AdminController::class, 'schedule']);
    Route::post('/doctor-schedule', [AdminController::class, 'storeSchedule']);

    // UPDATE JADWAL PRAKTIK DOKTER

    Route::put('/doctor-schedule/{id}', [AdminController::class, 'updateJadwalDokter'])
->name('admin.doctor.schedule.update');

    // COMPLAINT

    Route::get('/complaint', [AdminController::class, 'complaint']);

    // LIST DATA
    Route::get('/listpatient', [ListPatientController::class, 'show']);
    Route::get('/listprescription', [ListprescriptionController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| TEST
|--------------------------------------------------------------------------
*/

Route::get('/test-users', fn () => App\Models\User::all());
Route::put('/admin/user/{id}/update', [AdminController::class, 'updateUser'])
    ->name('admin.user.update');