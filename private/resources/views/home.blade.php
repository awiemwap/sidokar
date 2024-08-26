@extends('deskapp.app')
@section('tittle', 'Dashboard')
@section('judul', 'Dashboard')
@section('halaman', 'Dashboard')
@section('container')
<div class="row pb-10">
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalM01Biasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                JUmlah M.01 Satker Biasa   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalM01Rhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah M.01 Satker Rahasia   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalSuratBiasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Surat Biasa  
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalSuratRhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Surat Rahasia   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>
<div class="row pb-10">
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalFaximiliBiasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Faximili Biasa   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalFaximiliRhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Faximili Rahasia   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalUamERP()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah UAM ERP  
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalUamCBS()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah UAM CBS   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>



<div class="row pb-10">
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalBABiasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Berita Acara Biasa   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalBARhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Berita Acara Rahasia   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalBAMA()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah BAMA 
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalBANA()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah BANA  
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>


<div class="row pb-10">
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalRisalahBiasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Risalah Rapat Biasa   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalRisalahRhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Risalah Rapat Rahasia   
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalM02SatkerBiasa()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah M.02 Satker Biasa
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalM02SatkerRhs()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah M.02 Satker Rahasia  
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>


<div class="row pb-10">
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalM02CA()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah M.02 CA
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalPerjanjian()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Perjanjian  
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalKepGBI()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Keputusan GBI
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
    <div class="card-box height-100-p widget-style3">
        <div class="d-flex flex-wrap">
            <div class="widget-data">
                <div class="weight-700 font-24 text-dark">{{ App\Models\Dokumenkeluar::totalKepPBI()}}</div>
                <div class="font-14 text-secondary weight-500">
                Jumlah Keputusan PBI 
                </div>
            </div>
            <div class="widget-icon">
                <div class="icon" data-color="#00eccf">
                    <i class="icon-copy bi bi-calculator"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>

@endsection
