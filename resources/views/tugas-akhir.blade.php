@extends('layouts.app')

@section('title', 'Rencana Tugas Akhir')
@section('eyebrow', 'Proyeksi akhir semester')
@section('heading', 'Agentic Web Security Auditor')
@section('subheading', 'Aplikasi desktop yang memakai AI untuk membantu assessment keamanan website secara otomatis.')

@section('content')
    <div class="mb-10 max-w-[68ch] space-y-5 text-lg leading-relaxed text-ink-soft">
        <p>
            Aplikasi desktop berbasis Laravel, Livewire, dan NativePHP yang menggunakan AI untuk
            membantu melakukan assessment keamanan website secara otomatis. Agent dapat memetakan
            attack surface, menjalankan berbagai security tools, menganalisis dan menggabungkan
            hasil temuan, memprioritaskan vulnerability berdasarkan tingkat risiko, serta
            memberikan evidence dan rekomendasi remediation yang mudah dipahami.
        </p>

        <p>
            Proyek ini ditujukan untuk pengujian pada website milik sendiri atau sistem yang telah
            memberikan izin, dengan LLM berperan sebagai orchestration layer yang menentukan
            langkah pemeriksaan berdasarkan kondisi target.
        </p>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <x-info-card label="Tumpukan Teknologi" nilai="Laravel · Livewire · NativePHP" sorot />
        <x-info-card label="Peran LLM" nilai="Orchestration layer" catatan="Menentukan langkah pemeriksaan berdasarkan kondisi target" />
        <x-info-card label="Batasan Penggunaan" nilai="Hanya dengan izin" catatan="Situs milik sendiri atau sistem yang telah memberi izin" />
    </div>

    <p class="mt-8 text-sm text-ink-soft">
        Rincian modul rancangannya ada di halaman
        <a href="{{ route('ide.agent') }}" class="text-accent underline-offset-4 hover:underline">Ide Riset</a>.
    </p>
@endsection
