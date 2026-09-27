{{--
| Master layout terpusat.
|
| Seluruh halaman anak mewarisi berkas ini melalui @extends, sehingga struktur
| <html>, navbar, container, dan footer hanya ditulis satu kali di sini.
|
| $gelap berasal dari controller dan menentukan class "dark" pada elemen root,
| yang menjadi pemicu seluruh varian dark: milik Tailwind (Tantangan 1).
--}}
@php
    $gelap = $gelap ?? false;
@endphp

<!DOCTYPE html>
<html lang="id" class="{{ $gelap ? 'dark' : '' }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- Title dinamis: tiap halaman anak mengisi section "title". --}}
        <title>@yield('title', 'Beranda') &mdash; Portal Akademik ITS</title>

        {{-- Aset dikompilasi Vite dari resources/, bukan dari tautan CDN. --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-slate-50 text-slate-800 antialiased dark:bg-slate-950 dark:text-slate-200">
        {{-- Navbar statis --}}
        <header class="border-b border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-3 px-6 py-4">
                <a href="{{ route('beranda') }}" class="leading-tight">
                    <span class="block text-base font-semibold text-slate-900 dark:text-white">Portal Akademik</span>
                    <span class="block text-xs text-slate-500 dark:text-slate-400">Teknik Informatika &mdash; ITS Surabaya</span>
                </a>

                <nav class="flex flex-wrap items-center gap-1">
                    @php
                        $menu = [
                            ['rute' => 'beranda', 'label' => 'Beranda'],
                            ['rute' => 'profil.mahasiswa', 'label' => 'Profil'],
                            ['rute' => 'ide.agent', 'label' => 'Ide Riset'],
                        ];
                    @endphp

                    @foreach ($menu as $item)
                        <a href="{{ route($item['rute']) }}"
                           class="rounded-md px-3 py-2 text-sm font-medium transition
                                  {{ request()->routeIs($item['rute'])
                                      ? 'bg-sky-600 text-white'
                                      : 'text-slate-600 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>
            </div>
        </header>

        {{-- Container konten --}}
        <main class="mx-auto max-w-5xl px-6 py-8">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">
                    @yield('heading', 'Beranda')
                </h1>

                @hasSection('subheading')
                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">@yield('subheading')</p>
                @endif
            </div>

            @yield('content')
        </main>

        {{-- Footer ITS --}}
        <footer class="mt-10 border-t border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
            <div class="mx-auto max-w-5xl px-6 py-6 text-sm text-slate-500 dark:text-slate-400">
                <p class="font-medium text-slate-700 dark:text-slate-300">
                    Departemen Teknik Informatika
                </p>
                <p class="mt-1">
                    Fakultas Teknologi Elektro dan Informatika Cerdas &middot;
                    Institut Teknologi Sepuluh Nopember, Kampus ITS Sukolilo, Surabaya 60111
                </p>
                <p class="mt-3 text-xs">
                    Tugas Mandiri PBKK Pertemuan 4 &middot; Adrian Afzal Zaidana &middot; 5025241151
                </p>
            </div>
        </footer>
    </body>
</html>
