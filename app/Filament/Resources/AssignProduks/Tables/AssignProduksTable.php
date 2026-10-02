<?php

namespace App\Filament\Resources\AssignProduks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AssignProduksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pasien.nama')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tanggal_assign')
                    ->label('Tanggal Assign')
                    ->date()
                    ->sortable(),
                TextColumn::make('daftar_produk')
                    ->label('Produk yang di-assign')
                    ->getStateUsing(fn ($record) => $record->items
                        ->map(fn ($item) => ($item->produk?->nama ?? '-') . ' ×' . $item->qty)
                        ->join(', '))
                    ->wrap()
                    ->limit(80),
                TextColumn::make('items_count')
                    ->label('Jml Item')
                    ->counts('items')
                    ->sortable(),
                TextColumn::make('total_qty')
                    ->label('Total Qty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('keterangan')
                    ->limit(30)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('pasien_id')
                    ->label('Pasien')
                    ->relationship('pasien', 'nama')
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
