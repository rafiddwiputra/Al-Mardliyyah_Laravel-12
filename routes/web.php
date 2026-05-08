<?php

use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\ProgramPendidikanController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\BeritaController; 
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Public\PendaftaranController;
use App\Http\Controllers\Public\StatusPendaftaranController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Public\RedirectPendaftaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminProfilController;
use App\Http\Controllers\Admin\AdminKontakController;
use App\Http\Controllers\Admin\AdminEditProfilController;
use App\Http\Controllers\Admin\AdminVideoPondokController;
use App\Http\Controllers\Admin\AdminDataPendaftarController;
use App\Http\Controllers\Admin\AdminAktivitasSantriController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Pimpinan\AdminManagementController;
use App\Http\Middleware\CheckActiveStatus;
use App\Http\Controllers\Admin\PeriodePendaftaranController;
use App\Http\Controllers\Pimpinan\LaporanPimpinanController;

// ================== DEBUG ==================
Route::get('/debug-login', function () {
    return auth()->check() ? 'SUDAH LOGIN' : 'BELUM LOGIN';
});

// ================= REGISTER DAN LOGIN (AUTH) =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->middleware('guest')->name('register'); 

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store')
    ->middleware('guest');

Route::get('/login', function () {
    return view('pages.auth.login-global'); 
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate'])
    ->name('login.authenticate')
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ================= Suatu Kondisi Pendaftaran =================
Route::get('/redirect-pendaftaran', [RedirectPendaftaranController::class, 'index'])
    ->name('redirect.pendaftaran');


// ================= EMAIL VERIFICATION =================

// Halaman notifikasi verifikasi
Route::get('/email/verify', function () {
    return view('pages.auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// Proses klik link dari email
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link verifikasi tidak valid atau sudah rusak.');
    }

    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    Auth::login($user);

    return redirect()->route('formulir')
        ->with('success', 'Email berhasil diverifikasi! Silakan lengkapi formulir.');

})->middleware(['signed'])->name('verification.verify'); 

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ======================================= ROUTE PUBLIC =======================================

// Profile
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/profil/sejarah/{tahun}', [ProfileController::class, 'detailSejarah'])->name('profile.sejarah.detail');
Route::get('/profil/pimpinan/{id}', [ProfileController::class, 'detailPimpinan'])->name('profile.pimpinan.detail');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');

// Program Pendidikan
Route::get('/program-pendidikan', [ProgramPendidikanController::class, 'programPendidikan'])->name('program');

// Pendaftaran
Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');


// ================= LUPA PASSWORD =================
Route::get('/forgot-password', [PasswordResetController::class, 'request'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'email'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])
    ->middleware('guest')
    ->name('password.reset'); 

Route::post('/reset-password', [PasswordResetController::class, 'update'])
    ->middleware('guest')
    ->name('password.update');


// ================= PROTECTED (WAJIB VERIFIKASI) =================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/upload-dokumen', [PendaftaranController::class, 'uploadDokumen'])->name('upload.dokumen');

    Route::get('/formulir', [PendaftaranController::class, 'formulir'])->name('formulir');

    // Isi Formulir
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
    ->name('pendaftaran.store');

    // upload dokumen
    Route::post('/upload-dokumen/store', [PendaftaranController::class, 'storeDokumen'])
    ->name('upload.dokumen.store');
});

