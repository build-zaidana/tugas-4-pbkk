@extends('layouts.app')

@section('title', 'Kalkulator Dinamis')
@section('eyebrow', 'Tiga parameter rute')
@section('heading', 'Kalkulator Dinamis')
@section('subheading', 'Dua operan dan satu operasi dibaca langsung dari segmen URL.')

@section('content')
    <div class="mb-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-info-card label="Operan Pertama" :nilai="$angka1" />
        <x-info-card label="Operasi" :nilai="$operasi" />
        <x-info-card label="Operan Kedua" :nilai="$angka2" />
        <x-info-card label="Hasil" :nilai="$hasil" :sorot="$sah" />
    </div>

    @unless ($sah)
        <x-status-banner tipe="peringatan" judul="Perhitungan tidak dijalankan." class="mb-8">
            {{ $hasil }}. Operasi yang didukung: <code class="font-mono text-xs">tambah</code>,
            <code class="font-mono text-xs">kurang</code>, <code class="font-mono text-xs">kali</code>,
            dan <code class="font-mono text-xs">bagi</code>.
        </x-status-banner>
    @endunless

    <div class="flex flex-wrap gap-2">
        @foreach ([[10, 5, 'tambah'], [10, 5, 'kurang'], [10, 5, 'kali'], [10, 5, 'bagi'], [10, 0, 'bagi']] as $c)
            <a href="{{ route('kalkulator.dinamis', ['angka1' => $c[0], 'angka2' => $c[1], 'operasi' => $c[2]]) }}"
               class="rounded-full border border-line-strong px-4 py-2 font-mono text-xs text-ink-soft transition hover:border-accent hover:text-ink">
                /{{ $c[0] }}/{{ $c[1] }}/{{ $c[2] }}
            </a>
        @endforeach
    </div>

    <p class="mt-8 text-sm text-ink-soft">
        Kedua operan dibatasi regex hanya angka bulat, dan pembagian dengan nol dicegah di
        controller sebelum sempat memicu galat.
    </p>
@endsection
