<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koderubrik extends Model
{
    use HasFactory;
    protected $table= 'kode';
    protected $fillable= ['id', 'kode'];
    
}
