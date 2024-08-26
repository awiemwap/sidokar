@extends('deskapp.app')
@section('tittle', 'Tambah Kode Rubrik')
@section('judul', 'Tambah Kode Rubrik')
@section('halaman', 'Kode Rubrik')
@section('submenu', 'Tambah Kode Rubrik')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h4 class="text-blue">Form Tambah Kode Rubrik</h4>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" action="{{ route('KodeRubrik.simpan')}}">
          @csrf    
            <div class="form-group">
                <label>Kode Rubrik</label>
                <input type="text" class="form-control" name="kode"  placeholder="">
                <label>Keterangan</label>
                <textarea class="form-control" name="keterangan" rows="3" placeholder=""></textarea>
            </div>
            <a href="{{ route('koderubrik') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection

