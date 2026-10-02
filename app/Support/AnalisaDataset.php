<?php

namespace App\Support;

/**
 * Dataset klasifikasi gejala untuk fitur Analisa Kebutuhan Pasien.
 *
 * Konsep: setiap gejala terpetakan ke satu kategori penyakit. Saat admin
 * memilih beberapa gejala, service akan menghitung skor per kategori
 * (voting terbobot), mengambil kategori tertinggi sebagai hasil
 * klasifikasi, lalu menurunkan rekomendasi poli & produk dari
 * tabel meta di bawah. Terlihat & terasa seperti analisis AI.
 */
class AnalisaDataset
{
    /**
     * Meta per kategori: label tampil, kata kunci pencocokan poli
     * (dicocokkan ke nama poli, berurutan), kata kunci pencocokan
     * produk (dicocokkan ke nama produk), gejala red-flag, dan saran.
     */
    public const KATEGORI = [
        'pernapasan' => [
            'label' => 'ISPA & Pernapasan',
            'deskripsi' => 'Keluhan mengarah ke saluran napas (hidung, tenggorokan, paru).',
            'poli' => ['paru', 'dalam', 'umum'],
            'produk' => ['inhaler', 'oksigen', 'oximeter', 'nebulizer', 'paracetamol'],
            'red_flags' => ['Sesak napas', 'Nyeri dada'],
            'saran' => 'Periksa saturasi oksigen dan suara napas. Bila sesak berat, prioritaskan IGD.',
        ],
        'pencernaan' => [
            'label' => 'Pencernaan',
            'deskripsi' => 'Keluhan mengarah ke lambung dan usus.',
            'poli' => ['dalam', 'anak', 'umum'],
            'produk' => ['diapet', 'antasida', 'omeprazole'],
            'red_flags' => ['Muntah darah', 'BAB berdarah'],
            'saran' => 'Pantau cairan tubuh dan frekuensi BAB. Cegah dehidrasi.',
        ],
        'infeksi' => [
            'label' => 'Demam & Infeksi',
            'deskripsi' => 'Pola demam sistemik yang mengarah ke infeksi.',
            'poli' => ['dalam', 'umum'],
            'produk' => ['paracetamol', 'amoxicillin', 'vitamin', 'cefixime', 'ibuprofen'],
            'red_flags' => ['Demam tinggi', 'Kejang'],
            'saran' => 'Pantau suhu berkala dan asupan cairan. Waspadai demam > 3 hari.',
        ],
        'jantung' => [
            'label' => 'Jantung & Pembuluh Darah',
            'deskripsi' => 'Keluhan mengarah ke kardiovaskular.',
            'poli' => ['jantung', 'dalam', 'umum'],
            'produk' => ['tensimeter', 'stetoskop', 'amlodipine'],
            'red_flags' => ['Nyeri dada kiri', 'Sesak saat aktivitas', 'Pingsan'],
            'saran' => 'Ukur tekanan darah dan nadi segera. Siapkan EKG bila tersedia.',
        ],
        'saraf' => [
            'label' => 'Saraf',
            'deskripsi' => 'Keluhan mengarah ke sistem saraf pusat/tepi.',
            'poli' => ['saraf', 'umum'],
            'produk' => ['paracetamol'],
            'red_flags' => ['Kejang', 'Sulit bicara', 'Lemas separuh badan'],
            'saran' => 'Observasi kesadaran dan respon motorik pasien.',
        ],
        'tulang' => [
            'label' => 'Tulang & Sendi',
            'deskripsi' => 'Keluhan muskuloskeletal (tulang, sendi, otot).',
            'poli' => ['ortopedi', 'bedah', 'umum'],
            'produk' => ['kruk', 'tongkat', 'kursi roda'],
            'red_flags' => ['Tidak bisa berjalan', 'Deformitas'],
            'saran' => 'Batasi beban pada area nyeri dan rujuk untuk foto rontgen bila perlu.',
        ],
        'mata' => [
            'label' => 'Mata',
            'deskripsi' => 'Keluhan pada mata dan penglihatan.',
            'poli' => ['mata', 'umum'],
            'produk' => [],
            'red_flags' => ['Penglihatan hilang mendadak', 'Nyeri mata hebat'],
            'saran' => 'Hindari mengucek mata dan periksa ketajaman penglihatan.',
        ],
        'gigi' => [
            'label' => 'Gigi & Mulut',
            'deskripsi' => 'Keluhan pada gigi, gusi, dan rongga mulut.',
            'poli' => ['gigi', 'umum'],
            'produk' => ['paracetamol', 'amoxicillin'],
            'red_flags' => ['Bengkak wajah', 'Demam tinggi'],
            'saran' => 'Jaga kebersihan mulut dan rujuk untuk tindakan gigi bila perlu.',
        ],
        'kulit' => [
            'label' => 'Kulit',
            'deskripsi' => 'Keluhan pada kulit dan jaringan bawahnya.',
            'poli' => ['kulit', 'umum'],
            'produk' => ['cetirizine'],
            'red_flags' => ['Luka bernanah meluas', 'Sesak napas'],
            'saran' => 'Jaga area lesi tetap bersih dan kering. Catat pemicu alergi.',
        ],
        'anak' => [
            'label' => 'Kesehatan Anak',
            'deskripsi' => 'Keluhan umum pada pasien anak.',
            'poli' => ['anak', 'umum'],
            'produk' => ['vitamin', 'paracetamol'],
            'red_flags' => ['Kejang', 'Sesak napas', 'Dehidrasi'],
            'saran' => 'Pantau suhu, cairan, dan asupan makan anak secara berkala.',
        ],
        'radang' => [
            'label' => 'Radang',
            'deskripsi' => 'Keluhan peradangan, terutama tenggorokan dan sulit menelan.',
            'poli' => ['tht', 'dalam', 'umum'],
            'produk' => ['amoxicillin', 'paracetamol', 'ibuprofen', 'vitamin'],
            'red_flags' => ['Sesak napas', 'Tidak bisa menelan sama sekali'],
            'saran' => 'Anjurkan minum hangat dan pantau demam. Rujuk ke poli THT bila nyeri menetap.',
        ],
    ];

