@extends('deskapp.app')
@section('tittle', 'TV.01 UIKSPPSPPUR')
@section('judul', 'TV.01 UIKSPPSPPUR')
@section('halaman', 'TV.01 UIKSPPSPPUR')
@section('submenu', 'Ambil TV.01 UIKSPPSPPUR')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ambil Nomor TV.01 UIKSPPSPPUR</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('uiksptv01.simpan') }}">
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
                  <label for="pelaksana"><b>Pelaksana PDDN</b></label>
                  <input type="text" name="pelaksana" class="form-control @error('pelaksana') is-invalid @enderror" value="{{ old('pelaksana') }}" id="pelaksana" placeholder="">
            </div>
            @error('pelaksana')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                  <label for="perihal"><b>Kegiatan PDDN</b></label>
                  <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror" value="{{ old('kegiatan') }}" id="kegiatan" placeholder="">
            </div>
            @error('kegiatan')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                  <label for="kota"><b>Kota Tujuan PDDN</b></label>
                  <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror" value="{{ old('kota') }}" id="kota" placeholder="">
            </div>
            @error('kota')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <a href="{{ route('uiksptv01') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
