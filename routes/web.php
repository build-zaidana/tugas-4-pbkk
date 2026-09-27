<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tugas Mandiri Pertemuan 4 - Aplikasi Multi-View Profil Akademik
| Nama : Adrian Afzal Zaidana
| NRP  : 5025241151
|--------------------------------------------------------------------------
| Ketiga halaman wajib diarahkan ke satu PageController dan mewarisi
| layouts/app.blade.php.
*/

// Halaman 1: Beranda.
Route::get('/', [PageController::class, 'beranda'])->name('beranda');

// Alias agar URL Tantangan 2 (/beranda?user=Andi) dapat diakses persis
// seperti yang tertulis di soal.
Route::get('/beranda', [PageController::class, 'beranda'])->name('beranda.alias');

// Halaman 2: Profil Mahasiswa.
Route::get('/profil-mahasiswa', [PageController::class, 'profil'])->name('profil.mahasiswa');

// Halaman 3: Ide Riset platform Agentic AI.
Route::get('/ide-agent', [PageController::class, 'ideAgent'])->name('ide.agent');

// Pengiriman formulir pengumpulan ide.
Route::post('/ide-agent', [PageController::class, 'simpanIde'])->name('ide.simpan');

// Halaman 4: rekap pengerjaan tugas, dipakai saat sesi live demo.
Route::get('/laporan', [PageController::class, 'laporan'])->name('laporan');

/*
|--------------------------------------------------------------------------
| Halaman lanjutan yang dipertahankan dari Pertemuan 2
|--------------------------------------------------------------------------
| Isinya tetap, hanya tampilannya mengikuti master layout dan komponen baru.
*/

Route::get('/riwayat-studi', [PageController::class, 'riwayat'])->name('riwayat');

Route::get('/tentang-departemen', [PageController::class, 'tentang'])->name('tentang');

Route::get('/rencana-tugas-akhir', [PageController::class, 'tugasAkhir'])->name('tugas.akhir');

// Kalkulator IP: parameter dibatasi rentang nilai yang sah, 0 sampai 4.00.
Route::get('/kalkulator-ip/{ip1}/{ip2}', [PageController::class, 'kalkulatorIp'])
    ->where([
        'ip1' => '([0-3](\.[0-9]{1,2})?|4(\.0{1,2})?)',
        'ip2' => '([0-3](\.[0-9]{1,2})?|4(\.0{1,2})?)',
    ])
    ->name('kalkulator.ip');

// Kalkulator dinamis tiga parameter.
Route::get('/kalkulator/{angka1}/{angka2}/{operasi}', [PageController::class, 'kalkulator'])
    ->where(['angka1' => '[0-9]+', 'angka2' => '[0-9]+'])
    ->name('kalkulator.dinamis');

// Penampil berkas bukti. Kuncinya dibatasi allowlist di controller, sehingga
// rute ini tidak bisa dipakai membaca berkas sembarangan.
Route::get('/laporan/berkas/{kunci}', [PageController::class, 'berkas'])
    ->where('kunci', '[a-z-]+')
    ->name('laporan.berkas');
