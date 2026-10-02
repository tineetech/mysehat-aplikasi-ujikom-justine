<?php

namespace App\Filament\Widgets;

use App\Models\Pasien;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PasienTrendChart extends ChartWidget
{
    protected ?string $heading = 'Tren Pendaftaran Pasien';

    protected ?string $description = 'Jumlah pasien baru per bulan (12 bulan terakhir).';

    protected static ?int $sort = -1;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $labels = [];
        $data = [];

        for ($i = 11; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subMonths($i);
            $labels[] = $bulan[$tanggal->month - 1] . ' ' . $tanggal->format('y');
            $data[] = Pasien::whereYear('created_at', $tanggal->year)
                ->whereMonth('created_at', $tanggal->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pasien baru',
                    'data' => $data,
                    'borderColor' => '#0f766e',
                    'backgroundColor' => 'rgba(15, 118, 110, 0.15)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
