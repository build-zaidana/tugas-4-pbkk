@extends('layouts.app')

@section('title', 'Berkas Bukti')
@section('eyebrow', 'Bukti pengerjaan')
@section('heading', $berkas)
@section('subheading', 'Isi berkas dibaca langsung dari proyek yang sedang berjalan, sehingga selalu sama dengan kode yang didemokan.')

@section('content')
    {{-- Penjelasan inti berkas ini --}}
    <x-status-banner tipe="sukses" judul="Inti berkas ini" class="mb-8">
        {{ $inti }}
    </x-status-banner>

    <div class="mb-6 flex flex-wrap items-center gap-3">
        <a href="{{ route('laporan') }}"
           class="rounded-full border border-line-strong px-5 py-2 text-sm text-ink-soft transition hover:border-accent hover:text-ink">
            Kembali ke Laporan
        </a>

        @if ($tautanGithub)
            <a href="{{ $tautanGithub }}" target="_blank" rel="noopener"
               class="rounded-full bg-accent px-5 py-2 text-sm font-medium text-on-accent transition hover:opacity-90">
                Buka di GitHub
            </a>
        @endif

        <span class="font-mono text-xs text-ink-soft">{{ count($baris) }} baris</span>

        {{-- Keterangan penanda sorotan --}}
        <span class="flex items-center gap-2 font-mono text-xs text-ink-soft">
            <span class="inline-block h-3 w-1 rounded-sm bg-accent"></span>
            {{ $jumlahSorot }} baris inti disorot
        </span>
    </div>

    {{-- Isi berkas. Baris inti diberi garis aksen, latar, dan huruf tebal. --}}
    <div class="overflow-x-auto rounded-2xl border border-line bg-surface">
        <table class="w-full border-collapse font-mono text-[0.78rem] leading-relaxed">
            <tbody>
                @foreach ($baris as $b)
                    <tr class="align-top {{ $b['sorot'] ? 'bg-accent-tint' : '' }}">
                        <td class="w-14 shrink-0 border-r px-3 py-0.5 text-right select-none
                                   {{ $b['sorot']
                                       ? 'border-accent font-semibold text-accent'
                                       : 'border-line text-ink-soft/70' }}">
                            {{ $b['nomor'] }}
                        </td>

                        <td class="px-4 py-0.5 whitespace-pre
                                   {{ $b['sorot'] ? 'font-semibold text-ink' : 'text-ink-soft' }}">{{ $b['isi'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="display mt-14 mb-5 text-3xl">Berkas Bukti Lain</h2>

    <div class="flex flex-wrap gap-2">
        @foreach ($daftarBukti as $k => $path)
            <a href="{{ route('laporan.berkas', $k) }}"
               class="rounded-full border px-4 py-2 font-mono text-xs transition
                      {{ $k === $kunci
                          ? 'border-accent bg-accent text-on-accent'
                          : 'border-line-strong text-ink-soft hover:border-accent hover:text-ink' }}">
                {{ $k }}
            </a>
        @endforeach
    </div>
@endsection
