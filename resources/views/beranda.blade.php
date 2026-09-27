@extends('layouts.app')

@section('title', 'Beranda')
@section('heading', 'Beranda')
@section('subheading', 'Portal akademik pribadi untuk Tugas Mandiri PBKK Pertemuan 4')

@section('content')
    {{-- Tantangan 2: sapaan dinamis dari parameter ?user= --}}
    @if ($sapaan)
        <x-status-banner tipe="sukses" judul="Selamat datang, {{ $sapaan }}!" class="mb-6">
            Sapaan ini dibaca dari parameter kueri <code>?user={{ $sapaan }}</code> lalu dirender
            oleh komponen <code>&lt;x-status-banner&gt;</code>.
        </x-status-banner>
    @else
        <x-status-banner tipe="info" judul="Belum ada pengguna yang dikenali" class="mb-6">
            Tambahkan parameter <code>?user=Andi</code> pada alamat halaman ini untuk melihat
            sapaan dinamis bekerja.
        </x-status-banner>
    @endif

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Nama" :nilai="$profil['nama']" sorot />
        <x-info-card label="NRP" :nilai="$profil['nrp']" catatan="Angkatan {{ $profil['angkatan'] }}" />
        <x-info-card label="Program Studi" :nilai="$profil['prodi']" :catatan="$profil['fakultas']" />
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2">
        {{-- Penggunaan info-card lewat slot, bukan atribut nilai. --}}
        <x-info-card label="Halaman Tersedia">
            <ul class="space-y-1 text-base font-normal">
                <li>
                    <a href="{{ route('profil.mahasiswa') }}" class="text-sky-700 hover:underline dark:text-sky-400">
                        Profil Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('ide.agent') }}" class="text-sky-700 hover:underline dark:text-sky-400">
                        Ide Riset Agentic AI
                    </a>
                </li>
            </ul>
        </x-info-card>

        <x-info-card label="Coba Tantangan">
            <ul class="space-y-1 text-base font-normal">
                <li>
                    <a href="{{ route('beranda', ['user' => 'Andi']) }}" class="text-sky-700 hover:underline dark:text-sky-400">
                        Sapaan dinamis
                    </a>
                    <span class="text-sm text-slate-500 dark:text-slate-400">&mdash; /?user=Andi</span>
                </li>
                <li>
                    <a href="{{ route('ide.agent', ['mode' => 'dark']) }}" class="text-sky-700 hover:underline dark:text-sky-400">
                        Mode gelap
                    </a>
                    <span class="text-sm text-slate-500 dark:text-slate-400">&mdash; /ide-agent?mode=dark</span>
                </li>
            </ul>
        </x-info-card>
    </div>
@endsection
