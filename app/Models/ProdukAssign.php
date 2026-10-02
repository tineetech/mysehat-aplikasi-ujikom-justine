<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAssign extends Model
{
    use HasFactory;

    protected $table = 'produk_assigns';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'tanggal_assign' => 'date',
            'total_harga' => 'decimal:2',
        ];
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function items()
    {
        return $this->hasMany(ProdukAssignItem::class, 'produk_assign_id');
    }

    protected static function booted(): void
    {
        // Kembalikan stok saat data assign dihapus (single maupun bulk).
        static::deleting(function (ProdukAssign $assign) {
            foreach ($assign->items()->with('produk')->get() as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->qty);
                }
            }
        });
    }
}
