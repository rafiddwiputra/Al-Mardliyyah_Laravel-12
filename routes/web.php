<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

// Controllers (Public & Auth)
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\ProgramPendidikanController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\PendaftaranController;
use App\Http\Controllers\Public\StatusPendaftaranController;
use App\Http\Controllers\Public\RedirectPendaftaranController;

// Controllers (Admin)
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminGaleriController;
use App\Http\Controllers\Admin\AdminProfilController;
use App\Http\Controllers\Admin\AdminVideoPondokController;
use App\Http\Controllers\Admin\AdminProgramController;
use App\Http\Controllers\Admin\AdminKontakController;
use App\Http\Controllers\Admin\PeriodePendaftaranController;
use App\Http\Controllers\Admin\AdminEditProfilController;
use App\Http\Controllers\Admin\AdminDataPendaftarController;
use App\Http\Controllers\Admin\AdminAktivitasSantriController;
use App\Http\Controllers\Admin\AdminBannerController; // Dipanggil langsung dari path sebelumnya

// Controllers (Pimpinan)
use App\Http\Controllers\Pimpinan\PimpinanDashboardController;
use App\Http\Controllers\Pimpinan\LaporanPimpinanController;
use App\Http\Controllers\Pimpinan\AdminManagementController;
use App\Http\Controllers\Pimpinan\PimpinanEditProfilController;
use App\Http\Controllers\Pimpinan\PendaftarPimpinanController;

// Middleware
use App\Http\Middleware\CheckActiveStatus;

// ==============================================================================
// 1. REGISTER, LOGIN & AUTHENTICATION
// ==============================================================================

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/redirect-pendaftaran', [RedirectPendaftaranController::class, 'index'])->name('redirect.pendaftaran');

// --- Lupa Password ---
Route::get('/forgot-password', [PasswordResetController::class, 'request'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'email'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])->middleware('guest')->name('password.update');

// ==============================================================================
// 2. EMAIL VERIFICATION
// ==============================================================================

Route::get('/email/verify', function () {
    return view('pages.auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Link verifikasi tidak valid atau sudah rusak.');
    }
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    Auth::login($user);
    return redirect()->route('formulir')->with('success', 'Email berhasil diverifikasi! Silakan lengkapi formulir.');
})->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ==============================================================================
// 3. ROUTE PUBLIC (LANDING PAGE)
// ==============================================================================

Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/profil/sejarah/{tahun}', [ProfileController::class, 'detailSejarah'])->name('profile.sejarah.detail');
Route::get('/profil/pimpinan/{id}', [ProfileController::class, 'detailPimpinan'])->name('profile.pimpinan.detail');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::get('/program-pendidikan', [ProgramPendidikanController::class, 'programPendidikan'])->name('program');
Route::get('/pendaftaran', [PendaftaranController::class, 'pendaftaran'])->name('pendaftaran');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

// ==============================================================================
// 4. PROTECTED ROUTE (SANTRI / CALON PENDAFTAR)
// ==============================================================================

Route::middleware(['auth', 'verified'])->group(function () {
    // Pendaftaran & Dokumen
    Route::get('/formulir', [PendaftaranController::class, 'formulir'])->name('formulir');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/upload-dokumen', [PendaftaranController::class, 'uploadDokumen'])->name('upload.dokumen');
    Route::post('/upload-dokumen/store', [PendaftaranController::class, 'storeDokumen'])->name('upload.dokumen.store');
    
    // Status Pendaftaran
    Route::get('/status-pendaftaran', [StatusPendaftaranController::class, 'index'])->name('status.pendaftaran');
    Route::get('/status-pendaftaran/cetak-bukti', [StatusPendaftaranController::class, 'cetakBuktiUser'])->name('user.cetak-bukti');

    // Akses Dokumen Privat
    Route::get('/dokumen/{folder}/{nama}', function ($folder, $nama) {
        $path = storage_path('app/private/dokumen/' . $folder . '/' . $nama);
        
        // Cek apakah file ada
        if (!file_exists($path)) {
            return response('File tidak ditemukan di brankas!', 404);
        }

        // Ambil stempel resmi (Mime Type) dari file tersebut (contoh: image/png, image/jpeg)
        $mime = mime_content_type($path);

        // Kirim file ke browser dengan stempel resmi dan perintah dilarang simpan cache
        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    })->name('dokumen.show');
});

