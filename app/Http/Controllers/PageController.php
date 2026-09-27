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
     * Daftar berkas bukti yang boleh dibuka halaman Laporan.
     *
     * Sengaja berupa allowlist tetap, bukan path dari input pengguna, supaya
     * penampil berkas tidak bisa dipakai membaca berkas lain di server.
     */
    private const BUKTI = [
        'layout' => 'resources/views/layouts/app.blade.php',
        'beranda' => 'resources/views/beranda.blade.php',
        'profil' => 'resources/views/profil.blade.php',
        'ide' => 'resources/views/ide.blade.php',
        'laporan' => 'resources/views/laporan.blade.php',
        'info-card' => 'resources/views/components/info-card.blade.php',
        'status-banner' => 'resources/views/components/status-banner.blade.php',
        'controller' => 'app/Http/Controllers/PageController.php',
        'rute' => 'routes/web.php',
        'css' => 'resources/css/app.css',
        'vite' => 'vite.config.js',
        'package' => 'package.json',
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
     * Halaman Laporan Pengerjaan.
     *
     * Merangkum apa saja yang dibangun untuk Tugas Pertemuan 4, dipakai
     * sebagai bahan saat sesi live demo.
     */
    public function laporan(Request $request)
    {
        $spesifikasi = array_map(function (array $baris) {
            $baris['bukti'] = $this->petakanBukti($baris['kunci']);

            return $baris;
        }, $this->rekapSpesifikasi());

        return view('laporan', [
            'spesifikasi' => $spesifikasi,
            'tantangan' => $this->rekapTantangan(),
            'berkasBaru' => $this->berkasBaru(),
            'berkasUbah' => $this->berkasDiubah(),
            'repo' => config('tugas.repo'),
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
     * Rekap pemenuhan spesifikasi teknis wajib.
     *
     * Tiap butir membawa daftar kunci berkas bukti, yang di halaman Laporan
     * diubah menjadi tautan ke penampil berkas dan ke GitHub.
     *
     * @return array<int, array{ketentuan: string, penerapan: string, kunci: array<int, string>}>
     */
    private function rekapSpesifikasi(): array
    {
        return [
            [
                'ketentuan' => 'Master layout terpusat',
                'penerapan' => 'layouts/app.blade.php memuat title dinamis, navbar statis, '
                    . 'container konten, dan footer ITS.',
                'kunci' => ['layout'],
            ],
            [
                'ketentuan' => 'Tanpa duplikasi struktur HTML',
                'penerapan' => 'Tidak ada satu pun tag <html>, <head>, atau <body> di berkas '
                    . 'view selain di master layout. Semua halaman dibuka dengan '
                    . '@extends(\'layouts.app\').',
                'kunci' => ['beranda', 'profil', 'ide', 'laporan'],
            ],
            [
                'ketentuan' => 'Minimal tiga halaman anak',
                'penerapan' => 'Beranda, Profil Mahasiswa, dan Ide Riset. Halaman laporan ini '
                    . 'menjadi halaman keempat.',
                'kunci' => ['rute'],
            ],
            [
                'ketentuan' => 'Satu PageController',
                'penerapan' => 'Tujuh rute, seluruhnya diarahkan ke PageController.',
                'kunci' => ['controller', 'rute'],
            ],
            [
                'ketentuan' => 'Minimal dua komponen kustom',
                'penerapan' => 'x-info-card untuk data profil dan x-status-banner untuk '
                    . 'notifikasi form. Keduanya menerima attributes sekaligus slot.',
                'kunci' => ['info-card', 'status-banner'],
            ],
            [
                'ketentuan' => 'Asset bundler Vite via NPM',
                'penerapan' => 'Tailwind CSS 4 dikompilasi @tailwindcss/vite. Empat font '
                    . 'diunduh saat build lalu disajikan dari public/build.',
                'kunci' => ['vite', 'package', 'css'],
            ],
            [
                'ketentuan' => 'Tanpa tautan CDN',
                'penerapan' => 'HTML hasil render tidak memuat satu pun alamat eksternal. '
                    . 'Font pun diunduh saat build, bukan dipanggil dari CDN.',
                'kunci' => ['layout', 'vite'],
            ],
        ];
    }

    /**
     * Menampilkan isi satu berkas bukti.
     *
     * Kunci divalidasi terhadap allowlist BUKTI, sehingga path dari URL tidak
     * pernah dipakai langsung untuk membaca berkas.
     */
    public function berkas(Request $request, string $kunci)
    {
        abort_unless(array_key_exists($kunci, self::BUKTI), 404);

        $relatif = self::BUKTI[$kunci];
        $absolut = base_path($relatif);

        abort_unless(is_file($absolut), 404);

        return view('berkas', [
            'kunci' => $kunci,
            'berkas' => $relatif,
            'baris' => explode("\n", rtrim((string) file_get_contents($absolut), "\n")),
            'tautanGithub' => $this->tautanGithub($relatif),
            'daftarBukti' => self::BUKTI,
            'gelap' => $this->modeGelap($request),
        ]);
    }

    /**
     * Menyusun tautan ke berkas di GitHub.
     *
     * Mengembalikan null bila TUGAS_REPO_URL belum diisi, supaya halaman tetap
     * berfungsi sebelum repositori dibuat.
     */
    private function tautanGithub(string $relatif): ?string
    {
        $repo = config('tugas.repo');

        if (! is_string($repo) || $repo === '') {
            return null;
        }

        return rtrim($repo, '/') . '/blob/' . config('tugas.branch') . '/' . $relatif;
    }

    /**
     * Memasangkan tiap kunci bukti dengan path dan tautannya.
     *
     * @param  array<int, string>  $kunci
     * @return array<int, array{kunci: string, berkas: string, github: string|null}>
     */
    private function petakanBukti(array $kunci): array
    {
        return array_map(fn (string $k) => [
            'kunci' => $k,
            'berkas' => self::BUKTI[$k],
            'github' => $this->tautanGithub(self::BUKTI[$k]),
        ], $kunci);
    }

    /**
     * Rekap dua tantangan nilai plus.
     *
     * @return array<int, array{nomor: string, judul: string, cara: string, rute: string, tautan: string}>
     */
    private function rekapTantangan(): array
    {
        return [
            [
                'nomor' => 'Tantangan 1',
                'judul' => 'Toggle tema dinamis',
                'cara' => 'Controller membaca ?mode=dark menjadi variabel Blade $gelap, lalu '
                    . 'memasangnya sebagai class "dark" pada elemen root. Token warna '
                    . 'dipetakan inline di app.css, sehingga satu class membalik seluruh palet.',
                'rute' => '/ide-agent?mode=dark',
                'tautan' => route('ide.agent', ['mode' => 'dark']),
            ],
            [
                'nomor' => 'Tantangan 2',
                'judul' => 'Alert status interaktif',
                'cara' => 'Parameter ?user= dibaca controller lalu diteruskan ke komponen '
                    . 'x-status-banner sebagai sapaan. Tanpa parameter, banner berubah '
                    . 'menjadi petunjuk pemakaian.',
                'rute' => '/beranda?user=Andi',
                'tautan' => route('beranda', ['user' => 'Andi']),
            ],
        ];
    }

    /**
     * Berkas yang dibuat khusus untuk tugas ini.
     *
     * @return array<int, array{berkas: string, guna: string}>
     */
    private function berkasBaru(): array
    {
        return [
            ['berkas' => 'resources/views/layouts/app.blade.php', 'guna' => 'Master layout'],
            ['berkas' => 'resources/views/components/info-card.blade.php', 'guna' => 'Komponen kartu data'],
            ['berkas' => 'resources/views/components/status-banner.blade.php', 'guna' => 'Komponen notifikasi'],
            ['berkas' => 'resources/views/beranda.blade.php', 'guna' => 'Halaman 1'],
            ['berkas' => 'resources/views/profil.blade.php', 'guna' => 'Halaman 2'],
            ['berkas' => 'resources/views/ide.blade.php', 'guna' => 'Halaman 3 dan formulir ide'],
            ['berkas' => 'resources/views/laporan.blade.php', 'guna' => 'Halaman laporan ini'],
            ['berkas' => 'README.md', 'guna' => 'Dokumentasi dan cara menjalankan'],
        ];
    }

    /**
     * Berkas bawaan Laravel yang disesuaikan.
     *
     * @return array<int, array{berkas: string, guna: string}>
     */
    private function berkasDiubah(): array
    {
        return [
            ['berkas' => 'app/Http/Controllers/PageController.php', 'guna' => 'Seluruh logika halaman dan validasi form'],
            ['berkas' => 'routes/web.php', 'guna' => 'Enam rute bernama'],
            ['berkas' => 'resources/css/app.css', 'guna' => 'Token warna, varian dark berbasis class, tipografi'],
            ['berkas' => 'vite.config.js', 'guna' => 'Pendaftaran empat font agar di-self-host'],
        ];
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
