<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Repositori Tugas
    |--------------------------------------------------------------------------
    |
    | Dipakai halaman Laporan untuk menautkan tiap butir spesifikasi ke berkas
    | buktinya di GitHub. Bila dikosongkan, halaman tetap berjalan dan hanya
    | menampilkan penampil berkas bawaan aplikasi.
    |
    */

    'repo' => env('TUGAS_REPO_URL'),

    'branch' => env('TUGAS_REPO_BRANCH', 'main'),

];