// ==============================================================================
// 5. ADMIN PANEL
// ==============================================================================

Route::prefix('admin')->middleware(['auth', 'verified', CheckActiveStatus::class, 'role:admin'])->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // ✅ TAMBAHKAN RUTE KHUSUS DOKUMEN ADMIN DI SINI
        Route::get('/dokumen/{folder}/{nama}', function ($folder, $nama) {
            $path = storage_path('app/private/dokumen/' . $folder . '/' . $nama);
            
            if (!file_exists($path)) {
                return response('Gambar tidak ditemukan di brankas server!', 404);
            }

            // Paksa browser mengenali ini sebagai gambar murni
            $mime = mime_content_type($path);
            return response()->file($path, [
                'Content-Type' => $mime,
                'Cache-Control' => 'no-cache, no-store, must-revalidate'
            ]);
        })->name('admin.dokumen.show');

    // Berita
    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('admin.berita');
    Route::post('/berita/simpan', [AdminBeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Galeri
    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('admin.galeri');
    Route::post('/galeri/store', [AdminGaleriController::class, 'store'])->name('admin.galeri.store');
    Route::put('/galeri/update/{id}', [AdminGaleriController::class, 'update'])->name('admin.galeri.update');
    Route::delete('/galeri/destroy/{id}', [AdminGaleriController::class, 'destroy'])->name('admin.galeri.destroy');
    Route::post('/galeri/kategori', [AdminGaleriController::class, 'storeKategori'])->name('admin.galeri.kategori.store');

    // Profil Pondok (Sejarah, Fasilitas, Video)
    Route::get('/profil-pondok', [AdminProfilController::class, 'index'])->name('admin.profil.index');
    Route::post('/profil-pondok/fasilitas/store', [AdminProfilController::class, 'storeFasilitas'])->name('admin.profil.fasilitas.store');
    Route::put('/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'updateFasilitas'])->name('admin.profil.fasilitas.update');
    Route::delete('/profil-pondok/fasilitas/{id}', [AdminProfilController::class, 'destroyFasilitas'])->name('admin.profil.fasilitas.destroy');
    Route::post('/profil-pondok/video/store', [AdminVideoPondokController::class, 'store'])->name('admin.video.store');
    Route::put('/profil-pondok/video/update/{id}', [AdminVideoPondokController::class, 'update'])->name('admin.video.update');
    Route::delete('/profil-pondok/video/hapus/{id}', [AdminVideoPondokController::class, 'destroy'])->name('admin.video.hapus');

    // Program Pendidikan
    Route::get('/program-pendidikan', [AdminProgramController::class, 'programPendidikan'])->name('admin.program');
    Route::post('/program-pendidikan', [AdminProgramController::class, 'store'])->name('program.store');
    Route::put('/program-pendidikan/{id}', [AdminProgramController::class, 'update'])->name('admin.program.update');
    Route::delete('/program-pendidikan/{id}', [AdminProgramController::class, 'destroy'])->name('admin.program.destroy');

    // Banner
    Route::get('/banner', [AdminBannerController::class, 'index'])->name('admin.banner');
    Route::post('/banner/store', [AdminBannerController::class, 'store'])->name('admin.banner.store');
    Route::delete('/banner/destroy/{id}', [AdminBannerController::class, 'destroy'])->name('admin.banner.destroy');

    // Kontak
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('admin.kontak');
    Route::post('/kontak', [AdminKontakController::class, 'store'])->name('admin.kontak.store');
    Route::put('/kontak/{id}', [AdminKontakController::class, 'update'])->name('admin.kontak.update');
    Route::delete('/kontak/{id}', [AdminKontakController::class, 'destroy'])->name('admin.kontak.destroy');

    // Periode Pendaftaran
    Route::get('/periode-pendaftaran', [PeriodePendaftaranController::class, 'index'])->name('admin.periode');
    Route::post('/periode-pendaftaran/store', [PeriodePendaftaranController::class, 'store'])->name('admin.periode.store');
    Route::put('/periode-pendaftaran/{id}', [PeriodePendaftaranController::class, 'update'])->name('admin.periode.update');
    Route::delete('/periode-pendaftaran/{id}', [PeriodePendaftaranController::class, 'destroy'])->name('admin.periode.destroy');

    // Data Pendaftar
    Route::get('/data-pendaftar', [AdminDataPendaftarController::class, 'index'])->name('admin.pendaftar');
    Route::get('/data-pendaftar/export-excel', [AdminDataPendaftarController::class, 'exportExcel'])->name('admin.pendaftar.exportExcel');
    Route::get('/data-pendaftar/export-pdf', [AdminDataPendaftarController::class, 'exportPDF'])->name('admin.pendaftar.exportPDF');
    Route::get('/data-pendaftar/{id}', [AdminDataPendaftarController::class, 'show'])->whereNumber('id')->name('admin.pendaftar.detail');
    Route::put('/data-pendaftar/{id}/status', [AdminDataPendaftarController::class, 'updateStatus'])->name('admin.pendaftar.updateStatus');
    Route::get('/data-pendaftar/{id}/cetak-bukti', [AdminDataPendaftarController::class, 'cetakBukti'])->name('admin.pendaftar.cetak-bukti');

    // Aktivitas Santri
    Route::post('/aktivitas-santri', [AdminAktivitasSantriController::class, 'store'])->name('admin.aktivitas.store');
    Route::put('/aktivitas-santri/{id}', [AdminAktivitasSantriController::class, 'update'])->name('admin.aktivitas.update');
    Route::delete('/aktivitas-santri/destroy/{id}', [AdminAktivitasSantriController::class, 'destroy'])->name('admin.aktivitas.delete');

    // Profil Admin
    Route::get('/profil', [AdminEditProfilController::class, 'index'])->name('admin.profil');
    Route::post('/profil', [AdminEditProfilController::class, 'update'])->name('admin.profil.update');
});

// ==============================================================================
// 6. PIMPINAN PANEL
// ==============================================================================

Route::prefix('pimpinan')->middleware(['auth', 'verified', CheckActiveStatus::class, 'role:pimpinan'])->group(function () {
    
    Route::get('/dashboard', [PimpinanDashboardController::class, 'index'])->name('pimpinan.dashboard');

    // Laporan
    Route::get('/laporan', [LaporanPimpinanController::class, 'index'])->name('pimpinan.laporan');
    Route::get('/laporan/export-excel', [LaporanPimpinanController::class, 'exportExcel'])->name('pimpinan.laporan.exportExcel');
    Route::get('/laporan/export-pdf', [LaporanPimpinanController::class, 'exportPDF'])->name('pimpinan.laporan.exportPDF');

    // Data Pendaftar (Read-Only)
    Route::get('/pendaftar', [PendaftarPimpinanController::class, 'index'])->name('pimpinan.pendaftar');
    Route::get('/pendaftar/{id}', [PendaftarPimpinanController::class, 'detail'])->name('pimpinan.pendaftar.detail');

    // Manajemen Admin
    Route::get('/admin', [AdminManagementController::class, 'index'])->name('pimpinan.admin.index');
    Route::post('/admin/store', [AdminManagementController::class, 'store'])->name('pimpinan.admin.store');
    Route::put('/admin/{id}/toggle-status', [AdminManagementController::class, 'toggleStatus'])->name('pimpinan.admin.toggle');

    // Profil Pimpinan
    // Rute untuk menampilkan halaman profil
    Route::get('/profil', [App\Http\Controllers\Pimpinan\PimpinanEditProfilController::class, 'index'])->name('pimpinan.profil');

// Rute untuk menyimpan perubahan nama/foto (Ini yang tadi hilang/salah nama!)
    Route::post('/profil/update', [App\Http\Controllers\Pimpinan\PimpinanEditProfilController::class, 'update'])->name('pimpinan.profil.update');

// Rute untuk mengganti password (yang baru saja kita buat)
    Route::post('/profil/update-password', [App\Http\Controllers\Pimpinan\PimpinanEditProfilController::class, 'updatePassword'])->name('pimpinan.profil.update-password');
});