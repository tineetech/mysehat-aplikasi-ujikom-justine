<?php

namespace App\Filament\Resources\AssignProduks\Schemas;

use App\Models\Produk;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class AssignProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Assign')
                    ->schema([
                        Select::make('pasien_id')
                            ->label('Pasien')
                            ->relationship('pasien', 'nama')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
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
                                    ->default('active')
                                    ->required(),
                            ])
                            ->createOptionModalHeading('Tambah Pasien Baru'),
                        DatePicker::make('tanggal_assign')
                            ->label('Tanggal Assign')
                            ->required()
                            ->default(now()),
                        Textarea::make('keterangan')
                            ->columnSpanFull()
                            ->rows(2)
                            ->default(null),
                    ])
                    ->columnSpan('full')
                    ->columns(2),

                Section::make('Daftar Produk')
                    ->description('Pilih produk, setiap pilihan langsung masuk ke daftar di bawah. Total dihitung otomatis.')
                    ->columnSpan('full')
                    ->schema([
                        Repeater::make('items')
                            ->label('Produk yang di-assign')
                            ->schema([
                                Select::make('produk_id')
                                    ->label('Produk')
                                    ->options(fn () => Produk::where('status', 'active')->orderBy('nama')->pluck('nama', 'id'))
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->columnSpan(5)
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        $produk = $state ? Produk::find($state) : null;
                                        $harga = $produk ? (float) $produk->harga : 0;
                                        $set('harga_satuan', $harga);
                                        $set('subtotal', $harga * (int) ($get('qty') ?? 1));
                                    }),
                                TextInput::make('qty')
                                    ->label('Qty')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->default(1)
                                    ->live(onBlur: true)
                                    ->columnSpan(2)
                                    ->helperText(function (Get $get): ?string {
                                        $produk = $get('produk_id') ? Produk::find($get('produk_id')) : null;

                                        return $produk ? "Stok tersedia: {$produk->stok}" : null;
                                    })
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        $set('subtotal', (int) $state * (float) ($get('harga_satuan') ?? 0));
                                    }),
                                TextInput::make('harga_satuan')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->default(0)
                                    ->columnSpan(2),
                                TextInput::make('subtotal')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->default(0)
                                    ->columnSpan(3),
                            ])
                            ->columns(12)
                            ->minItems(1)
                            ->addActionLabel('Tambah produk')
                            ->live()
                            ->columnSpanFull(),
                    ]),

                Section::make('Total')
                    ->description('Dihitung otomatis dari daftar produk di atas.')
                    ->columnSpan('full')
                    ->schema([
                        Placeholder::make('total_qty_display')
                            ->label('Total Qty')
                            ->content(function (Get $get): string {
                                $qty = 0;
                                foreach (($get('items') ?? []) as $item) {
                                    $qty += max(0, (int) ($item['qty'] ?? 0));
                                }

                                return (string) $qty;
                            }),
                        Placeholder::make('total_harga_display')
                            ->label('Total Harga')
                            ->content(function (Get $get): string {
                                $total = 0;
                                foreach (($get('items') ?? []) as $item) {
                                    $total += max(0, (int) ($item['qty'] ?? 0)) * (float) ($item['harga_satuan'] ?? 0);
                                }

                                return 'Rp' . number_format($total, 0, ',', '.');
                            }),
                    ])
                    ->columns(2),
            ]);
    }
}
