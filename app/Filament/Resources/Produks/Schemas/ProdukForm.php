<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('gambar'),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('deskripsi')
                    ->default(null),
                Select::make('kategori')
                    ->options(['obat' => 'Obat', 'perban' => 'Perban', 'alat_bantu' => 'Alat bantu'])
                    ->required(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(['active' => 'Active', 'non-active' => 'Non active'])
                    ->required(),
            ]);
    }
}
