<?php

namespace App\Filament\Resources\AssignProduks\Pages;

use App\Filament\Resources\AssignProduks\AssignProdukResource;
use App\Models\Produk;
use App\Models\ProdukAssign;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CreateAssignProduk extends CreateRecord
{
    protected static string $resource = AssignProdukResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data) {
            $items = $data['items'] ?? [];
            unset($data['items']);

            if (empty($items)) {
                throw ValidationException::withMessages([
                    'items' => 'Tambahkan minimal 1 produk yang di-assign.',
                ]);
            }

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

            /** @var ProdukAssign $assign */
            $assign = ProdukAssign::create($data);

            foreach ($rows as $row) {
                $assign->items()->create($row);
                Produk::whereKey($row['produk_id'])->decrement('stok', $row['qty']);
            }

            return $assign;
        });
    }
}
