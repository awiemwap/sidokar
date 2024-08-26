@extends('deskapp.app')
@section('tittle', ' Faximili Rahasia')
@section('judul', 'Faximili Rahasia')
@section('halaman', 'Faximili Rahasia')
@section('submenu', 'Ambil Faximili Rahasia')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ambil Nomor Faximili Rahasia</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('faximilirahasia.simpan') }}">
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
                  <label for="tujuan"><b>Penerima Faximili</b></label>
                  <input type="text" name="tujuan" class="form-control @error('tujuan') is-invalid @enderror" value="{{ old('tujuan') }}" id="tujuan" placeholder="">
            </div>
            @error('tujuan')
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
                <label><b>Unit/Fungsi</b></label>
                <select class="custom-select" name="unit">
                  <option>UIPUR</option>
                  <option>UIKSP</option>
                  <option>UMI</option>
                  <option>FDSEK</option>
                  <option>FPPU KI Syariah</option>
                  <option>Kehumasan</option>
                  <option>ICO</option>
                  <option>PM</option>
                  <option>TIM SPPURMI</option>
                  <option>TIM KEKDA</option>
                </select>
            </div>
            <a href="{{ route('faximilirahasia') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
