<?php

namespace App\Filament\Resources\AssignProduks;

use App\Filament\Resources\AssignProduks\Pages\CreateAssignProduk;
use App\Filament\Resources\AssignProduks\Pages\EditAssignProduk;
use App\Filament\Resources\AssignProduks\Pages\ListAssignProduks;
use App\Filament\Resources\AssignProduks\Schemas\AssignProdukForm;
use App\Filament\Resources\AssignProduks\Tables\AssignProduksTable;
use App\Models\ProdukAssign;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AssignProdukResource extends Resource
{
    protected static ?string $model = ProdukAssign::class;

    protected static ?string $modelLabel = 'Assign Produk';

    protected static ?string $pluralModelLabel = 'Assign Produk';

    protected static UnitEnum|string|null $navigationGroup = 'Produk';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return AssignProdukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AssignProduksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssignProduks::route('/'),
            'create' => CreateAssignProduk::route('/create'),
            'edit' => EditAssignProduk::route('/{record}/edit'),
        ];
    }
}
