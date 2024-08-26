@extends('deskapp.app')
@section('tittle', ' Edit M02 CA')
@section('judul', 'M02 Satker CA')
@section('halaman', 'M02 Satker CA')
@section('submenu', 'Ubah M02 CA')
@section('container')
<div class="pd-20 card-box mb-30">
  <div class="clearfix">
     <div class="pull-left">
       <h3 class="text-blue h4">Form Ubah Nomor M02 CA</h3>
     </div>
  </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./m02CA/update">
            {{ method_field('patch') }}
            @csrf  
                  <input type="hidden" name="id" value="{{ $show->id}}"> 
            <div class="form-group">
                  <label for="rubrik"><b>Nomor dan Rubrik Lengkap</b></label>
                  <input type="text" name="rubrik" class="form-control" id="rubrik" value="{{ $show->rubrik }}" readonly="">
            </div>
            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control" id="perihal" value="{{ $show->perihal }}">
            </div>
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
            <a href="{{ route('m02CA') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection

