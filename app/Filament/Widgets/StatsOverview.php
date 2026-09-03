<?php

namespace App\Filament\Widgets;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poli;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pasien', Pasien::count())
                ->description('Jumlah seluruh pasien')
                ->icon('heroicon-o-users'),

            Stat::make('Total Dokter', Dokter::count())
                ->description('Dokter terdaftar')
                ->icon('heroicon-o-user'),

            Stat::make('Total Poli', Poli::count())
                ->description('Poli tersedia')
                ->icon('heroicon-o-building-office'),

        ];
    }
}