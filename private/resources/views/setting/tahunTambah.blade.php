@extends('deskapp.app')
@section('tittle', 'Tambah Tahun Buku')
@section('judul', 'Pengaturan Tahun')
@section('halaman', 'Pengaturan Tahun')
@section('submenu', 'Tambah Tahun')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4"">Form Tambah Tahun</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
        <br>
        <form method="POST" action="{{ route('tahun.simpan')}}">
          @csrf   
            <div class="form-group">
              <label><b>Tahun Masehi</b></label>
              <input type="text" class="form-control" name="tahun_masehi"  placeholder="">
            </div>
          
            <div class="form-group">
              <label><b>Tahun Buku Bank Indonesia</b></label>
              <input type="text" class="form-control" name="tahun_buku"  placeholder="">
            </div>
            <a href="{{ route('tahun') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
          </div>
        </form>
@endsection

