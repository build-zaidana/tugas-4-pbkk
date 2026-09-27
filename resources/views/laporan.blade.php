@extends('layouts.app')

@section('title', 'Laporan Pengerjaan')
@section('eyebrow', 'Bahan presentasi')
@section('heading', 'Apa saja yang dikerjakan untuk tugas ini.')
@section('subheading', 'Rekap pemenuhan spesifikasi, kedua tantangan nilai plus, serta berkas yang dibuat dan disesuaikan.')

@section('content')
    <x-status-banner tipe="sukses" judul="Seluruh spesifikasi wajib terpenuhi." class="mb-12">
        Ditambah kedua tantangan nilai plus. Setiap butir di bawah dapat dibuka langsung
        untuk diperiksa saat demo.
    </x-status-banner>

    {{-- Ringkasan angka --}}
    <div class="mb-14 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-info-card label="Halaman" nilai="4" catatan="Tiga wajib, satu tambahan" sorot />
        <x-info-card label="Komponen Kustom" nilai="2" catatan="Attributes sekaligus slot" />
        <x-info-card label="Rute Terdaftar" nilai="6" catatan="Semua ke satu controller" />
        <x-info-card label="Tautan CDN" nilai="0" catatan="Font ikut di-self-host" />
    </div>

    {{-- Spesifikasi wajib --}}
    <h2 class="display mb-5 text-3xl">Spesifikasi Wajib</h2>

    <div class="mb-14 overflow-hidden rounded-2xl border border-line bg-surface">
        @foreach ($spesifikasi as $baris)
            <div class="flex flex-col gap-2 border-line p-6 sm:flex-row sm:gap-6 {{ ! $loop->last ? 'border-b' : '' }}">
                <div class="sm:w-56 sm:shrink-0">
                    <p class="font-serif text-xl leading-snug tracking-tight text-ink">
                        {{ $baris['ketentuan'] }}
                    </p>
                </div>

                <div class="sm:flex-1">
                    <p class="text-sm leading-relaxed text-ink-soft">{{ $baris['penerapan'] }}</p>
                    <p class="mt-2 font-mono text-xs text-accent">{{ $baris['bukti'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Tantangan --}}
    <h2 class="display mb-5 text-3xl">Tantangan Nilai Plus</h2>

    <div class="mb-14 grid gap-4 sm:grid-cols-2">
        @foreach ($tantangan as $item)
            <div class="rounded-2xl border border-accent/40 bg-accent-tint p-6">
                <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
                    {{ $item['nomor'] }}
                </p>

                <p class="mt-3 font-serif text-2xl leading-tight tracking-tight text-ink">
                    {{ $item['judul'] }}
                </p>

                <p class="mt-3 text-sm leading-relaxed text-ink-soft">{{ $item['cara'] }}</p>

                <a href="{{ $item['tautan'] }}"
                   class="mt-5 inline-block rounded-full border border-accent/50 px-5 py-2
                          font-mono text-xs text-ink transition hover:bg-accent hover:text-on-accent">
                    {{ $item['rute'] }}
                </a>
            </div>
        @endforeach
    </div>

    {{-- Berkas --}}
    <h2 class="display mb-5 text-3xl">Berkas yang Disentuh</h2>

    <div class="grid gap-4 lg:grid-cols-2">
        <x-info-card label="Dibuat baru">
            <ul class="mt-1 space-y-3">
                @foreach ($berkasBaru as $b)
                    <li>
                        <p class="font-mono text-xs break-all text-accent">{{ $b['berkas'] }}</p>
                        <p class="font-sans text-sm text-ink-soft">{{ $b['guna'] }}</p>
                    </li>
                @endforeach
            </ul>
        </x-info-card>

        <x-info-card label="Disesuaikan dari bawaan Laravel">
            <ul class="mt-1 space-y-3">
                @foreach ($berkasUbah as $b)
                    <li>
                        <p class="font-mono text-xs break-all text-accent">{{ $b['berkas'] }}</p>
                        <p class="font-sans text-sm text-ink-soft">{{ $b['guna'] }}</p>
                    </li>
                @endforeach
            </ul>
        </x-info-card>
    </div>

    <p class="mt-10 font-hand text-2xl text-accent">
        Halaman ini sendiri juga mewarisi master layout yang sama.
    </p>
@endsection
