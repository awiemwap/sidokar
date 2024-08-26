<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nopol', 'merk', 'jenis', 'tahun', 'warna', 'noka', 'tipe', 'noka', 'stnk', 'pajak'
    ];

    public function pemeliharaan()
    {
        return $this->hasMany(Pemeliharaan::class);
    }
}
