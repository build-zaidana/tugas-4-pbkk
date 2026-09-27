@extends('layouts.app')

@section('title', 'Beranda')

{{-- Beranda memakai hero sendiri, menggantikan kepala halaman bawaan layout. --}}
@section('hero')
    <div class="mb-14 grid items-center gap-12 lg:grid-cols-[1.15fr_0.85fr]">
        <div>
            <p class="mb-4 font-mono text-xs uppercase tracking-[0.18em] text-ink-soft">
                Portal Akademik &middot; PBKK Pertemuan 4
            </p>

            <h1 class="display text-5xl sm:text-6xl lg:text-7xl">
                Halo, saya <span class="text-accent">{{ $profil['nama'] }}</span>.
            </h1>

            <p class="mt-6 max-w-[54ch] text-lg leading-relaxed text-ink-soft">
                Mahasiswa {{ $profil['prodi'] }} ITS semester {{ $profil['semester'] }}.
                Mini-website ini menampung profil diri, rancangan platform Agentic AI,
                dan formulir pengumpulan ide &mdash; seluruhnya mewarisi satu master layout.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('profil.mahasiswa') }}"
                   class="rounded-full bg-accent px-6 py-3 text-sm font-medium text-on-accent transition hover:opacity-90">
                    Lihat Profil
                </a>

                <a href="{{ route('ide.agent') }}"
                   class="rounded-full border border-line-strong px-6 py-3 text-sm text-ink transition hover:border-accent">
                    Rancangan Agentic AI
                </a>

                <a href="{{ route('laporan') }}"
                   class="rounded-full border border-line-strong px-6 py-3 text-sm text-ink-soft transition hover:border-accent hover:text-ink">
                    Laporan Pengerjaan
                </a>
            </div>
        </div>

        {{-- Kartu foto dengan label miring, meniru gaya tape pada portofolio. --}}
        <div class="relative mx-auto w-full max-w-xs">
            <span class="absolute -top-3 -right-4 z-10 -rotate-6 rounded-sm bg-tape px-4 py-1.5
                         font-mono text-[0.65rem] tracking-[0.14em] text-on-tape uppercase shadow-sm">
                Semester {{ $profil['semester'] }} &middot; Aktif
            </span>

            <div class="rotate-2 rounded-3xl border border-line bg-surface p-3 transition duration-300 hover:rotate-0">
                <img src="{{ asset('images/profil.jpg') }}"
                     alt="Pasfoto {{ $profil['nama'] }}"
                     width="640" height="640"
                     class="w-full rounded-2xl object-cover">

                <p class="px-2 py-3 font-hand text-2xl text-accent">
                    {{ $profil['nrp'] }}
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    {{-- Tantangan 2: sapaan dinamis dari parameter ?user= --}}
    @if ($sapaan)
        <x-status-banner tipe="sukses" judul="Selamat datang, {{ $sapaan }}." class="mb-12">
            Nama ini dibaca dari parameter kueri <code class="font-mono text-xs">?user={{ $sapaan }}</code>
            lalu dirender komponen <code class="font-mono text-xs">&lt;x-status-banner&gt;</code>.
        </x-status-banner>
    @else
        <x-status-banner tipe="info" judul="Belum ada pengguna yang dikenali." class="mb-12">
            Tambahkan <code class="font-mono text-xs">?user=Andi</code> pada alamat halaman ini
            untuk melihat sapaan dinamis bekerja.
        </x-status-banner>
    @endif

    {{-- Ringkasan angka --}}
    <div class="mb-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-info-card label="NRP" :nilai="$profil['nrp']" catatan="Angkatan {{ $profil['angkatan'] }}" sorot />
        <x-info-card label="Program Studi" nilai="Teknik Informatika" catatan="Jenjang sarjana" />
        <x-info-card label="Halaman" nilai="4" catatan="Satu master layout" />
        <x-info-card label="Tautan CDN" nilai="0" catatan="Aset dibundel Vite" />
    </div>

    {{-- Kartu besar untuk dua halaman utama --}}
    <h2 class="display mb-6 text-3xl">Jelajahi</h2>

    <div class="mb-16 grid gap-4 lg:grid-cols-2">
        <a href="{{ route('profil.mahasiswa') }}"
           class="group rounded-2xl border border-line bg-surface p-7 transition hover:border-accent/50">
            <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">Halaman 2</p>
            <p class="mt-3 font-serif text-3xl leading-tight tracking-tight text-ink">Profil Mahasiswa</p>
            <p class="mt-3 text-sm leading-relaxed text-ink-soft">
                Identitas akademis, bidang minat, dan rekam jejak perkuliahan per semester.
            </p>
            <span class="mt-5 inline-block font-mono text-xs text-accent transition group-hover:translate-x-1">
                /profil-mahasiswa &rarr;
            </span>
        </a>

        <a href="{{ route('ide.agent') }}"
           class="group rounded-2xl border border-line bg-surface p-7 transition hover:border-accent/50">
            <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">Halaman 3</p>
            <p class="mt-3 font-serif text-3xl leading-tight tracking-tight text-ink">Ide Riset Agentic AI</p>
            <p class="mt-3 text-sm leading-relaxed text-ink-soft">
                Empat modul rancangan platform, dilengkapi formulir pengumpulan ide.
            </p>
            <span class="mt-5 inline-block font-mono text-xs text-accent transition group-hover:translate-x-1">
                /ide-agent &rarr;
            </span>
        </a>
    </div>

    {{-- Pintasan tantangan --}}
    <h2 class="display mb-2 text-3xl">Coba tantangannya</h2>
    <p class="mb-6 max-w-[58ch] text-ink-soft">
        Kedua fitur nilai plus dikendalikan murni lewat parameter pada URL, tanpa JavaScript.
    </p>

    <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-accent/40 bg-accent-tint p-6">
            <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">Tantangan 1</p>
            <p class="mt-3 font-serif text-2xl leading-tight tracking-tight text-ink">Toggle tema dinamis</p>
            <p class="mt-2 text-sm text-ink-soft">Satu parameter membalik seluruh palet halaman.</p>
            <a href="{{ route('ide.agent', ['mode' => 'dark']) }}"
               class="mt-5 inline-block rounded-full border border-accent/50 px-5 py-2 font-mono text-xs text-ink transition hover:bg-accent hover:text-on-accent">
                /ide-agent?mode=dark
            </a>
        </div>

        <div class="rounded-2xl border border-accent/40 bg-accent-tint p-6">
            <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">Tantangan 2</p>
            <p class="mt-3 font-serif text-2xl leading-tight tracking-tight text-ink">Alert status interaktif</p>
            <p class="mt-2 text-sm text-ink-soft">Nama pada URL menjadi sapaan di banner atas.</p>
            <a href="{{ route('beranda', ['user' => 'Andi']) }}"
               class="mt-5 inline-block rounded-full border border-accent/50 px-5 py-2 font-mono text-xs text-ink transition hover:bg-accent hover:text-on-accent">
                /?user=Andi
            </a>
        </div>
    </div>
@endsection
