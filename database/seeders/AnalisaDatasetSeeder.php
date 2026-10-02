<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Support\AnalisaDataset;
use Illuminate\Database\Seeder;

class AnalisaDatasetSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AnalisaDataset::GEJALA as $row) {
            Gejala::updateOrCreate(
                ['kode' => $row['kode']],
                ['nama' => $row['nama'], 'kategori' => $row['kategori'], 'status' => 'active'],
            );
        }
    }
}
