<?php

namespace App\Filament\Resources\Dokters\Schemas;

use App\Models\Poli;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DokterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('poli_id')
                    // ->options(Poli::pluck('nama', 'id'))
                    ->relationship('poli', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('spesialis')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options(['pria' => 'Pria', 'wanita' => 'Wanita'])
                    ->required(),
                TextInput::make('phone')
                    // ->tel()
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->default('active')
                    ->options(['active' => 'Active', 'non-active' => 'Non active'])
                    ->required(),
            ]);
    }
}
