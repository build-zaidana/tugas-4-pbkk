{{--
| Komponen <x-status-banner> untuk notifikasi form dan sapaan pengguna.
|
| Attributes:
|   tipe   sukses | info | peringatan | galat, menentukan warna banner
|   judul  opsional, baris tebal di atas isi pesan
|
| Slot: isi pesan banner.
--}}
@props([
    'tipe' => 'info',
    'judul' => null,
])

@php
    $gaya = match ($tipe) {
        'sukses' => 'border-accent/45 bg-accent-tint text-ink',
        'peringatan' => 'border-tan/45 bg-tan-tint text-ink',
        'galat' => 'border-danger/45 bg-danger-tint text-ink',
        default => 'border-line-strong bg-surface text-ink',
    };

    $warnaTitik = match ($tipe) {
        'sukses' => 'bg-accent',
        'peringatan' => 'bg-tan',
        'galat' => 'bg-danger',
        default => 'bg-ink-soft',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex gap-3 rounded-2xl border px-5 py-4 {$gaya}"]) }} role="status">
    <span class="mt-2 h-2 w-2 shrink-0 rounded-full {{ $warnaTitik }}"></span>

    <div>
        @if ($judul)
            <p class="font-serif text-xl leading-snug tracking-tight">{{ $judul }}</p>
        @endif

        <div class="{{ $judul ? 'mt-1 text-sm text-ink-soft' : 'text-sm' }}">
            {{ $slot }}
        </div>
    </div>
</div>
