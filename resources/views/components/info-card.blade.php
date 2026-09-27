{{--
| Komponen <x-info-card> untuk menyajikan satu butir data profil.
|
| Attributes:
|   label     wajib, judul kecil di atas nilai
|   nilai     opsional, dipakai bila isi cukup satu baris teks
|   catatan   opsional, keterangan tambahan di bawah nilai
|   sorot     opsional boolean, memberi aksen warna pada kartu
|
| Slot: dipakai bila isi kartu berupa markup, misalnya lencana atau daftar.
|       Bila atribut "nilai" diisi, slot diabaikan.
--}}
@props([
    'label',
    'nilai' => null,
    'catatan' => null,
    'sorot' => false,
])

<div {{ $attributes->class([
        'rounded-xl border p-5 transition',
        'border-sky-200 bg-sky-50 dark:border-sky-900 dark:bg-sky-950/40' => $sorot,
        'border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900' => ! $sorot,
    ]) }}>
    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">
        {{ $label }}
    </p>

    <div class="mt-2 text-lg font-semibold text-slate-900 dark:text-white">
        {{ $nilai ?? $slot }}
    </div>

    @if ($catatan)
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $catatan }}</p>
    @endif
</div>
