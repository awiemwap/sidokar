@extends('deskapp.app')
@section('tittle', 'Nomor LDP UIKSPPSPPUR Backdate')
@section('judul', 'Nomor LDP UIKSPPSPPUR Backdate')
@section('halaman', 'Nomor LDP UIKSPPSPPUR Backdate')
@section('submenu', 'Ambil Nomor LDP UIKSPPSPPUR Backdate')
@section('container')
<div class="pd-20 card-box mb-30">
  <div class="clearfix">
     <div class="pull-left">
       <h3 class="text-blue h4">Form Ambil Nomor LDP UIKSPPSPPUR Backdate</h3>
     </div>
    </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./uikspldp/backdateStore">
            {{ method_field('patch') }}
            @csrf  
            <input type="hidden" name="id" value="{{ $show->id}}">
            <input type="hidden" name="nomor" class="form-control" value="{{ $show->nomor }}" readonly="">
            <input type="hidden" name="tahun" class="form-control" value="{{ $show->tahun }}" readonly="">      
            <input type="hidden" name="created_at" class="form-control" value="{{ $show->created_at }}" readonly="">      
            <div class="form-group">
              <label for="rubrik"><b>Rubrik Lengkap</b></label>
              <input type="text" name="rubrik" class="form-control @error('rubrik') is-invalid @enderror" id="rubrik" value="{{ $show->rubrik }}">
            </div>
            <div class="alert alert-info" role="alert">Silakan tambahkan Alphabet pada nomor rubrik, contoh No.26/1A/Kd-UIKSPPSPPUR/LDP/B</div> 
            @error('rubrik')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label><b>Unit/Fungsi Penerima</b></label>
                <select class="custom-select" name="tujuan">
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
                <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" id="perihal" value="{{ old('perihal') }}">
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
