# Portal Akademik Multi-View — Tugas Mandiri PBKK Pertemuan 4

Mini-website akademik pribadi berbasis Blade layout inheritance, komponen kustom,
dan bundling aset lewat Vite.

| | |
|---|---|
| **Nama** | Adrian Afzal Zaidana |
| **NRP** | 5025241151 |
| **Departemen** | Teknik Informatika, FTEIC — ITS Surabaya |
| **Stack** | Laravel 12 · PHP 8.4 · Tailwind CSS 4 · Vite 8 |

## Menjalankan Aplikasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run build
php artisan serve
```

Aplikasi terbuka di `http://127.0.0.1:8000`.

> `npm run build` wajib dijalankan sebelum `php artisan serve`, karena seluruh CSS
> dikompilasi Vite dan tidak ada satu pun tautan CDN. Selama pengembangan bisa
> dipakai `npm run dev` di terminal terpisah.

## Daftar Rute

Semua rute diarahkan ke satu [`PageController`](app/Http/Controllers/PageController.php).

| Metode | URI | Nama rute | Keterangan |
|---|---|---|---|
| GET | `/` | `beranda` | Halaman Beranda |
| GET | `/beranda` | `beranda.alias` | Alias agar URL tantangan `/beranda?user=Andi` dapat diakses |
| GET | `/profil-mahasiswa` | `profil.mahasiswa` | Data diri dan riwayat studi |
| GET | `/ide-agent` | `ide.agent` | Rancangan platform Agentic AI dan formulir ide |
| POST | `/ide-agent` | `ide.simpan` | Memproses formulir pengumpulan ide |
| GET | `/laporan` | `laporan` | Rekap pengerjaan tugas, dipakai saat sesi live demo |

## Pemenuhan Spesifikasi

| Ketentuan | Penerapan |
|---|---|
| Master layout terpusat | [`resources/views/layouts/app.blade.php`](resources/views/layouts/app.blade.php) — title dinamis, navbar statis, container, footer ITS |
| Tiga halaman anak | `beranda`, `profil`, `ide` — seluruhnya `@extends('layouts.app')`, nol duplikasi struktur HTML |
| Satu PageController | Lima rute, satu controller |
| Komponen `<x-info-card>` | [`components/info-card.blade.php`](resources/views/components/info-card.blade.php) — attributes `label`, `nilai`, `catatan`, `sorot`, plus slot |
| Komponen `<x-status-banner>` | [`components/status-banner.blade.php`](resources/views/components/status-banner.blade.php) — attributes `tipe`, `judul`, plus slot |
| Vite + NPM | Tailwind CSS 4 lewat `@tailwindcss/vite`; font Instrument Sans ikut di-*self-host* sebagai `.woff2` lokal |
| Tanpa CDN | Nol tautan eksternal pada HTML hasil render |

## Tantangan A+

**Tantangan 1 — Toggle tema dinamis.** Buka `/ide-agent?mode=dark`.

Controller membaca parameter kueri menjadi variabel Blade `$gelap`, yang dipasang
sebagai class pada elemen root:

```blade
<html lang="id" class="{{ $gelap ? 'dark' : '' }}">
```

Varian `dark:` Tailwind dibuat berbasis class, bukan `prefers-color-scheme`, lewat
`@custom-variant dark` di [`resources/css/app.css`](resources/css/app.css), sehingga
seluruh komponen ikut berubah dari satu variabel PHP.

**Tantangan 2 — Alert status interaktif.** Buka `/beranda?user=Andi`.

Nama dari parameter kueri diteruskan ke `<x-status-banner>` dan tampil sebagai
sapaan. Tanpa parameter, banner berubah menjadi petunjuk pemakaian.

## Formulir Pengumpulan Ide

Formulir di halaman Ide Riset mengirim POST ber-CSRF, divalidasi di controller,
lalu hasilnya dikembalikan sebagai pesan flash yang dirender `<x-status-banner>`.
Penyimpanan ke basis data belum dilakukan karena materinya baru dibahas pada
pertemuan berikutnya.

## Catatan

Nilai IP pada riwayat studi di `PageController::riwayatStudi()` masih berupa data contoh.
