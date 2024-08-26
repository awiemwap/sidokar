<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahunmasehi extends Model
{
    use HasFactory; 

    protected $table= 'tahun_masehi';

    protected $fillable= ['tahun_masehi', 'tahun_buku', 'created_at', 'updated_at'];

    public function rubrik()
    {
        return $this->hasMany(Rubrik::class);
    }
    
}