// Status Pendaftaran
Route::get('/status-pendaftaran', [StatusPendaftaranController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('status.pendaftaran');
Route::get('/status-pendaftaran/cetak-bukti', [\App\Http\Controllers\Public\StatusPendaftaranController::class, 'cetakBuktiUser'])
    ->name('user.cetak-bukti')
    ->middleware('auth');

// Beranda
Route::get('/', [BerandaController::class, 'index'])->name('home');


// ================= ADMIN PANEL =================
Route::prefix('admin')->middleware(['auth', 'verified', CheckActiveStatus::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->name('admin.dashboard');

    // Data Pendaftar

    Route::get('/data-pendaftar/{id}', [AdminDataPendaftarController::class, 'show'])
    ->name('admin.pendaftar.detail');


    // ================= BERITA =================
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
    Route::post('/berita/simpan', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');


    // ================= GALERI =================
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri');
    Route::post('/galeri/store', [AdminGaleriController::class, 'store'])->name('admin.galeri.store');
    Route::put('/galeri/update/{id}', [AdminGaleriController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/galeri/destroy/{id}', [AdminGaleriController::class, 'destroy'])->name('admin.galeri.destroy');
    Route::post('/galeri/kategori', [AdminGaleriController::class, 'storeKategori'])->name('admin.galeri.kategori.store');

    // Profil Pondok - Sejarah
    Route::get('/profil-pondok', [AdminProfilController::class, 'index'])->name('admin.profil.index');

    // Profil Pondok - Fasilitas
    Route::put('/admin/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'updateFasilitas'])->name('admin.profil.fasilitas.update');
    Route::delete('/admin/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'destroyFasilitas'])->name('admin.profil.fasilitas.destroy');
    Route::post('/admin/profil-pondok/fasilitas/store', [AdminProfilController::class, 'storeFasilitas'])->name('admin.profil.fasilitas.store');
    Route::put('/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'updateFasilitas'])->name('admin.profil.fasilitas.update');
    Route::delete('/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'destroyFasilitas'])->name('admin.profil.fasilitas.destroy');

    // Profil Pondok - Video
    Route::post('/profil-pondok/video/store', [AdminVideoPondokController::class, 'store'])->name('admin.video.store');
    Route::delete('/profil-pondok/video/hapus/{id}', [AdminVideoPondokController::class, 'destroy'])->name('admin.video.hapus');
    Route::put('/profil-pondok/video/update/{id}', [AdminVideoPondokController::class, 'update'])->name('admin.video.update');

    // Program Pendidikan
    Route::get('/program-pendidikan', [AdminProgramController::class, 'programPendidikan'])
    ->name('admin.program');

    Route::post('/program-pendidikan', [AdminProgramController::class, 'store'])
    ->name('program.store');

    Route::put('/program-pendidikan/{id}', [AdminProgramController::class, 'update'])
    ->name('admin.program.update');
    
    Route::delete('/program-pendidikan/{id}', [AdminProgramController::class, 'destroy']);

    // Biaya
    // Route::get('/biaya', [AdminBiayaController::class, 'index'])
    //  ->name('admin.biaya');
    // Route::put('/biaya/{id}', [AdminBiayaController::class, 'update'])
    // ->name('admin.biaya.update');
    // Route::delete('/biaya/{id}', [AdminBiayaController::class, 'destroy'])
    // ->name('admin.biaya.destroy');
    // Route::post('/biaya', [AdminBiayaController::class, 'store'])
    // ->name('admin.biaya.store');

    // ================= PENGATURAN BANNER =================
    Route::get('/banner', [App\Http\Controllers\Admin\AdminBannerController::class, 'index'])->name('admin.banner');
    Route::post('/banner/store', [App\Http\Controllers\Admin\AdminBannerController::class, 'store'])->name('admin.banner.store');
    Route::delete('/banner/destroy/{id}', [App\Http\Controllers\Admin\AdminBannerController::class, 'destroy'])->name('admin.banner.destroy');

    // KONTAK
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('admin.kontak');
    Route::post('/kontak', [AdminKontakController::class, 'store'])->name('admin.kontak.store');
    Route::put('/kontak/{id}', [AdminKontakController::class, 'update'])->name('admin.kontak.update');
    Route::delete('/kontak/{id}', [AdminKontakController::class, 'destroy'])->name('admin.kontak.destroy');

   // ================= JADWAL PENDAFTARAN =================
    // Route::get('/jadwal-pendaftaran', [AdminJadwalController::class, 'index'])->name('admin.jadwal');
    // Route::post('/jadwal-pendaftaran/toggle', [AdminJadwalController::class, 'toggle'])->name('admin.jadwal.toggle');
    // Route::post('/jadwal-pendaftaran/atur-waktu', [AdminJadwalController::class, 'aturWaktu'])->name('admin.jadwal.waktu');
    // Route::put('/jadwal-pendaftaran/{id}', [AdminJadwalController::class, 'update'])->name('admin.jadwal.update');

    // ================= PERSYARATAN PENDAFTARAN =================
    // Route::get('/persyaratan-pendaftaran', [\App\Http\Controllers\Admin\AdminPersyaratanController::class, 'index'])->name('admin.persyaratan');
    // Route::put('/persyaratan-pendaftaran/{id}', [\App\Http\Controllers\Admin\AdminPersyaratanController::class, 'update'])->name('admin.persyaratan.update');
    
    // ================= PERIODE PENDAFTARAN =================
    Route::get('/periode-pendaftaran', [App\Http\Controllers\Admin\PeriodePendaftaranController::class, 'index'])->name('admin.periode');
    Route::post('/periode-pendaftaran/store', [App\Http\Controllers\Admin\PeriodePendaftaranController::class, 'store'])->name('admin.periode.store');
    Route::put('/periode-pendaftaran/{id}', [App\Http\Controllers\Admin\PeriodePendaftaranController::class, 'update'])->name('admin.periode.update');
    Route::delete('/periode-pendaftaran/{id}', [App\Http\Controllers\Admin\PeriodePendaftaranController::class, 'destroy'])->name('admin.periode.destroy');

    // ================= EDIT PROFIL ADMIN =================
    Route::get('/profil', [AdminEditProfilController::class, 'index'])->name('admin.profil');
    Route::post('/profil', [AdminEditProfilController::class, 'update'])->name('admin.profil.update');

    // ================ DATA PENDAFTAR ====================
    Route::get('/data-pendaftar/export-excel', [AdminDataPendaftarController::class, 'exportExcel'])->name('admin.pendaftar.exportExcel');
    Route::get('/data-pendaftar/export-pdf', [AdminDataPendaftarController::class, 'exportPDF'])->name('admin.pendaftar.exportPDF');
    Route::get('/data-pendaftar/{id}', [AdminDataPendaftarController::class, 'show'])->whereNumber('id')->name('admin.pendaftar.detail');
    Route::get('/data-pendaftar', [AdminDataPendaftarController::class, 'index'])->name('admin.pendaftar');
    Route::put('/data-pendaftar/{id}/status', [AdminDataPendaftarController::class, 'updateStatus'])->name('admin.pendaftar.updateStatus');
    Route::get('/admin/data-pendaftar/{id}/cetak-bukti', [\App\Http\Controllers\Admin\AdminDataPendaftarController::class, 'cetakBukti'])
    ->name('admin.pendaftar.cetak-bukti');
   

    // ================ AKTIVITAS SANTRI  ====================
    Route::post('/aktivitas-santri', [AdminAktivitasSantriController::class, 'store'])->name('admin.aktivitas.store');
    Route::put('/aktivitas-santri/{id}', [AdminAktivitasSantriController::class, 'update'])->name('admin.aktivitas.update');
    Route::delete('/aktivitas-santri/{id}', [AdminAktivitasSantriController::class, 'destroy'])->name('admin.aktivitas.delete');

});


// ================= PIMPINAN / SUPER ADMIN PANEL =================
Route::prefix('pimpinan')->middleware(['auth', 'verified'])->group(function () {

    // Laporan Pendaftaran
    Route::get('/laporan', [LaporanPimpinanController::class, 'index'])->name('pimpinan.laporan');

    // Manajemen Admin
    Route::get('/admin', [AdminManagementController::class, 'index'])->name('pimpinan.admin.index');
    Route::post('/admin/store', [AdminManagementController::class, 'store'])->name('pimpinan.admin.store');
    Route::put('/admin/{id}/toggle-status', [AdminManagementController::class, 'toggleStatus'])->name('pimpinan.admin.toggle');
});