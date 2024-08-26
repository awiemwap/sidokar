<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisdokumen extends Model
{
    use HasFactory;
    protected $table= 'jenis_dokumen';
    protected $fillable= ['jenis_dokumen', 'keterangan'];
    
}
