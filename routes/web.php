<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\AdminJadwalController;


// Controller Imports
use App\Http\Controllers\{
    LoginController, AdminController, PasienController, RegisterController, 
    VerificationController, DokterController, ListPatientController, 
    ListprescriptionController, AppointmentController, JadwalController, ProfileController
};



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
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

    // Appointment
    Route::get('/buat-janji', [AppointmentController::class, 'create'])->name('pasien.buat-janji');
    Route::post('/buat-janji/store', [AppointmentController::class, 'store'])->name('pasien.buat-janji.store');
    Route::get('/dokter/{id}/jadwal', [AppointmentController::class, 'getJadwal']);
    Route::post('/appointment', [AppointmentController::class, 'store']);

    // Rute memproses form booking
    Route::post('/book-appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    // Rute menampilkan halaman nomor antrean
    Route::get('/nomor-antrian/{id}', [AppointmentController::class, 'showQueue'])->name('nomor.antrian');

    // Static Views
    Route::view('/janji-temu', 'pasien.janji-temu');
    Route::view('/on-going', 'pasien.on-going');
    Route::view('/listrekam-medis', 'pasien.listrekam-medis');
    Route::view('/detail-rekam-medis', 'pasien.detail-rekam-medis');
    Route::view('/download-rekam-medis', 'pasien.download-rekam-medis');
    Route::view('/payment', 'pasien.payment');
    Route::view('/info-klinik', 'pasien.info-clinic');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profil', [ProfileController::class, 'update'])->name('profile.update');
});

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

    Route::post('/profile/photo', [DokterController::class, 'uploadPhoto'])
        ->name('dokter.profile.photo');

    Route::get('/jadwal-praktik', [DokterController::class, 'jadwal'])
        ->name('dokter.jadwal');

    Route::get('/appointment', [DokterController::class, 'appointment'])
        ->name('dokter.appointment');

    Route::post('/appointment/panggil/{id}', [DokterController::class, 'panggilPasien'])
        ->name('dokter.panggil');

    Route::post('/appointment/start/{id}', [DokterController::class, 'startConsultation'])
        ->name('dokter.start');

    Route::post('/appointment/selesai/{id}', [DokterController::class, 'selesaiPasien'])
        ->name('dokter.selesai');

    Route::post('/appointment/cancel/{id}', [DokterController::class, 'cancelPasien'])
        ->name('dokter.cancel');

    Route::post('/appointment/next', [DokterController::class, 'nextPasien'])
        ->name('dokter.next');

    // MENU PEMERIKSAAN
    Route::get('/pemeriksaan/{id_janji?}', [DokterController::class, 'pemeriksaan'])
        ->name('dokter.pemeriksaan');

    // HALAMAN PEMERIKSAAN PASIEN
    Route::get('/diagnosis-prescription/{id}', [DokterController::class, 'diagnosis'])
        ->name('dokter.diagnosis');

    Route::post('/diagnosis-prescription/{id}', [DokterController::class, 'simpanDiagnosis'])
        ->name('dokter.diagnosis.store');

    Route::get('/pasien', [DokterController::class, 'pasien'])
        ->name('dokter.pasien');

    Route::get('/detail-pasien/{id}', [DokterController::class, 'detailPasien'])
        ->name('dokter.detailpasien');

    Route::get('/rekam-medis', [DokterController::class, 'rekamMedis'])
        ->name('dokter.rekammedis');

    Route::get('/medical-history', [DokterController::class, 'medicalHistory'])
        ->name('dokter.medicalhistory');

    Route::view('/info-klinik', 'dokter.info-klinik-dokter')
        ->name('dokter.info');

    Route::get('/help', function () {
        return view('dokter.help');
        })->name('dokter.help');

    Route::get('/dokter/settings/password', [DokterController::class, 'passwordPage'])
        ->name('dokter.password.page');
        
    Route::post('/dokter/settings/password', [DokterController::class, 'updatePassword'])
        ->name('dokter.password.update');

    Route::get('/password/success', function () {
        return view('auth.password-success');
        })->name('password.success');
});
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/user-management', [AdminController::class, 'userManagement']);


    Route::get('/appointment',
   [AdminController::class, 'appointment'])
   ->name('admin.appointment');
    Route::post('/appointment/store', [AdminController::class, 'storeAppointment'])
    ->name('admin.appointment.store');
   Route::put('/appointment/status/{id}',
   [AdminController::class, 'updateAppointmentStatus'])
   ->name('admin.appointment.status');

    Route::delete('/appointment/delete/{id}',
   [AdminController::class, 'deleteAppointment'])
   ->name('admin.appointment.delete');



   





   Route::view('/medical-records', 'admin.medical-records');
    Route::view('/reports', 'admin.reports');
    Route::view('/payments', 'admin.payments');
    Route::view('/settings', 'admin.settings');
    Route::view('/profile', 'admin.profile')->name('admin.profile');
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

    Route::get('/complaint', [AdminController::class, 'complaint'])->name('admin.complaint');
    Route::post('/complaint/{id}/update', [AdminController::class, 'updateComplaint'])
    ->name('admin.complaint.update');
    
    // LIST DATA
    Route::get('/listpatient', [ListPatientController::class, 'show']);
    Route::get('/listprescription', [ListprescriptionController::class, 'show']);

    
    
    
    
   
Route::get('/schedule-management', [AdminJadwalController::class, 'index'])
    ->name('admin.schedule.index');

Route::post('/schedule-management/store', [AdminJadwalController::class, 'store'])
    ->name('admin.schedule.store');

Route::get('/schedule-management/edit/{id}', [AdminJadwalController::class, 'edit'])
    ->name('admin.schedule.edit');

Route::put('/schedule-management/update/{id}', [AdminJadwalController::class, 'update'])
    ->name('admin.schedule.update');

Route::delete('/schedule-management/delete/{id}', [AdminJadwalController::class, 'destroy'])
    ->name('admin.schedule.destroy');
});


