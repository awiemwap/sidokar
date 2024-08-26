<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id', 'tanggal_pemeliharaan', 'jenis_pemeliharaan', 'material', 'keterangan', 'bengkel', 'biaya'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
