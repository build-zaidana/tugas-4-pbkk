@extends('layouts.app')

@section('title', 'Ide Riset Agentic AI')
@section('heading', 'Ide Riset Agentic AI')
@section('subheading', 'Rancangan platform dan formulir pengumpulan ide')

@section('content')
    {{-- Tantangan 1: pemilih mode gelap lewat parameter rute --}}
    <div class="mb-6 flex flex-wrap items-center gap-2">
        <span class="text-sm text-slate-500 dark:text-slate-400">Tampilan:</span>

        <a href="{{ route('ide.agent') }}"
           class="rounded-md border px-3 py-1.5 text-sm font-medium transition
                  {{ ! $gelap
                      ? 'border-sky-600 bg-sky-600 text-white'
                      : 'border-slate-700 text-slate-300 hover:bg-slate-800' }}">
            Mode Terang
        </a>

        <a href="{{ route('ide.agent', ['mode' => 'dark']) }}"
           class="rounded-md border px-3 py-1.5 text-sm font-medium transition
                  {{ $gelap
                      ? 'border-sky-500 bg-sky-600 text-white'
                      : 'border-slate-300 text-slate-600 hover:bg-slate-100' }}">
            Mode Gelap
        </a>

        <span class="ml-1 text-xs text-slate-400 dark:text-slate-500">
            Aktif: <code>?mode={{ $gelap ? 'dark' : '(kosong)' }}</code>
        </span>
    </div>

    {{-- Notifikasi hasil pengiriman formulir --}}
    @if (session('sukses'))
        <x-status-banner tipe="sukses" judul="Ide berhasil dikirim" class="mb-6">
            {{ session('sukses') }}
        </x-status-banner>
    @endif

    @if ($errors->any())
        <x-status-banner tipe="galat" judul="Periksa kembali isian Anda" class="mb-6">
            <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $pesan)
                    <li>{{ $pesan }}</li>
                @endforeach
            </ul>
        </x-status-banner>
    @endif

    <h2 class="mb-3 text-lg font-semibold text-slate-900 dark:text-white">
        Modul Platform
    </h2>

    <div class="grid gap-4 sm:grid-cols-2">
        @foreach ($modul as $item)
            <x-info-card :label="$item['peran']" :nilai="$item['nama']" :catatan="$item['rincian']" />
        @endforeach
    </div>

    <h2 class="mt-10 mb-3 text-lg font-semibold text-slate-900 dark:text-white">
        Formulir Pengumpulan Ide
    </h2>

    <form method="POST"
          action="{{ route('ide.simpan', $gelap ? ['mode' => 'dark'] : []) }}"
          class="rounded-xl border border-slate-200 bg-white p-6 dark:border-slate-800 dark:bg-slate-900">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="nama" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Nama Pengusul
                </label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                       class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900
                              focus:border-sky-500 focus:ring-2 focus:ring-sky-200 focus:outline-none
                              dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:ring-sky-900">
            </div>

            <div>
                <label for="judul" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Judul Ide
                </label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                       class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900
                              focus:border-sky-500 focus:ring-2 focus:ring-sky-200 focus:outline-none
                              dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:ring-sky-900">
            </div>
        </div>

        <div class="mt-4">
            <label for="ringkasan" class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">
                Ringkasan Ide
            </label>
            <textarea id="ringkasan" name="ringkasan" rows="4" required
                      class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900
                             focus:border-sky-500 focus:ring-2 focus:ring-sky-200 focus:outline-none
                             dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:focus:ring-sky-900">{{ old('ringkasan') }}</textarea>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Minimal 20 karakter.</p>
        </div>

        <button type="submit"
                class="mt-5 rounded-md bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-sky-700">
            Kirim Ide
        </button>
    </form>
@endsection
