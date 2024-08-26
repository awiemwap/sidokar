<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    use HasFactory;

    protected $table= 'rubrik';

    protected $fillable= ['nomor', 'tahun_buku', 'tahun_masehi', 'rubrik', 'jenis_dokumen'];
    
    public function tahun_masehi(){
        return $this->belongsTo(Tahunmasehi::class);
    }
}
