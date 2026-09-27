{{--
| Master layout terpusat.
|
| Seluruh halaman anak mewarisi berkas ini lewat @extends, sehingga struktur
| <html>, navbar, container, dan footer hanya ditulis satu kali di sini.
|
| $gelap berasal dari controller dan menentukan class "dark" pada elemen root.
| Karena token warna dipetakan inline di app.css, satu class itu membalik
| seluruh palet halaman (Tantangan 1).
--}}
@php
    $gelap = $gelap ?? false;

    // Tautan pengalih tema: mempertahankan halaman yang sedang dibuka.
    $tautanTema = $gelap
        ? request()->fullUrlWithoutQuery('mode')
        : request()->fullUrlWithQuery(['mode' => 'dark']);

    $menu = [
        ['rute' => 'beranda', 'label' => 'Beranda'],
        ['rute' => 'profil.mahasiswa', 'label' => 'Profil'],
        ['rute' => 'ide.agent', 'label' => 'Ide Riset'],
    ];
@endphp

<!DOCTYPE html>
<html lang="id" class="{{ $gelap ? 'dark' : '' }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- Title dinamis: tiap halaman anak mengisi section "title". --}}
        <title>@yield('title', 'Beranda') &mdash; Zaidana</title>

        {{-- Aset dikompilasi Vite dari resources/, bukan dari tautan CDN. --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-paper font-sans text-ink antialiased">
        {{-- Navbar statis --}}
        <header class="px-5 py-5 sm:px-8">
            <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4">
                <a href="{{ route('beranda') }}" class="font-serif text-2xl tracking-tight">
                    Zaidana
                </a>

                <nav class="order-3 w-full rounded-full border border-glass-edge bg-glass px-2 py-1.5
                            backdrop-blur-md sm:order-2 sm:w-auto">
                    <div class="flex items-center justify-center gap-1">
                        @foreach ($menu as $item)
                            <a href="{{ route($item['rute']) }}"
                               class="rounded-full px-4 py-1.5 text-sm transition
                                      {{ request()->routeIs($item['rute'])
                                          ? 'bg-accent text-on-accent'
                                          : 'text-ink-soft hover:text-ink' }}">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </nav>

                {{-- Pengalih tema, sekaligus bukti Tantangan 1 --}}
                <a href="{{ $tautanTema }}"
                   class="order-2 rounded-full border border-line-strong px-4 py-2 text-sm
                          text-ink-soft transition hover:border-accent hover:text-ink sm:order-3"
                   title="Beralih ke mode {{ $gelap ? 'terang' : 'gelap' }}">
                    {{ $gelap ? 'Mode Terang' : 'Mode Gelap' }}
                </a>
            </div>
        </header>

        {{-- Container konten --}}
        <main class="mx-auto max-w-6xl px-5 pt-10 pb-20 sm:px-8">
            <div class="mb-10">
                @hasSection('eyebrow')
                    <p class="mb-3 font-mono text-xs uppercase tracking-[0.18em] text-ink-soft">
                        @yield('eyebrow')
                    </p>
                @endif

                <h1 class="display text-5xl sm:text-6xl">@yield('heading', 'Beranda')</h1>

                @hasSection('subheading')
                    <p class="mt-4 max-w-[60ch] text-ink-soft">@yield('subheading')</p>
                @endif
            </div>

            @yield('content')
        </main>

        {{-- Footer ITS --}}
        <footer class="border-t border-line px-5 py-10 sm:px-8">
            <div class="mx-auto flex max-w-6xl flex-wrap justify-between gap-6 text-sm text-ink-soft">
                <div>
                    <p class="font-serif text-xl text-ink">Departemen Teknik Informatika</p>
                    <p class="mt-2 max-w-[46ch]">
                        Fakultas Teknologi Elektro dan Informatika Cerdas &middot;
                        Institut Teknologi Sepuluh Nopember, Kampus ITS Sukolilo, Surabaya 60111
                    </p>
                </div>

                <div class="text-sm">
                    <p class="font-hand text-xl text-accent">Tugas Mandiri PBKK</p>
                    <p class="mt-1">Pertemuan 4 &mdash; Blade &amp; Vite</p>
                    <p class="mt-1 font-mono text-xs">Adrian Afzal Zaidana &middot; 5025241151</p>
                </div>
            </div>
        </footer>
    </body>
</html>
