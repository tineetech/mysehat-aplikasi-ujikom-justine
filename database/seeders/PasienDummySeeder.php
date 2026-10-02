<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienDummySeeder extends Seeder
{
    public function run(): void
    {
        $dokterIds = Dokter::pluck('id');

        if ($dokterIds->isEmpty()) {
            $this->command?->warn('Tidak ada dokter, lewati seeder pasien.');

            return;
        }

        $faker = fake();
        $need = max(0, 50 - Pasien::count());

        for ($i = 0; $i < $need; $i++) {
            Pasien::create([
                'nik' => $faker->unique()->numerify('################'),
                'nama' => $faker->name(),
                'dokter_id' => $dokterIds->random(),
                'tanggal_lahir' => $faker->dateTimeBetween('1960-01-01', '2020-12-31')->format('Y-m-d'),
                'jenis_kelamin' => $faker->randomElement(['pria', 'wanita']),
                'phone' => (int) $faker->numerify('8########'),
                'status' => $faker->randomElement(['active', 'active', 'active', 'non-active']),
            ]);
        }
    }
}
