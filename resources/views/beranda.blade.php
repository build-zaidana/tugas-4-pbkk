@extends('layouts.app')

@section('title', 'Beranda')
@section('eyebrow', 'Portal Akademik · PBKK Pertemuan 4')
@section('heading', 'Belajar merakit web yang rapi sejak lapisan tampilan.')
@section('subheading', 'Mini-website akademik pribadi: profil diri, rancangan platform Agentic AI, dan formulir pengumpulan ide — seluruhnya mewarisi satu master layout.')

@section('content')
    {{-- Tantangan 2: sapaan dinamis dari parameter ?user= --}}
    @if ($sapaan)
        <x-status-banner tipe="sukses" judul="Selamat datang, {{ $sapaan }}." class="mb-10">
            Nama ini dibaca dari parameter kueri <code class="font-mono text-xs">?user={{ $sapaan }}</code>
            lalu dirender komponen <code class="font-mono text-xs">&lt;x-status-banner&gt;</code>.
        </x-status-banner>
    @else
        <x-status-banner tipe="info" judul="Belum ada pengguna yang dikenali." class="mb-10">
            Tambahkan <code class="font-mono text-xs">?user=Andi</code> pada alamat halaman ini
            untuk melihat sapaan dinamis bekerja.
        </x-status-banner>
    @endif

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Nama" :nilai="$profil['nama']" sorot />
        <x-info-card label="NRP" :nilai="$profil['nrp']" catatan="Angkatan {{ $profil['angkatan'] }}" />
        <x-info-card label="Program Studi" :nilai="$profil['prodi']" :catatan="$profil['fakultas']" />
    </div>

    <h2 class="display mt-16 mb-5 text-3xl">Jelajahi</h2>

    <div class="grid gap-4 sm:grid-cols-2">
        {{-- Info-card dipakai lewat slot, bukan atribut nilai. --}}
        <x-info-card label="Halaman">
            <ul class="space-y-2 font-sans text-base">
                <li>
                    <a href="{{ route('profil.mahasiswa') }}" class="text-accent underline-offset-4 hover:underline">
                        Profil Mahasiswa
                    </a>
                    <span class="text-sm text-ink-soft">&mdash; data diri dan riwayat studi</span>
                </li>
                <li>
                    <a href="{{ route('ide.agent') }}" class="text-accent underline-offset-4 hover:underline">
                        Ide Riset Agentic AI
                    </a>
                    <span class="text-sm text-ink-soft">&mdash; rancangan platform dan formulir</span>
                </li>
            </ul>
        </x-info-card>

        <x-info-card label="Tantangan A+">
            <ul class="space-y-2 font-sans text-base">
                <li>
                    <a href="{{ route('beranda', ['user' => 'Andi']) }}" class="text-accent underline-offset-4 hover:underline">
                        Sapaan dinamis
                    </a>
                    <span class="font-mono text-xs text-ink-soft">/?user=Andi</span>
                </li>
                <li>
                    <a href="{{ route('ide.agent', ['mode' => 'dark']) }}" class="text-accent underline-offset-4 hover:underline">
                        Mode gelap
                    </a>
                    <span class="font-mono text-xs text-ink-soft">/ide-agent?mode=dark</span>
                </li>
            </ul>
        </x-info-card>
    </div>
@endsection
