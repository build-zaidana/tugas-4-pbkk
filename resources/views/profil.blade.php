@extends('layouts.app')

@section('title', 'Profil Mahasiswa')
@section('heading', 'Profil Mahasiswa')
@section('subheading', 'Data diri dan rekam jejak perkuliahan')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Nama Lengkap" :nilai="$profil['nama']" sorot />
        <x-info-card label="NRP" :nilai="$profil['nrp']" />
        <x-info-card label="Semester Berjalan" :nilai="$profil['semester']" catatan="Gasal 2026/2027" />
        <x-info-card label="Program Studi" :nilai="$profil['prodi']" />
        <x-info-card label="Departemen" :nilai="$profil['departemen']" :catatan="$profil['fakultas']" />
        <x-info-card label="Surel" :nilai="$profil['email']" />
    </div>

    <div class="mt-8">
        <x-info-card label="Bidang Minat">
            <p class="text-base font-normal text-slate-600 dark:text-slate-300">
                {{ $profil['minat'] }}
            </p>
        </x-info-card>
    </div>

    <h2 class="mt-10 mb-3 text-lg font-semibold text-slate-900 dark:text-white">
        Riwayat Studi
    </h2>

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wider text-slate-500 dark:border-slate-800 dark:bg-slate-800/60 dark:text-slate-400">
                <tr>
                    <th class="px-5 py-3">Semester</th>
                    <th class="px-5 py-3">Periode</th>
                    <th class="px-5 py-3 text-right">SKS</th>
                    <th class="px-5 py-3 text-right">IP</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @foreach ($riwayat as $baris)
                    <tr>
                        <td class="px-5 py-3">{{ $baris['semester'] }}</td>
                        <td class="px-5 py-3">{{ $baris['periode'] }}</td>
                        <td class="px-5 py-3 text-right tabular-nums">{{ $baris['sks'] }}</td>
                        <td class="px-5 py-3 text-right tabular-nums">{{ number_format($baris['ip'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
