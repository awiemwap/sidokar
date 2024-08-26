@extends('deskapp.app')
@section('tittle', 'Tambah Kategori Dokumen')
@section('judul', 'Tambah Kategori Dokumen')
@section('halaman', 'Jenis Dokumen')
@section('submenu', 'Tambah Kategori Dokumen')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="card-title">Form Tambah Kategori Dokumen</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" action="{{ route('dokumen.simpan')}}">
          @csrf  
            <div class="form-group">
              <label><b>Jenis Dokumen</b></label>
              <input type="text" class="form-control" name="jenis_dokumen"  placeholder="">
            </div>
            <div class="form-group">
              <label><b>Keterangan</b></label>
              <textarea class="form-control" name="keterangan" rows="3" placeholder=""></textarea>
            </div>
            <a href="{{ route('dokumen') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
      </div>
@endsection

