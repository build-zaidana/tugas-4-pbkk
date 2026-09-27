@extends('layouts.app')

@section('title', 'Ide Riset Agentic AI')
@section('eyebrow', 'Rancangan platform')
@section('heading', 'Agentic Web Security Auditor')
@section('subheading', 'Agent otonom yang memetakan permukaan serang sebuah situs, menjalankan security tools, lalu menyusun laporan temuan beserta langkah remediasinya.')

@section('content')
    {{-- Notifikasi hasil pengiriman formulir --}}
    @if (session('sukses'))
        <x-status-banner tipe="sukses" judul="Ide berhasil dikirim." class="mb-10">
            {{ session('sukses') }}
        </x-status-banner>
    @endif

    @if ($errors->any())
        <x-status-banner tipe="galat" judul="Periksa kembali isian Anda." class="mb-10">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $pesan)
                    <li>{{ $pesan }}</li>
                @endforeach
            </ul>
        </x-status-banner>
    @endif

    <p class="mb-5 font-mono text-xs uppercase tracking-[0.16em] text-ink-soft">
        Mode aktif: {{ $gelap ? 'gelap · ?mode=dark' : 'terang · tanpa parameter' }}
    </p>

    <h2 class="display mb-5 text-3xl">Modul Platform</h2>

    <div class="grid gap-4 sm:grid-cols-2">
        @foreach ($modul as $item)
            <x-info-card :label="$item['peran']" :nilai="$item['nama']" :catatan="$item['rincian']" />
        @endforeach
    </div>

    <h2 class="display mt-16 mb-2 text-3xl">Punya ide lain?</h2>
    <p class="mb-6 max-w-[58ch] text-ink-soft">
        Kirimkan lewat formulir berikut. Isiannya divalidasi di controller, lalu hasilnya
        dikembalikan sebagai pesan flash yang dirender komponen status banner.
    </p>

    <form method="POST"
          action="{{ route('ide.simpan', $gelap ? ['mode' => 'dark'] : []) }}"
          class="rounded-2xl border border-line bg-surface p-7">
        @csrf

        @php
            $kelasInput = 'w-full rounded-xl border border-line-strong bg-paper px-4 py-3 text-sm
                           text-ink placeholder:text-ink-soft/60 transition
                           focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/25';
        @endphp

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="nama" class="mb-2 block font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                    Nama Pengusul
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                       placeholder="Nama lengkap" class="{{ $kelasInput }}">
            </div>

            <div>
                <label for="judul" class="mb-2 block font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                    Judul Ide
                </label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                       placeholder="Judul singkat" class="{{ $kelasInput }}">
            </div>
        </div>

        <div class="mt-5">
            <label for="ringkasan" class="mb-2 block font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                Ringkasan Ide
            </label>
            <textarea id="ringkasan" name="ringkasan" rows="4" required
                      placeholder="Jelaskan ide Anda secara ringkas"
                      class="{{ $kelasInput }}">{{ old('ringkasan') }}</textarea>
            <p class="mt-2 text-xs text-ink-soft">Minimal 20 karakter.</p>
        </div>

        <button type="submit"
                class="mt-6 rounded-full bg-accent px-7 py-3 text-sm font-medium text-on-accent
                       transition hover:opacity-90">
            Kirim Ide
        </button>
    </form>
@endsection
