{{--
| Komponen <x-teks-inti> untuk menonjolkan bagian inti sebuah kalimat.
|
| Attributes:
|   teks  kalimat sumber, bagian yang ingin ditebalkan diapit dua bintang
|
| Contoh: <x-teks-inti teks="Dikelola **satu master layout**." />
|
| Teks di-escape lebih dulu memakai e(), baru penanda bintang diubah menjadi
| <strong>. Urutan ini penting: tanpa escape di awal, isi teks bisa
| menyisipkan HTML sendiri.
--}}
@props(['teks'])

@php
    $aman = preg_replace(
        '/\*\*(.+?)\*\*/s',
        '<strong class="font-semibold text-ink">$1</strong>',
        e($teks)
    );
@endphp

<span {{ $attributes }}>{!! $aman !!}</span>
