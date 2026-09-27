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
