@extends('deskapp.app')
@section('tittle', 'M02 Tim KEKDA Biasa')
@section('judul', 'M02 Tim KEKDA Biasa')
@section('halaman', 'M02 Tim KEKDA Biasa')
@section('submenu', 'Ambil Tim KEKDA Biasa')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ambil Nomor M02 Tim KEKDA Biasa</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('m02kekdabiasa.simpan') }}">
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
                  <label><b>Fungsi Pembuat</b></label>
                  <select class="custom-select" name="unit">
                    <option>Tim KEKDA</option>
                    <option>FDSEK</option>
                    <option>Seksi Kehumasan</option>
                    <option>FPPU KIS</option>
                  </select>
              </div>
            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" id="perihal" placeholder="">
            </div>
            @error('perihal')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                  <label for="perihal"><b>Nominal</b></label>
                  <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" id="nominal" placeholder="Masukkan nominal pengadaan (format : 100000 tanpa titik koma), kosongkan jika tidak ada">
            </div>
            @error('nominal')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
        
            <a href="{{ route('m02kekdabiasa') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
