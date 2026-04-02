<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= ROUTE DEFAULT =================
Route::get('/', function () {
    return view('welcome');
});


// ================= ROUTE AUTH (Register & Login) =================
Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');


// ================= ROUTE PUBLIC 

// Route Profile
Route::get('/profil', function () {
    // Sesuai folder: resources/views/pages/public/profile.blade.php
      return view('pages.public.profile.index');
})->name('profile');

// Route detail-sejarah.blade.php
Route::get('/profil/sejarah/{tahun}', function ($tahun) {
    // 1. Siapkan data dummy dalam bentuk array besar (simulasi database)
    $semuaSejarah = [
        '1985' => [
            'judul' => 'Pendirian Pondok',
            'gambar' => 'images/sejarah-1985.png',
            'deskripsi' => [
                'Pondok Pesantren Al-Mardliyyah didirikan dengan santri perdana...',
                'Pada masa awal berdirinya...',
                'Seiring berjalannya waktu...'
            ]
        ],
        '1992' => [
            'judul' => 'Pembangunan Masjid Utama',
            'gambar' => 'images/pembangunan-masjid.png',
            'deskripsi' => [
                'Tahun 1992 menjadi tonggak sejarah dengan dibangunnya masjid...',
                'Masjid ini menjadi pusat gravitasi kegiatan santri...'
            ]
        ],
        // Tambahkan tahun lainnya (2000, 2010, dst) di sini sesuai kebutuhan
    ];

    // 2. Ambil data spesifik berdasarkan tahun yang diklik
    // Jika tahun tidak ada di array, kita kasih default ke 1985 agar tidak error
    $sejarah = $semuaSejarah[$tahun] ?? $semuaSejarah['1985'];

    // 3. Kirim data ke view (Compact akan mengirim variabel $tahun yang asli dari URL)
    return view('pages.public.profile.detail-sejarah', compact('sejarah', 'tahun'));
})->name('profile.sejarah.detail');

// Route detail-pimpinan.blade.php
Route::get('/profil/pimpinan/1', function () {
    $pimpinan = [
        'nama' => 'KH. Ahmad Fauzi',
        'tanggal' => '12 Januari 2026',
        'gambar' => 'images/pimpinan-1.png', // Pastikan file gambar ada di public/images/
        'deskripsi' => [
            'KH. Ahmad Fauzi merupakan pengasuh utama yang telah membimbing Pondok Pesantren Al-Mardliyyah selama lebih dari tiga dekade. Dengan visi membentuk generasi yang tidak hanya cerdas secara intelektual, tetapi juga memiliki kedalaman akhlak dan spiritual.',
            'Beliau menempuh pendidikan di berbagai pesantren ternama di Jawa sebelum akhirnya mendedikasikan hidupnya untuk mengembangkan pendidikan Islam di Madiun. Kepemimpinan beliau dikenal sangat mengayomi, baik bagi para ustadz maupun seluruh santri.',
            'Selain aktif di lingkungan pesantren, beliau juga sering mengisi kajian-kajian keislaman di masyarakat luas, membawa pesan Islam yang damai dan moderat sesuai dengan prinsip Ahlussunnah wal Jamaah.'
        ]
    ];

    return view('pages.public.profile.detail-pimpinan', compact('pimpinan'));
})->name('profile.pimpinan.detail');


// ================= ROUTE ADMIN PANEL =================
// Jangan lupa bagian ini agar sidebar & topbar admin bisa tampil
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        // Sesuai folder: resources/views/pages/admin/dashboard.blade.php
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');
});