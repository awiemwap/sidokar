@extends('deskapp.app')
@section('tittle', ' Edit M02 Tim KEKDA By Admin')
@section('judul', 'M02 Tim KEKDA Rahasia')
@section('halaman', 'M02 Tim KEKDA Rahasia')
@section('submenu', 'Edit M02 Tim KEKDA Rahasia By Admin')
@section('container')
<div class="pd-20 card-box mb-30">
     <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Nomor M02 Tim KEKDA Rahasia Biasa By Admin</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./m02kekdarhs/store">
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
                  <label for="rubrik"><b>Tanggal M02</b></label>
                  <input type="text" name="tanggal" class="form-control" id="rubrik" value="{{ $show->created_at }}" >
            </div>
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
                  <input type="text" name="perihal" class="form-control" id="perihal" value="{{ $show->perihal }}">
            </div>
            <div class="form-group">
                  <label for="perihal"><b>Nominal</b></label>
                  <input type="text" name="nominal" class="form-control" id="nominal" value="{{ $show->nominal }}" placeholder="Masukkan nominal pengadaan (format : 100000 tanpa titik koma), kosongkan jika tidak ada">
            </div>
            
            <a href="{{ route('m02kekdarhs') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection