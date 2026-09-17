<?php

namespace App\Filament\Resources\Galeries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GaleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path'),
                TextInput::make('nama')
                    ->required(),
                Select::make('status')
                    ->options(['active' => 'Active', 'non-active' => 'Non active'])
                    ->required(),
            ]);
    }
}
