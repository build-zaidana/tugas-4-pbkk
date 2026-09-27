{{--
| Komponen <x-info-card> untuk menyajikan satu butir data profil.
|
| Attributes:
|   label     wajib, kapsi kecil di atas nilai
|   nilai     opsional, dipakai bila isi cukup satu baris teks
|   catatan   opsional, keterangan tambahan di bawah nilai
|   sorot     opsional boolean, memberi aksen warna pada kartu
|
| Slot: dipakai bila isi kartu berupa markup, misalnya daftar tautan.
|       Bila atribut "nilai" diisi, slot diabaikan.
--}}
@props([
    'label',
    'nilai' => null,
    'catatan' => null,
    'sorot' => false,
])

<div {{ $attributes->class([
        'rounded-2xl border p-6 transition duration-200',
        'border-accent/40 bg-accent-tint' => $sorot,
        'border-line bg-surface hover:border-line-strong' => ! $sorot,
    ]) }}>
    <p class="font-mono text-[0.68rem] uppercase tracking-[0.16em] text-ink-soft">
        {{ $label }}
    </p>

    <div class="mt-3 font-serif text-2xl leading-tight tracking-tight text-ink">
        {{ $nilai ?? $slot }}
    </div>

    @if ($catatan)
        <p class="mt-3 text-sm leading-relaxed text-ink-soft">{{ $catatan }}</p>
    @endif
</div>
