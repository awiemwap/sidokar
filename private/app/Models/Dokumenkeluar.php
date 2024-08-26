<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumenkeluar extends Model
{
    use HasFactory;
    protected $fillable =['jenis_dokumen', 'tahun', 'jenis_dokumen', 'nomor', 'nominal', 'rubrik', 'tujuan','status', 'perihal', 'unit', 'user', 'created_at'];


    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalM01Biasa(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'MEMORANDUM M.01 BIASA')
    ->where('tahun', $tahun)
    ->count();
    }

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalM01Rhs(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'MEMORANDUM M.01 RAHASIA')
    ->where('tahun', $tahun)
    ->count();
    }

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalSuratBiasa(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'Surat Biasa')
    ->where('tahun', $tahun)
    ->count();
    }
    
    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalSuratRhs(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'Surat Rahasia')
    ->where('tahun', $tahun)
    ->count();
    }

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalFaximiliBiasa(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'Faximili Biasa')
    ->where('tahun', $tahun)
    ->count();
    }

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalFaximiliRhs(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'Faximili Rahasia')
    ->where('tahun', $tahun)
    ->count();
    }

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalUamERP(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'UAM ERP')
    ->where('tahun', $tahun)
    ->count();
    }
    
    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalUamCBS(){ 

    $tahun = now()->year;
    return Dokumenkeluar::where('jenis_dokumen', 'UAM CBS')
    ->where('tahun', $tahun)
    ->count();
    }


    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalBABiasa(){ 

        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Berita Acara Biasa')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalBARhs(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Berita Acara Rahasia')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalBAMA(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'BAMA')
        ->where('tahun', $tahun)
        ->count();
        }
        
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalBANA(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'BANA')
        ->where('tahun', $tahun)
        ->count();
        }

        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalBASTAM(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'BASTAM')
        ->where('tahun', $tahun)
        ->count();
        }
    
    

    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalRisalahBiasa(){ 

        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Risalah Rapat Biasa')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalRisalahRhs(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Risalah Rapat Rahasia')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalM02SatkerBiasa(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'M02 SATKER BIASA')
        ->where('tahun', $tahun)
        ->count();
        }
        
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalM02SatkerRhs(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'M02 SATKER RAHASIA')
        ->where('tahun', $tahun)
        ->count();
        }


    
    
    // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
    public static function totalM02CA(){ 

        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'M02 CA')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalPerjanjian(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Perjanjian')
        ->where('tahun', $tahun)
        ->count();
        }
    
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalKepGBI(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Keputusan GBI')
        ->where('tahun', $tahun)
        ->count();
        }
        
        // Fungsi untuk menghitung total dokumen berdasarkan tahun saat ini 
        public static function totalKepPBI(){ 
    
        $tahun = now()->year;
        return Dokumenkeluar::where('jenis_dokumen', 'Keputusan PBI')
        ->where('tahun', $tahun)
        ->count();
        }







}
