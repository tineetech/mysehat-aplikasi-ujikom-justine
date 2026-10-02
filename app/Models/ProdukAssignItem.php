<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukAssignItem extends Model
{
    use HasFactory;

    protected $table = 'produk_assign_items';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'harga_satuan' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function assign()
    {
        return $this->belongsTo(ProdukAssign::class, 'produk_assign_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
