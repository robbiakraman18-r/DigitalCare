<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ChangePasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminRekamMedisController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use App\Http\Controllers\NotifikasiController;


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

Route::get('/', [WelcomeController::class, 'index']);
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



Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {

    $user = User::findOrFail($id);

    // Pastikan hash sesuai
    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403);
    }

    // Tandai email sudah diverifikasi
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect('/login')->with(
        'success',
        'Email berhasil diverifikasi. Silakan login.'
    );

})->middleware('signed')->name('verification.verify');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


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

    // Dashboard
    Route::get('/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

    // Janji Temu
    Route::get('/buat-janji', [AppointmentController::class, 'create'])->name('pasien.buat-janji');
    Route::post('/buat-janji/store', [AppointmentController::class, 'store'])->name('pasien.buat-janji.store');
    Route::get('/nomor-antrian/{id}', [AppointmentController::class, 'showQueue'])->name('nomor.antrian');
    Route::get('/on-going', [AppointmentController::class, 'onGoing'])->name('pasien.on-going');
    Route::get('/janji-temu', [AppointmentController::class, 'index'])->name('pasien.janji-temu');

    // Rekam Medis
    Route::get('/listrekam-medis', [PasienController::class, 'listRekamMedis'])->name('pasien.listrekam-medis');
    Route::get('/detail-rekam-medis/{id}', [PasienController::class, 'detailRekamMedis'])->name('pasien.detail-rekam-medis');

    // Info & Help
    Route::get('/info-klinik', [PasienController::class, 'clinicInfo'])->name('pasien.info-klinik');
    Route::get('/help', [PasienController::class, 'help'])->name('pasien.help');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/password', [ChangePasswordController::class, 'update'])
        ->name('pasien.password.update');
    Route::get('/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pasien/change-password', [PasienController::class, 'showChangePasswordForm'])
    ->name('pasien.change-password');
    Route::post('/pasien/change-password', [PasienController::class, 'changePassword'])
        ->name('pasien.change-password.update');

    // Notifikasi
    Route::get('/notifikasi/{notifikasi}/read', function (\App\Models\Notifikasi $notifikasi) {
        $notifikasi->update(['is_read' => true]);
        return $notifikasi->link ? redirect($notifikasi->link) : back();
        })->name('pasien.notifikasi.read');

    //complaint
   Route::get('/complaint', [PasienController::class, 'complaint'])->name('pasien.complaint');
Route::post('/complaint', [PasienController::class, 'storeComplaint'])->name('pasien.complaint.store');
Route::put('/complaint/{id}/confirm', [PasienController::class, 'confirmComplaint'])->name('pasien.complaint.confirm');

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


    Route::get('/help', function () {
        return view('dokter.help');
        })->name('dokter.help');

    // ✅ BENAR
    Route::get('/info-klinik', [DokterController::class, 'clinicInfo'])
        ->name('dokter.info-klinik');

    Route::get('/settings/password', [DokterController::class, 'passwordPage'])
        ->name('dokter.password.page');

    Route::post('/settings/password', [DokterController::class, 'updatePassword'])
        ->name('dokter.password.update');

    Route::get('/password/success', function () {
        return view('auth.password-success');
        })->name('password.success');

    //notifikasi
    Route::get('/dokter/notifikasi/{notifikasi}/read', [NotifikasiController::class, 'markAsRead'])
        ->name('dokter.notifikasi.read');

    Route::post('/dokter/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])
        ->name('dokter.notifikasi.read-all');

    //complaint
    Route::get('/complaint', [DokterController::class, 'complaint'])->name('dokter.complaint');
Route::post('/complaint', [DokterController::class, 'storeComplaint'])->name('dokter.complaint.store');
Route::put('/complaint/{id}/confirm', [DokterController::class, 'confirmComplaint'])->name('dokter.complaint.confirm');
});
/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/user-management', [AdminController::class, 'userManagement'])->name('admin.user-management');


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
    Route::view('/settings', 'admin.settings');


    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    
    
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
    Route::get('/complaint', [App\Http\Controllers\AdminController::class, 'complaint']);
    Route::put('/complaint/{id}', [App\Http\Controllers\AdminController::class, 'updateComplaint']);


    // LIST DATA
    Route::get('/listpatient', [ListPatientController::class, 'show'])->name('admin.listpatient');
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


   Route::get('/medical-records', [AdminRekamMedisController::class, 'index'])
    ->name('admin.medical-records.index');

    Route::get('/medical-records/{id}', [AdminRekamMedisController::class, 'show'])
    ->name('admin.medical-records.show');

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('admin.reports.index');
 
    Route::get('/reports/summary/pdf', [ReportController::class, 'exportSummaryPdf'])
        ->name('admin.reports.summary.pdf');
 
    Route::get('/reports/{type}/pdf', [ReportController::class, 'exportPdf'])
        ->name('admin.reports.pdf');
 
    Route::get('/reports/{type}/excel', [ReportController::class, 'exportExcel'])
        ->name('admin.reports.excel');

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('admin.settings.index');
 
    Route::put('/settings/general', [SettingController::class, 'updateGeneral'])
        ->name('admin.settings.general');
 
    Route::put('/settings/address', [SettingController::class, 'updateAddress'])
        ->name('admin.settings.address');
 
    Route::put('/settings/hours', [SettingController::class, 'updateHours'])
        ->name('admin.settings.hours');
 
    Route::put('/settings/social', [SettingController::class, 'updateSocial'])
        ->name('admin.settings.social');
 
    Route::put('/settings/legal', [SettingController::class, 'updateLegal'])
        ->name('admin.settings.legal');

    // Tambah import di atas:

// Tambah di dalam group prefix('admin')->middleware(['auth', 'role:admin']):
    Route::put('/password', [ChangePasswordController::class, 'update'])
        ->name('admin.password.update');

    Route::get('/admin/notifikasi/{notifikasi}/read', function (\App\Models\Notifikasi $notifikasi) {
        $notifikasi->update(['is_read' => true]);
        return $notifikasi->link ? redirect($notifikasi->link) : back();
        })->name('admin.notifikasi.read')->middleware('auth');

    
});


