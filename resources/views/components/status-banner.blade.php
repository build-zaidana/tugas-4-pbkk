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
        'sukses' => 'border-emerald-200 bg-emerald-50 text-emerald-900 dark:border-emerald-900 dark:bg-emerald-950/50 dark:text-emerald-200',
        'peringatan' => 'border-amber-200 bg-amber-50 text-amber-900 dark:border-amber-900 dark:bg-amber-950/50 dark:text-amber-200',
        'galat' => 'border-rose-200 bg-rose-50 text-rose-900 dark:border-rose-900 dark:bg-rose-950/50 dark:text-rose-200',
        default => 'border-sky-200 bg-sky-50 text-sky-900 dark:border-sky-900 dark:bg-sky-950/50 dark:text-sky-200',
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-xl border px-5 py-4 {$gaya}"]) }} role="status">
    @if ($judul)
        <p class="font-semibold">{{ $judul }}</p>
    @endif

    <div class="{{ $judul ? 'mt-1 text-sm' : 'text-sm' }}">
        {{ $slot }}
    </div>
</div>