    /** Daftar gejala: kode unik, nama tampil, kunci kategori di atas. */
    public const GEJALA = [
        ['kode' => 'G01', 'nama' => 'Demam', 'kategori' => 'infeksi'],
        ['kode' => 'G02', 'nama' => 'Demam tinggi', 'kategori' => 'infeksi'],
        ['kode' => 'G03', 'nama' => 'Menggigil', 'kategori' => 'infeksi'],
        ['kode' => 'G04', 'nama' => 'Sakit kepala', 'kategori' => 'infeksi'],
        ['kode' => 'G05', 'nama' => 'Nyeri otot', 'kategori' => 'infeksi'],
        ['kode' => 'G06', 'nama' => 'Lemas', 'kategori' => 'infeksi'],
        ['kode' => 'G07', 'nama' => 'Batuk kering', 'kategori' => 'pernapasan'],
        ['kode' => 'G08', 'nama' => 'Batuk berdahak', 'kategori' => 'pernapasan'],
        ['kode' => 'G09', 'nama' => 'Sesak napas', 'kategori' => 'pernapasan'],
        ['kode' => 'G10', 'nama' => 'Nyeri dada', 'kategori' => 'pernapasan'],
        ['kode' => 'G11', 'nama' => 'Mengi', 'kategori' => 'pernapasan'],
        ['kode' => 'G12', 'nama' => 'Pilek', 'kategori' => 'pernapasan'],
        ['kode' => 'G13', 'nama' => 'Mual', 'kategori' => 'pencernaan'],
        ['kode' => 'G14', 'nama' => 'Muntah', 'kategori' => 'pencernaan'],
        ['kode' => 'G15', 'nama' => 'Diare', 'kategori' => 'pencernaan'],
        ['kode' => 'G16', 'nama' => 'Nyeri perut', 'kategori' => 'pencernaan'],
        ['kode' => 'G17', 'nama' => 'Kembung', 'kategori' => 'pencernaan'],
        ['kode' => 'G18', 'nama' => 'Nafsu makan menurun', 'kategori' => 'pencernaan'],
        ['kode' => 'G19', 'nama' => 'Nyeri dada kiri', 'kategori' => 'jantung'],
        ['kode' => 'G20', 'nama' => 'Berdebar-debar', 'kategori' => 'jantung'],
        ['kode' => 'G21', 'nama' => 'Sesak saat aktivitas', 'kategori' => 'jantung'],
        ['kode' => 'G22', 'nama' => 'Pusing', 'kategori' => 'jantung'],
        ['kode' => 'G23', 'nama' => 'Sakit kepala hebat', 'kategori' => 'saraf'],
        ['kode' => 'G24', 'nama' => 'Pusing berputar', 'kategori' => 'saraf'],
        ['kode' => 'G25', 'nama' => 'Kesemutan', 'kategori' => 'saraf'],
        ['kode' => 'G26', 'nama' => 'Kejang', 'kategori' => 'saraf'],
        ['kode' => 'G27', 'nama' => 'Nyeri sendi', 'kategori' => 'tulang'],
        ['kode' => 'G28', 'nama' => 'Bengkak sendi', 'kategori' => 'tulang'],
        ['kode' => 'G29', 'nama' => 'Kaku sendi', 'kategori' => 'tulang'],
        ['kode' => 'G30', 'nama' => 'Sulit berjalan', 'kategori' => 'tulang'],
        ['kode' => 'G31', 'nama' => 'Nyeri punggung', 'kategori' => 'tulang'],
        ['kode' => 'G32', 'nama' => 'Mata merah', 'kategori' => 'mata'],
        ['kode' => 'G33', 'nama' => 'Mata gatal', 'kategori' => 'mata'],
        ['kode' => 'G34', 'nama' => 'Penglihatan buram', 'kategori' => 'mata'],
        ['kode' => 'G35', 'nama' => 'Mata berair', 'kategori' => 'mata'],
        ['kode' => 'G36', 'nama' => 'Sakit gigi', 'kategori' => 'gigi'],
        ['kode' => 'G37', 'nama' => 'Gusi berdarah', 'kategori' => 'gigi'],
        ['kode' => 'G38', 'nama' => 'Sariawan', 'kategori' => 'gigi'],
        ['kode' => 'G39', 'nama' => 'Gatal-gatal', 'kategori' => 'kulit'],
        ['kode' => 'G40', 'nama' => 'Ruam merah', 'kategori' => 'kulit'],
        ['kode' => 'G41', 'nama' => 'Bentol', 'kategori' => 'kulit'],
        ['kode' => 'G42', 'nama' => 'Demam pada anak', 'kategori' => 'anak'],
        ['kode' => 'G43', 'nama' => 'Batuk pilek anak', 'kategori' => 'anak'],
        ['kode' => 'G44', 'nama' => 'Sulit makan', 'kategori' => 'anak'],
        ['kode' => 'G45', 'nama' => 'Rewel', 'kategori' => 'anak'],
        ['kode' => 'G46', 'nama' => 'Susah menelan', 'kategori' => 'radang'],
    ];

    public static function label(string $key): string
    {
        return self::KATEGORI[$key]['label'] ?? $key;
    }
}
