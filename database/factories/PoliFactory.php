<?php

namespace Database\Factories;

use App\Models\Poli;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Poli>
 */
class PoliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->randomElement([
                'Poli Umum',
                'Poli Gigi',
                'Poli Anak',
                'Poli Mata',
            ]),
            'deskripsi' => fake()->sentence(),
            'status' => 'active'
        ];
    }
}
