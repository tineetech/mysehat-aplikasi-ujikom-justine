<?php

namespace App\Filament\Resources\AssignProduks\Pages;

use App\Filament\Resources\AssignProduks\AssignProdukResource;
use App\Models\Produk;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EditAssignProduk extends EditRecord
{
    protected static string $resource = AssignProdukResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['items'] = $this->record->items
            ->map(fn ($item) => [
                'produk_id' => $item->produk_id,
                'qty' => $item->qty,
                'harga_satuan' => (float) $item->harga_satuan,
                'subtotal' => (float) $item->subtotal,
            ])
            ->toArray();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $items = $data['items'] ?? [];
            unset($data['items']);

            if (empty($items)) {
                throw ValidationException::withMessages([
                    'items' => 'Tambahkan minimal 1 produk yang di-assign.',
                ]);
            }

            // Kembalikan stok lama dulu, baru hitung ulang dari data baru.
            foreach ($record->items()->with('produk')->get() as $old) {
                if ($old->produk) {
                    $old->produk->increment('stok', $old->qty);
                }
            }
            $record->items()->delete();

            $rows = [];
            $totalQty = 0;
            $totalHarga = 0;

            foreach ($items as $row) {
                $produk = Produk::lockForUpdate()->find($row['produk_id'] ?? null);
                $qty = (int) ($row['qty'] ?? 0);

                if (! $produk || $qty < 1) {
                    throw ValidationException::withMessages([
                        'items' => 'Ada baris produk yang tidak valid.',
                    ]);
                }

                if ($produk->stok < $qty) {
                    throw ValidationException::withMessages([
                        'items' => "Stok {$produk->nama} tidak cukup (tersedia {$produk->stok}, diminta {$qty}).",
                    ]);
                }

                $harga = (float) $produk->harga;
                $rows[] = [
                    'produk_id' => $produk->id,
                    'qty' => $qty,
                    'harga_satuan' => $harga,
                    'subtotal' => $qty * $harga,
                ];
                $totalQty += $qty;
                $totalHarga += $qty * $harga;
            }

            $data['total_qty'] = $totalQty;
            $data['total_harga'] = $totalHarga;

            $record->update($data);

            foreach ($rows as $row) {
                $record->items()->create($row);
                Produk::whereKey($row['produk_id'])->decrement('stok', $row['qty']);
            }

            return $record->refresh();
        });
    }
}
