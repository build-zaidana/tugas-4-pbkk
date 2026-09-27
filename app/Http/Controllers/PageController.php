<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Seluruh halaman portal ditangani satu controller, sesuai ketentuan tugas.
 */
class PageController extends Controller
{
    /** Data diri pemilik portal. */
    private const PROFIL = [
        'nama' => 'Adrian Afzal Zaidana',
        'nrp' => '5025241151',
        'prodi' => 'Teknik Informatika',
        'departemen' => 'Departemen Teknik Informatika',
        'fakultas' => 'Fakultas Teknologi Elektro dan Informatika Cerdas',
        'angkatan' => '2024',
        'semester' => '5',
        'minat' => 'Agentic AI, keamanan web, dan rekayasa perangkat lunak',
        'email' => 'build.zaidana@gmail.com',
    ];

    /**
     * Halaman Beranda.
     *
     * Tantangan 2: parameter kueri ?user= menghasilkan sapaan dinamis yang
     * dirender oleh komponen <x-status-banner>.
     */
    public function beranda(Request $request)
    {
        $user = $request->query('user');

        return view('beranda', [
            'profil' => self::PROFIL,
            'sapaan' => is_string($user) ? trim($user) : null,
            'gelap' => $this->modeGelap($request),
        ]);
    }

    /**
     * Halaman Profil Mahasiswa.
     */
    public function profil(Request $request)
    {
        return view('profil', [
            'profil' => self::PROFIL,
            'riwayat' => $this->riwayatStudi(),
            'gelap' => $this->modeGelap($request),
        ]);
    }

    /**
     * Halaman Ide Riset platform Agentic AI.
     *
     * Tantangan 1: parameter kueri ?mode=dark mengaktifkan mode gelap.
     */
    public function ideAgent(Request $request)
    {
        return view('ide', [
            'profil' => self::PROFIL,
            'modul' => $this->modulPlatform(),
            'gelap' => $this->modeGelap($request),
        ]);
    }

    /**
     * Memproses formulir pengumpulan ide.
     *
     * Hasilnya dikirim kembali sebagai pesan flash, lalu ditampilkan oleh
     * komponen <x-status-banner> di halaman Ide Riset.
     */
    public function simpanIde(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:80'],
            'judul' => ['required', 'string', 'max:120'],
            'ringkasan' => ['required', 'string', 'min:20', 'max:500'],
        ], [
            'nama.required' => 'Nama pengusul wajib diisi.',
            'judul.required' => 'Judul ide wajib diisi.',
            'ringkasan.required' => 'Ringkasan ide wajib diisi.',
            'ringkasan.min' => 'Ringkasan ide minimal 20 karakter agar cukup jelas.',
        ]);

        // Penyimpanan ke basis data baru dibahas pada pertemuan berikutnya,
        // sehingga ide cukup dikonfirmasi lewat pesan flash.
        return redirect()
            ->route('ide.agent', $this->modeGelap($request) ? ['mode' => 'dark'] : [])
            ->with('sukses', "Ide \"{$data['judul']}\" dari {$data['nama']} berhasil dicatat.");
    }

    /**
     * Menentukan mode gelap dari parameter kueri ?mode=dark.
     */
    private function modeGelap(Request $request): bool
    {
        return $request->query('mode') === 'dark';
    }

    /**
     * Riwayat studi ringkas.
     *
     * CATATAN: nilai IP masih berupa contoh, ganti dengan nilai sebenarnya.
     *
     * @return array<int, array{semester: int, periode: string, sks: int, ip: float}>
     */
    private function riwayatStudi(): array
    {
        return [
            ['semester' => 1, 'periode' => '2024/2025 Ganjil', 'sks' => 20, 'ip' => 3.71],
            ['semester' => 2, 'periode' => '2024/2025 Genap', 'sks' => 21, 'ip' => 3.65],
            ['semester' => 3, 'periode' => '2025/2026 Ganjil', 'sks' => 22, 'ip' => 3.80],
            ['semester' => 4, 'periode' => '2025/2026 Genap', 'sks' => 22, 'ip' => 3.74],
        ];
    }

    /**
     * Modul rancangan platform Agentic AI.
     *
     * @return array<int, array{nama: string, peran: string, rincian: string}>
     */
    private function modulPlatform(): array
    {
        return [
            [
                'nama' => 'Pemetaan Target',
                'peran' => 'Reconnaissance',
                'rincian' => 'Agent menyusun daftar endpoint, teknologi, dan permukaan serang '
                    . 'sebuah situs sebelum pengujian dimulai.',
            ],
            [
                'nama' => 'Orkestrasi Tools',
                'peran' => 'Execution',
                'rincian' => 'LLM memilih security tool yang relevan dengan kondisi target, '
                    . 'lalu menjalankannya secara berurutan.',
            ],
            [
                'nama' => 'Korelasi Temuan',
                'peran' => 'Analysis',
                'rincian' => 'Hasil dari beberapa tool digabungkan, duplikatnya disaring, '
                    . 'lalu diberi peringkat berdasarkan tingkat risiko.',
            ],
            [
                'nama' => 'Penyusunan Laporan',
                'peran' => 'Reporting',
                'rincian' => 'Temuan disajikan beserta bukti dan langkah remediasi yang '
                    . 'mudah dipahami pemilik sistem.',
            ],
        ];
    }
}
