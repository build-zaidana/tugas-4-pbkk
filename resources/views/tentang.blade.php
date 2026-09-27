@extends('layouts.app')

@section('title', 'Tentang Departemen')
@section('eyebrow', 'Profil institusi')
@section('heading', 'Departemen Teknik Informatika')
@section('subheading', 'Fakultas Teknologi Elektro dan Informatika Cerdas — Institut Teknologi Sepuluh Nopember, Surabaya.')

@section('content')
    <div class="mb-10 max-w-[68ch] space-y-5 text-lg leading-relaxed text-ink-soft">
        <p>
            Departemen Teknik Informatika di ITS berdedikasi pada keunggulan dalam pendidikan,
            penelitian, dan inovasi di bidang ilmu komputer dan rekayasa perangkat lunak.
        </p>

        <p>
            Kami mempersiapkan mahasiswa untuk menjadi pemimpin teknologi melalui kurikulum
            mutakhir dan fasilitas kelas dunia.
        </p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Fakultas" nilai="FTEIC" catatan="Teknologi Elektro dan Informatika Cerdas" sorot />
        <x-info-card label="Institusi" nilai="ITS Surabaya" catatan="Kampus ITS Sukolilo, Surabaya 60111" />
        <x-info-card label="Mata Kuliah" nilai="PBKK" catatan="Pemrograman Berbasis Kerangka Kerja" />
    </div>
@endsection
