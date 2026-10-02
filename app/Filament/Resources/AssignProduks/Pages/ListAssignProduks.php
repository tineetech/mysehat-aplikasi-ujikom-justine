<?php

namespace App\Filament\Resources\AssignProduks\Pages;

use App\Filament\Resources\AssignProduks\AssignProdukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAssignProduks extends ListRecords
{
    protected static string $resource = AssignProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
