@extends('layouts.app')

@section('title', 'Riwayat Studi')
@section('eyebrow', 'Rekam jejak')
@section('heading', 'Riwayat Studi')
@section('subheading', 'Rekapitulasi per semester. IPK dihitung dengan pembobotan jumlah SKS, bukan rata-rata IP biasa.')

@section('content')
    <div class="mb-10 grid gap-4 sm:grid-cols-3">
        <x-info-card label="IPK Kumulatif" :nilai="number_format($ipk, 2)" catatan="Berbobot jumlah SKS" sorot />
        <x-info-card label="Total SKS" :nilai="$totalSks" catatan="Seluruh semester" />
        <x-info-card label="Semester Ditempuh" :nilai="count($riwayat)" catatan="Sampai periode terakhir" />
    </div>

    <div class="overflow-x-auto rounded-2xl border border-line bg-surface">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-line">
                <tr class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                    <th class="px-6 py-4 font-normal">Semester</th>
                    <th class="px-6 py-4 font-normal">Periode</th>
                    <th class="px-6 py-4 text-right font-normal">SKS</th>
                    <th class="px-6 py-4 text-right font-normal">IP</th>
                    <th class="px-6 py-4 font-normal">Predikat</th>
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
                        <td class="px-6 py-4 text-sm text-ink-soft">
                            @if ($baris['ip'] >= 3.75)
                                Dengan Pujian
                            @elseif ($baris['ip'] >= 3.00)
                                Sangat Memuaskan
                            @else
                                Memuaskan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="mt-8 text-sm text-ink-soft">
        Ingin menghitung proyeksi dua semester tertentu? Gunakan
        <a href="{{ route('kalkulator.ip', ['ip1' => '3.80', 'ip2' => '3.74']) }}"
           class="text-accent underline-offset-4 hover:underline">kalkulator IP</a>.
    </p>
@endsection
