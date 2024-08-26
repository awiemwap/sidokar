@extends('deskapp.app')
@section('tittle', 'M02 UMI Rahasia')
@section('judul', 'M02 UMI Rahasia')
@section('halaman', 'M02 UMI Rahasia')
@section('submenu', 'Ambil UMI Satker Rahasia')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ambil Nomor M02 UMI Rahasia</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('m02umirhs.simpan') }}">
          @csrf  
                  <input type="hidden" name="nomor" class="form-control" id="nomor" value="{{ $urutan }}">
                  <input type="hidden" name="tahun" class="form-control" id="tahun" value="{{ $carirubrik->tahun_masehi }}">
            <div class="form-group">
                  <label for="rubrik"><b>Nomor dan Rubrik Lengkap</b></label>
                  <input type="text" name="rubrik" class="form-control @error('rubrik') is-invalid @enderror" id="rubrik" value="{{ $rubrik }}" readonly="">
            </div>
            @error('rubrik')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror 
            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" id="perihal" placeholder="">
            </div>
            @error('perihal')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                  <label for="perihal"><b>Nominal</b></label>
                  <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" id="nominal" placeholder="Masukkan nominal pengadaan jika ada, kosongkan jika tidak ada">
            </div>
            @error('nominal')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
        
            <a href="{{ route('m02umirhs') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
