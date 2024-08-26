@extends('deskapp.app')
@section('tittle', ' Edit M01 Rahasia By Admin')
@section('judul', 'Memorandum M01 Rahasia')
@section('halaman', 'Memorandum M01 Rahasia')
@section('submenu', 'Edit M01 Rahasia By Admin')
@section('container')
<div class="pd-20 card-box mb-30">
     <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Nomor M.01 Rahasia By Admin</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./m01rahasia/store">
            {{ method_field('patch') }}
            @csrf
            <input type="hidden" name="id" value="{{ $show->id}}">  
            <div class="form-group">
                  <label for="rubrik"><b>Nomor Agenda</b></label>
                  <input type="text" name="nomor" class="form-control" id="nomor" value="{{ $show->nomor }}" >
            </div>
            <div class="form-group">
                  <label for="rubrik"><b>Tahun Buku</b></label>
                  <input type="text" name="tahun" class="form-control" id="tahun" value="{{ $show->tahun }}" >
            </div>   
            <div class="form-group">
                  <label for="rubrik"><b>Nomor dan Rubrik Lengkap</b></label>
                  <input type="text" name="rubrik" class="form-control" id="rubrik" value="{{ $show->rubrik }}" >
            </div>
            <div class="form-group">
                  <label for="rubrik"><b>Tanggal M.O1</b></label>
                  <input type="text" name="tanggal" class="form-control" id="rubrik" value="{{ $show->created_at }}" >
            </div>
            <div class="form-group">
                  <label for="tujuan"><b>Satker Penerima</b></label>
                  <input type="text" name="tujuan" class="form-control" id="tujuan" value="{{ $show->tujuan }}">
            </div>
            @error('tujuan')
                  <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
            <a href="{{ route('m01rahasia') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection