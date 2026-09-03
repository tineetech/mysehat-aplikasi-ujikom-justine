<?php

namespace App\Filament\Resources\Pasiens\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PasienForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nik')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Select::make('dokter_id')
                    ->relationship('dokter', 'nama')
                    ->searchable()
                    ->preload()
                    ->default(null),
                DatePicker::make('tanggal_lahir'),
                Select::make('jenis_kelamin')
                    ->options(['pria' => 'Pria', 'wanita' => 'Wanita'])
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->options(['active' => 'Active', 'non-active' => 'Non active'])
                    ->required(),
            ]);
    }
}
