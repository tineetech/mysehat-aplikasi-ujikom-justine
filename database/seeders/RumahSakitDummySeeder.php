<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class RumahSakitDummySeeder extends Seeder
{
    public function run(): void
    {
        $tht = Poli::updateOrCreate(
            ['nama' => 'Poli THT'],
            ['deskripsi' => 'Poli telinga, hidung, dan tenggorokan.', 'status' => 'active'],
        );

        foreach ([
            ['nama' => 'dr. Andi Pratama', 'spesialis' => 'THT', 'jenis_kelamin' => 'pria'],
            ['nama' => 'dr. Sinta Maharani', 'spesialis' => 'THT', 'jenis_kelamin' => 'wanita'],
        ] as $dokter) {
            Dokter::updateOrCreate(
                ['nama' => $dokter['nama']],
                [...$dokter, 'poli_id' => $tht->id, 'status' => 'active'],
            );
        }

        foreach ([
            ['nama' => 'Poli Paru', 'deskripsi' => 'Poli paru dan pernapasan.'],
            ['nama' => 'Poli Penyakit Dalam', 'deskripsi' => 'Poli penyakit dalam dan infeksi.'],
            ['nama' => 'Poli Jantung', 'deskripsi' => 'Poli jantung dan pembuluh darah.'],
            ['nama' => 'Poli Saraf', 'deskripsi' => 'Poli saraf dan otak.'],
            ['nama' => 'Poli Ortopedi', 'deskripsi' => 'Poli tulang dan sendi.'],
            ['nama' => 'Poli Kulit', 'deskripsi' => 'Poli kulit dan kelamin.'],
            ['nama' => 'Poli Anak', 'deskripsi' => 'Poli kesehatan anak.'],
            ['nama' => 'Poli Kandungan', 'deskripsi' => 'Poli kandungan dan kebidanan.'],
        ] as $poli) {
            Poli::updateOrCreate(['nama' => $poli['nama']], [...$poli, 'status' => 'active']);
        }

        $dokterBaru = [
            'Poli Paru' => [['nama' => 'dr. Bambang Sutrisno', 'jk' => 'pria'], ['nama' => 'dr. Ratna Dewi', 'jk' => 'wanita']],
            'Poli Penyakit Dalam' => [['nama' => 'dr. Hendra Gunawan', 'jk' => 'pria'], ['nama' => 'dr. Maya Putri', 'jk' => 'wanita']],
            'Poli Jantung' => [['nama' => 'dr. Fajar Nugroho', 'jk' => 'pria'], ['nama' => 'dr. Intan Permata', 'jk' => 'wanita']],
            'Poli Saraf' => [['nama' => 'dr. Dedi Kurniawan', 'jk' => 'pria'], ['nama' => 'dr. Lina Hartati', 'jk' => 'wanita']],
            'Poli Ortopedi' => [['nama' => 'dr. Agus Wijaya', 'jk' => 'pria'], ['nama' => 'dr. Dewi Anggraini', 'jk' => 'wanita']],
            'Poli Kulit' => [['nama' => 'dr. Rudi Hermawan', 'jk' => 'pria'], ['nama' => 'dr. Nina Kurnia', 'jk' => 'wanita']],
            'Poli Anak' => [['nama' => 'dr. Budi Santoso', 'jk' => 'pria'], ['nama' => 'dr. Rina Marlina', 'jk' => 'wanita']],
            'Poli Kandungan' => [['nama' => 'dr. Wahyu Hidayat', 'jk' => 'pria'], ['nama' => 'dr. Sari Wulandari', 'jk' => 'wanita']],
            'Poli Mata' => [['nama' => 'dr. Eko Saputra', 'jk' => 'pria'], ['nama' => 'dr. Fitri Handayani', 'jk' => 'wanita']],
            'Poli Umum' => [['nama' => 'dr. Yoga Prasetyo', 'jk' => 'pria'], ['nama' => 'dr. Dian Puspita', 'jk' => 'wanita']],
            'Poli Gigi' => [['nama' => 'drg. Rina Kusuma', 'jk' => 'wanita']],
        ];

        foreach ($dokterBaru as $namaPoli => $daftar) {
            $poli = Poli::where('nama', $namaPoli)->first();
            if (! $poli) {
                continue;
            }
            foreach ($daftar as $dokter) {
                Dokter::updateOrCreate(
                    ['nama' => $dokter['nama']],
                    ['poli_id' => $poli->id, 'spesialis' => trim(str_replace('Poli', '', $namaPoli)), 'jenis_kelamin' => $dokter['jk'], 'status' => 'active'],
                );
            }
        }

        foreach ([
            ['nama' => 'Amoxicillin 500 mg', 'harga' => 45000, 'stok' => 120, 'deskripsi' => 'Antibiotik untuk infeksi bakteri termasuk radang.'],
            ['nama' => 'Paracetamol 500 mg', 'harga' => 15000, 'stok' => 300, 'deskripsi' => 'Pereda demam dan nyeri.'],
            ['nama' => 'Ibuprofen 400 mg', 'harga' => 22000, 'stok' => 210, 'deskripsi' => 'Pereda nyeri dan anti radang.'],
            ['nama' => 'Cetirizine 10 mg', 'harga' => 18000, 'stok' => 160, 'deskripsi' => 'Anti alergi untuk gatal dan ruam.'],
            ['nama' => 'Omeprazole 20 mg', 'harga' => 35000, 'stok' => 95, 'deskripsi' => 'Obat lambung dan maag.'],
            ['nama' => 'Vitamin C 1000 mg', 'harga' => 40000, 'stok' => 250, 'deskripsi' => 'Suplemen daya tahan tubuh.'],
            ['nama' => 'Cefixime 200 mg', 'harga' => 55000, 'stok' => 90, 'deskripsi' => 'Antibiotik spektrum luas untuk infeksi.'],
            ['nama' => 'Salbutamol Inhaler', 'harga' => 65000, 'stok' => 60, 'deskripsi' => 'Pereda sesak napas dan asma.'],
        ] as $produk) {
            Produk::updateOrCreate(
                ['nama' => $produk['nama']],
                [...$produk, 'kategori' => 'obat', 'status' => 'active'],
            );
        }
    }
}
