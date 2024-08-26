@extends('deskapp.app')
@section('tittle', 'Nomor LDP UIKSPPSPPUR')
@section('judul', 'Nomor LDP UIKSPPSPPUR')
@section('halaman', 'Nomor LDP UIKSPPSPPUR')
@section('submenu', 'Nomor Ambil LDP UIKSPPSPPUR')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ambil Nomor LDP UIKSPPSPPUR</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('uikspldp.simpan') }}">
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
                <label><b>Unit/Fungsi Penerima</b></label>
                <select class="custom-select" name="tujuan">
                  <option>Semua Unit/Fungsi</option>
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

            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" value="{{ old('perihal') }}" id="perihal" placeholder="">
            </div>
            @error('perihal')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
              <label for="perihal"><b>Nominal (Khusus LDP BI ERP)</b></label>
              <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ old('nominal') }}" id="nominal" placeholder="Masukkan nominal pembayaran (format : 100000 tanpa titik koma), kosongkan jika tidak ada">
            </div>
           @error('nominal')
              <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <a href="{{ route('uikspldp') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
