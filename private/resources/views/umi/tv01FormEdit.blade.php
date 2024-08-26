@extends('deskapp.app')
@section('tittle', ' Edit TV 01 UMI By Admin')
@section('judul', 'TV 01 UMI')
@section('halaman', 'TV 01 UMI')
@section('submenu', 'Edit TV 01 UMI By Admin')
@section('container')
<div class="pd-20 card-box mb-30">
     <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Nomor TV 01 UMI  By Admin</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./umitv01/store">
            {{ method_field('patch') }}
            @csrf
            <input type="hidden" name="id" value="{{ $show->id}}">  
            <div class="form-group">
                  <label for="rubrik"><b>Nomor Agenda</b></label>
                  <input type="text" name="nomor" class="form-control" id="nomor" value="{{ $show->nomor }}" >
            </div>
            <div class="form-group">
                  <label for="rubrik"><b>Tahun Anggaran</b></label>
                  <input type="text" name="tahun" class="form-control" id="tahun" value="{{ $show->tahun }}" >
            </div>   
            <div class="form-group">
                  <label for="rubrik"><b>Nomor dan Rubrik Lengkap</b></label>
                  <input type="text" name="rubrik" class="form-control" id="rubrik" value="{{ $show->rubrik }}" >
            </div>
            <div class="form-group">
                  <label for="rubrik"><b>Tanggal TV 01</b></label>
                  <input type="text" name="tanggal" class="form-control" id="rubrik" value="{{ $show->created_at }}" >
            </div>
            <div class="form-group">
                  <label for="pelaksana"><b>pelaksana PDDN</b></label>
                  <input type="text" name="pelaksana" class="form-control" id="pelaksana" value="{{ $show->pelaksana }}">
            </div>
            <div class="form-group">
                  <label for="kota"><b>Kota Tujuan PDDN</b></label>
                  <input type="text" name="kota" class="form-control" id="kota" value="{{ $show->kota }}" placeholder="">
            </div>
            
            <a href="{{ route('umitv01') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection