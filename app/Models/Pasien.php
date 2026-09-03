<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    /** @use HasFactory<\Database\Factories\PasienFactory> */
    use HasFactory;
    protected $table = 'pasiens';
    
    protected $guarded = [];

    public function dokter() {
        return $this->belongsTo(Dokter::class);
    }
}
