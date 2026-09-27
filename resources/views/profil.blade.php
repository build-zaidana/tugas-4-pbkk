@extends('layouts.app')

@section('title', 'Profil Mahasiswa')
@section('eyebrow', 'Data diri')
@section('heading', 'Profil Mahasiswa')
@section('subheading', 'Identitas akademis dan rekam jejak perkuliahan sampai semester berjalan.')

@section('content')
    {{-- Kartu identitas dengan pasfoto --}}
    <div class="mb-10 flex flex-col gap-7 rounded-2xl border border-line bg-surface p-7 sm:flex-row sm:items-center">
        <img src="{{ asset('images/profil.jpg') }}"
             alt="Pasfoto {{ $profil['nama'] }}"
             width="640" height="640" loading="lazy"
             class="h-36 w-36 shrink-0 rounded-2xl object-cover ring-1 ring-line-strong">

        <div>
            <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                Kartu Tanda Mahasiswa
            </p>

            <p class="mt-2 font-serif text-4xl leading-tight tracking-tight text-ink">
                {{ $profil['nama'] }}
            </p>

            <p class="mt-2 font-mono text-sm text-accent">{{ $profil['nrp'] }}</p>

            <p class="mt-3 max-w-[48ch] text-sm leading-relaxed text-ink-soft">
                {{ $profil['prodi'] }} &middot; Angkatan {{ $profil['angkatan'] }} &middot;
                Semester {{ $profil['semester'] }}
            </p>
        </div>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Nama Lengkap" :nilai="$profil['nama']" sorot />
        <x-info-card label="NRP" :nilai="$profil['nrp']" />
        <x-info-card label="Semester Berjalan" :nilai="$profil['semester']" catatan="Gasal 2026/2027" />
        <x-info-card label="Program Studi" :nilai="$profil['prodi']" />
        <x-info-card label="Departemen" :nilai="$profil['departemen']" :catatan="$profil['fakultas']" />
        <x-info-card label="Surel" :nilai="$profil['email']" />
    </div>

    <div class="mt-4">
        <x-info-card label="Bidang Minat">
            <p class="font-sans text-base leading-relaxed text-ink-soft">
                {{ $profil['minat'] }}
            </p>
        </x-info-card>
    </div>

    <h2 class="display mt-16 mb-5 text-3xl">Riwayat Studi</h2>

    <div class="overflow-x-auto rounded-2xl border border-line bg-surface">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-line">
                <tr class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                    <th class="px-6 py-4 font-normal">Semester</th>
                    <th class="px-6 py-4 font-normal">Periode</th>
                    <th class="px-6 py-4 text-right font-normal">SKS</th>
                    <th class="px-6 py-4 text-right font-normal">IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-line">
                @foreach ($riwayat as $baris)
                    <tr class="transition hover:bg-raised">
                        <td class="px-6 py-4 font-serif text-xl">{{ $baris['semester'] }}</td>
                        <td class="px-6 py-4 text-ink-soft">{{ $baris['periode'] }}</td>
                        <td class="px-6 py-4 text-right font-mono tabular-nums">{{ $baris['sks'] }}</td>
                        <td class="px-6 py-4 text-right font-mono tabular-nums text-accent">
                            {{ number_format($baris['ip'], 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
