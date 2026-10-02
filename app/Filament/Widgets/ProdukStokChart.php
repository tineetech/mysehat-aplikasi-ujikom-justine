<?php

namespace App\Filament\Widgets;

use App\Models\Produk;
use Filament\Widgets\ChartWidget;

class ProdukStokChart extends ChartWidget
{
    protected ?string $heading = 'Stok Produk';

    protected ?string $description = 'Sisa stok per produk (10 tertinggi).';

    protected static ?int $sort = 0;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $produks = Produk::orderBy('stok', 'desc')->take(10)->get();

        return [
            'datasets' => [
                [
                    'label' => 'Stok',
                    'data' => $produks->pluck('stok')->all(),
                    'backgroundColor' => 'rgba(15, 118, 110, 0.75)',
                    'borderColor' => '#0f766e',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $produks->pluck('nama')->all(),
        ];
    }
}
