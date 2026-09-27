@extends('layouts.app')

@section('title', 'Kalkulator IP')
@section('eyebrow', 'Portofolio akademis')
@section('heading', 'Kalkulator IP')
@section('subheading', 'Menjumlahkan dan merata-rata IP dua semester, diambil dari dua parameter pada URL.')

@section('content')
    <div class="mb-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-info-card label="IP Semester 1" :nilai="$ip1" />
        <x-info-card label="IP Semester 2" :nilai="$ip2" />
        <x-info-card label="Jumlah" :nilai="$jumlah" />
        <x-info-card label="Rata-rata" :nilai="number_format($rata, 2)" sorot />
    </div>

    <x-status-banner tipe="info" judul="Batas nilai dijaga di lapisan rute.">
        Parameter dibatasi regex pada rentang IP yang sah, yaitu 0 sampai 4.00. Masukan di luar
        rentang itu, misalnya <code class="font-mono text-xs">4.9</code>, ditolak sebelum sempat
        masuk ke perhitungan.
    </x-status-banner>

    <div class="mt-8 flex flex-wrap gap-2">
        @foreach ([['3.80', '3.74'], ['4.00', '3.50'], ['2.75', '3.10']] as $contoh)
            <a href="{{ route('kalkulator.ip', ['ip1' => $contoh[0], 'ip2' => $contoh[1]]) }}"
               class="rounded-full border border-line-strong px-4 py-2 font-mono text-xs text-ink-soft transition hover:border-accent hover:text-ink">
                /kalkulator-ip/{{ $contoh[0] }}/{{ $contoh[1] }}
            </a>
        @endforeach
    </div>
@endsection
