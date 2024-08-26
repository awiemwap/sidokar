<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenunit extends Model
{
    use HasFactory;
    protected $fillable =['jenis_dokumen', 'tahun', 'jenis_dokumen', 'nomor', 'unit', 'rubrik', 'pelaksana', 'kegiatan', 'kota', 'tujuan','status', 'perihal', 'nominal',  'user', 'created_at'];
}
