<?php

namespace App\Filament\Pages;

use App\Models\Gejala;
use App\Models\Pasien;
use App\Services\AnalisaGejalaService;
use App\Support\AnalisaDataset;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * Halaman analisa kebutuhan pasien: admin mengisi form lalu menekan
 * tombol Analisa untuk memproses hasil. Hanya menampilkan informasi,
 * tanpa menyimpan apa pun ke database.
 */
class AnalisaKebutuhan extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Analisa Kebutuhan';

    protected static ?string $title = 'Analisa Kebutuhan Pasien';

    protected static ?int $navigationSort = 5;

    /** Hasil analisa terakhir (array ringan, tanpa model Eloquent). */
    public ?array $hasilAnalisa = null;

    /** State form schema (wajib ada agar field ter-entangle ke Livewire). */
    public ?array $data = [
        'pasien_id' => null,
        'gejala_ids' => [],
        'deskripsi_keluhan' => null,
    ];

    public function mount(): void
    {
        $this->getSchema('content')->fill([
            'pasien_id' => null,
            'gejala_ids' => [],
            'deskripsi_keluhan' => null,
        ]);
    }

    public static function opsiGejala(): array
    {
        return Gejala::where('status', 'active')
            ->orderBy('kategori')
            ->orderBy('nama')
            ->get()
            ->mapWithKeys(fn (Gejala $g) => [$g->id => $g->nama . ' — ' . AnalisaDataset::label($g->kategori)])
            ->all();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('jalankanAnalisa')
                ->label('Jalankan Analisa AI')
                ->icon(Heroicon::OutlinedSparkles)
                ->color('primary')
                ->action(function (): void {
                    $state = $this->getSchema('content')->getState();
                    $rawIds = is_array($state['gejala_ids'] ?? null) ? $state['gejala_ids'] : [];
                    $ids = collect($rawIds)
                        ->filter(fn ($id) => is_numeric($id) && (int) $id > 0)
                        ->map(fn ($id) => (int) $id)
                        ->values()
                        ->all();

                    if (empty($ids)) {
                        Notification::make()
                            ->warning()
                            ->title('Belum ada gejala dipilih')
                            ->body('Centang minimal 1 gejala terlebih dahulu.')
                            ->send();

                        return;
                    }

                    $hasil = AnalisaGejalaService::analyze($ids, $state['deskripsi_keluhan'] ?? null);
                    $pasien = ! empty($state['pasien_id']) ? Pasien::find($state['pasien_id']) : null;

                    $this->hasilAnalisa = [
                        'pasien' => $pasien?->nama ?? '—',
                        'kategori' => $hasil['kategori'] ?? '—',
                        'confidence' => $hasil['confidence'],
                        'urgensi' => $hasil['urgensi'] ?? '—',
                        'poli' => $hasil['poli']?->nama ?? '—',
                        'produks' => $hasil['produks']->pluck('nama')->all(),
                        'skor' => collect($hasil['skor'])
                            ->map(fn ($v, $k) => AnalisaDataset::label($k) . ": {$v}")
                            ->values()
                            ->all(),
                        'terdeteksi' => $hasil['terdeteksi'],
                        'ringkasan' => $hasil['ringkasan'] ?? '—',
                    ];

                    Notification::make()
                        ->success()
                        ->title('Analisa selesai')
                        ->body("Keluhan terklasifikasi sebagai {$this->hasilAnalisa['kategori']}.")
                        ->send();
                }),
            Action::make('resetHasil')
                ->label('Reset')
                ->color('gray')
                ->action(function (): void {
                    $this->hasilAnalisa = null;
                    $this->getSchema('content')->fill([
                        'pasien_id' => null,
                        'gejala_ids' => [],
                        'deskripsi_keluhan' => null,
                    ]);
                }),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Data Pasien')
                    ->description('Pilih pasien yang akan dianalisa.')
                    ->schema([
                        Select::make('pasien_id')
                            ->label('Pasien')
                            ->options(fn () => Pasien::where('status', 'active')->orderBy('nama')->pluck('nama', 'id'))
                            ->searchable()
                            ->preload(),
                    ]),

                Section::make('Gejala Pasien')
                    ->description('Centang semua gejala yang dirasakan (bisa multiple), lalu tulis deskripsi keluhan bila ada.')
                    ->schema([
                        CheckboxList::make('gejala_ids')
                            ->label('Daftar Gejala')
                            ->options(self::opsiGejala())
                            ->searchable()
                            ->bulkToggleable()
                            ->default([])
                            ->columns(2)
                            ->columnSpanFull(),
                        Textarea::make('deskripsi_keluhan')
                            ->label('Deskripsi Keluhan')
                            ->placeholder('Contoh: sudah 3 hari demam naik turun disertai batuk berdahak…')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Hasil Analisa AI')
                    ->description('Tekan tombol Jalankan Analisa AI di atas untuk memproses. Informasi saja, tidak disimpan ke database.')
                    ->visible(fn (): bool => filled($this->hasilAnalisa))
                    ->schema([
                        Placeholder::make('hasil_pasien')
                            ->label('Pasien')
                            ->content(fn (): string => $this->hasilAnalisa['pasien'] ?? '—'),
                        Placeholder::make('hasil_urgensi')
                            ->label('Urgensi')
                            ->content(fn (): string => $this->hasilAnalisa['urgensi'] ?? '—'),
                        Placeholder::make('hasil_kategori')
                            ->label('Klasifikasi Kategori')
                            ->content(fn (): string => ($this->hasilAnalisa['kategori'] ?? '—') . ' — keyakinan ' . ($this->hasilAnalisa['confidence'] ?? 0) . '%')
                            ->columnSpanFull(),
                        Placeholder::make('hasil_skor')
                            ->label('Distribusi Skor')
                            ->content(fn (): string => ! empty($this->hasilAnalisa['skor'] ?? []) ? implode(' · ', $this->hasilAnalisa['skor']) : '—')
                            ->columnSpanFull(),
                        Placeholder::make('hasil_poli')
                            ->label('Rekomendasi Poli')
                            ->content(fn (): string => $this->hasilAnalisa['poli'] ?? '—'),
                        Placeholder::make('hasil_produk')
                            ->label('Rekomendasi Produk')
                            ->content(fn (): string => ! empty($this->hasilAnalisa['produks'] ?? []) ? implode(', ', $this->hasilAnalisa['produks']) : '—')
                            ->columnSpanFull(),
                        Placeholder::make('hasil_terdeteksi')
                            ->label('Terdeteksi Dari Deskripsi')
                            ->content(fn (): string => ! empty($this->hasilAnalisa['terdeteksi'] ?? []) ? implode(', ', $this->hasilAnalisa['terdeteksi']) : '—')
                            ->columnSpanFull(),
                        Placeholder::make('hasil_ringkasan')
                            ->label('Ringkasan Analisa')
                            ->content(fn (): ?string => $this->hasilAnalisa['ringkasan'] ?? null)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
