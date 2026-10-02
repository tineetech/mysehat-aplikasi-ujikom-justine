<?php

namespace App\Services;

use App\Models\Gejala;
use App\Models\Poli;
use App\Models\Produk;
use App\Support\AnalisaDataset;
use Illuminate\Support\Collection;

/**
 * Mesin klasifikasi gejala → kategori penyakit + rekomendasi poli & produk.
 *
 * Cara kerja (rule-based scoring, disajikan seperti analisis AI):
 * 1. Gejala yang dipilih + gejala yang terdeteksi dari deskripsi keluhan
 *    di-voting per kategori.
 * 2. Kategori skor tertinggi menang; confidence = porsi suaranya.
 * 3. Poli dicari dari kata kunci kategori ke nama poli aktif.
 * 4. Produk dicari dari kata kunci kategori ke nama produk aktif,
 *    dilengkapi produk obat terlaris bila kurang.
 */
class AnalisaGejalaService
{
    /**
     * @param  array<int>  $gejalaIds
     * @return array{kategori_key: ?string, kategori: ?string, skor: array<string,int>, confidence: float, urgensi: ?string, red_flag: bool, poli: ?Poli, produks: Collection, terdeteksi: array<string>, ringkasan: ?string}
     */
    public static function analyze(array $gejalaIds, ?string $keluhan = null): array
    {
        $dipilih = Gejala::whereIn('id', $gejalaIds)->get();
        $terdeteksi = self::deteksiDariTeks($keluhan, $dipilih->pluck('id')->all());

        $semua = $dipilih->concat($terdeteksi);

        if ($semua->isEmpty()) {
            return [
                'kategori_key' => null,
                'kategori' => null,
                'skor' => [],
                'confidence' => 0,
                'urgensi' => null,
                'red_flag' => false,
                'poli' => null,
                'produks' => collect(),
                'terdeteksi' => [],
                'ringkasan' => null,
            ];
        }

        $skor = [];
        foreach ($semua as $gejala) {
            $skor[$gejala->kategori] = ($skor[$gejala->kategori] ?? 0) + 1;
        }
        arsort($skor);

        $menang = array_key_first($skor);
        $total = array_sum($skor);
        $confidence = $total > 0 ? round($skor[$menang] / $total * 100, 1) : 0;

        $meta = AnalisaDataset::KATEGORI[$menang] ?? [];
        $namaGejala = $semua->pluck('nama')->all();
        $redFlag = ! empty(array_intersect($namaGejala, $meta['red_flags'] ?? []));

        $urgensi = $redFlag ? 'Tinggi' : ($total >= 4 ? 'Sedang' : 'Rendah');

        $poli = self::cariPoli($meta['poli'] ?? []);
        $produks = self::cariProduk($meta['produk'] ?? []);

        $ringkasan = self::susunRingkasan($semua, $meta, $menang, $confidence, $urgensi, $redFlag, $poli, $produks, $terdeteksi);

        return [
            'kategori_key' => $menang,
            'kategori' => $meta['label'] ?? $menang,
            'skor' => $skor,
            'confidence' => $confidence,
            'urgensi' => $urgensi,
            'red_flag' => $redFlag,
            'poli' => $poli,
            'produks' => $produks,
            'terdeteksi' => $terdeteksi->pluck('nama')->all(),
            'ringkasan' => $ringkasan,
        ];
    }

    /** Pindai deskripsi keluhan untuk nama gejala yang disebut tapi belum dipilih. */
    protected static function deteksiDariTeks(?string $keluhan, array $kecualikanIds): Collection
    {
        $keluhan = mb_strtolower(trim((string) $keluhan));

        if ($keluhan === '') {
            return collect();
        }

        $kandidat = Gejala::where('status', 'active')
            ->whereNotIn('id', $kecualikanIds)
            ->get()
            ->sortByDesc(fn (Gejala $g) => mb_strlen($g->nama));

        $terpilih = collect();
        $teksSisa = $keluhan;

        foreach ($kandidat as $g) {
            $nama = mb_strtolower($g->nama);
            $pattern = '/\b' . preg_quote($nama, '/') . '\b/u';
            if (preg_match($pattern, $teksSisa)) {
                $terpilih->push($g);
                $teksSisa = preg_replace($pattern, ' ', $teksSisa);
            }
        }

        return $terpilih->values();
    }

    protected static function cariPoli(array $keywords): ?Poli
    {
        foreach ($keywords as $kw) {
            $poli = Poli::where('status', 'active')->where('nama', 'like', "%{$kw}%")->first();
            if ($poli) {
                return $poli;
            }
        }

        return Poli::where('status', 'active')->where('nama', 'like', '%umum%')->first()
            ?? Poli::where('status', 'active')->first();
    }

    protected static function cariProduk(array $keywords): Collection
    {
        $hasil = collect();

        foreach ($keywords as $kw) {
            $cocok = Produk::where('status', 'active')
                ->where('nama', 'like', "%{$kw}%")
                ->orderBy('nama')
                ->get();
            $hasil = $hasil->concat($cocok)->unique('id');
            if ($hasil->count() >= 5) {
                break;
            }
        }

        if ($hasil->count() < 5) {
            $tambahan = Produk::where('status', 'active')
                ->where('kategori', 'obat')
                ->whereNotIn('id', $hasil->pluck('id')->all())
                ->orderBy('nama')
                ->take(5 - $hasil->count())
                ->get();
            $hasil = $hasil->concat($tambahan);
        }

        return $hasil->take(5)->values();
    }

    protected static function susunRingkasan(Collection $gejalas, array $meta, string $menang, float $confidence, string $urgensi, bool $redFlag, ?Poli $poli, Collection $produks, Collection $terdeteksi): string
    {
        $daftar = $gejalas->pluck('nama')->join(', ');
        $teks = "Dari {$gejalas->count()} gejala ({$daftar}), keluhan diklasifikasikan sebagai \"" . ($meta['label'] ?? $menang) . "\" dengan tingkat keyakinan {$confidence}%. ";

        if ($terdeteksi->isNotEmpty()) {
            $teks .= 'Sistem juga mendeteksi ' . $terdeteksi->pluck('nama')->join(', ') . ' dari deskripsi keluhan. ';
        }

        $teks .= $redFlag
            ? "Ditemukan gejala red-flag — urgensi TINGGI, prioritaskan penanganan. "
            : "Tingkat urgensi: {$urgensi}. ";

        $teks .= $poli
            ? "Disarankan dirujuk ke {$poli->nama}. "
            : 'Belum ada poli yang cocok, tentukan manual. ';

        if ($produks->isNotEmpty()) {
            $teks .= 'Produk pendukung: ' . $produks->pluck('nama')->join(', ') . '. ';
        }

        $teks .= ($meta['saran'] ?? '') . ' Hasil ini adalah saran awal, keputusan akhir tetap pada dokter.';

        return $teks;
    }
}
