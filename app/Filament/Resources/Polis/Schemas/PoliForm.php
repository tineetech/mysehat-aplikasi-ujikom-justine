<?php

namespace App\Filament\Resources\Polis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PoliForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')->label('Nama Poli')->required()->maxLength(255),
                Textarea::make('deskripsi')->label('Deskripsi'),
                Select::make('status')->options([
                    'active' => "Active",
                    'non-active' => "Tidak Active",
                ])->default('active')->required()
            ]);
    }
}
