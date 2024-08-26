@extends('deskapp.app')
@section('tittle', ' Edit nomro Batch By Admin')
@section('judul', 'Nomor Batch')
@section('halaman', 'Nomor Batch')
@section('submenu', 'Edit Nomor Batch By Admin')
@section('container')
<div class="pd-20 card-box mb-30">
     <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Nomor Batch By Admin</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./batch/store">
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
                  <label for="rubrik"><b>Nomor Batch ERP</b></label>
                  <input type="text" name="rubrik" class="form-control" id="rubrik" value="{{ $show->rubrik }}" >
            </div>
            <div class="form-group">
                  <label for="rubrik"><b>Tanggal</b></label>
                  <input type="text" name="tanggal" class="form-control" id="rubrik" value="{{ $show->created_at }}" >
            </div>
            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control" id="perihal" value="{{ $show->perihal }}">
            </div>
            <div class="form-group">
                  <label for="perihal"><b>Nominal</b></label>
                  <input type="text" name="nominal" class="form-control" id="nominal" value="{{ $show->nominal }}" placeholder="Masukkan nominal pengadaan (format : 100000 tanpa titik koma), kosongkan jika tidak ada">
            </div>
            
            <a href="{{ route('batch') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection