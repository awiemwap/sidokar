@extends('deskapp.app')
@section('tittle', ' Edit Data Kendaraan')
@section('judul', 'EDIT DATA KENDARAAN DINAS')
@section('halaman', 'Data Kendaraan Dinas')
@section('submenu', 'Edit Data Kendaraan dinas')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Data Kendaraan Dinas</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="./kendaraan/update">
            {{ method_field('patch') }}
          @csrf 
          
          <input type="hidden" name="id" value="{{$show->id}}">
            <div class="form-group">
                  <label for="nopol"><b>Nomor Polisi/NRKB</b></label>
                  <input type="text" name="nopol" class="form-control @error('nopol') is-invalid @enderror" id="merk" value="{{$show->nopol}}">
            </div>
            @error('nopol')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror 

            <div class="form-group">
                <label><b>Merk</b></label>
                <select class="custom-select" name="merk">
                  <option>Toyota</option>
                  <option>Isuzu</option>
                  <option>Hino</option>
                  <option>Yamaha</option>
                </select>
            </div>

            <div class="form-group">
                <label><b>Jenis KB</b></label>
                <select class="custom-select" name="jenis">
                  <option>Mobil Penumpang</option>
                  <option>Mobil Barang</option>
                  <option>Sedan</option>
                  <option>Jeep</option>
                  <option>Sepeda Motor</option>
                </select>
            </div>

            <div class="form-group">
                  <label for="tipe"><b>Tipe</b></label>
                  <input type="text" name="tipe" class="form-control @error('tipe') is-invalid @enderror" id="tipe" value="{{$show->tipe}}">
            </div>
            @error('tipe')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror 

            <div class="form-group">
                  <label for="warna"><b>Warna Kendaraan</b></label>
                  <input type="text" name="warna" class="form-control @error('warna') is-invalid @enderror" value="{{$show->warna }}" id="warna" placeholder="">
            </div>
            @error('warna')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
                  <label for="tahun"><b>Tahun Perakitan</b></label>
                  <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ $show->tahun }}" id="tahun" placeholder="">
            </div>
            @error('tahun')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="noka"><b>NOKA/NOSIN</b></label>
                <input type="text" name="noka" class="form-control @error('noka') is-invalid @enderror" id="noka" value="{{$show->noka}}">
            </div>
            @error('noka')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="noka"><b>Masa Berlaku STNK</b></label>
                <input type="date" name="stnk" class="form-control @error('stnk') is-invalid @enderror" id="stnk" value="{{$show->stnk}}">
            </div>
            @error('stnk')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="noka"><b>Masa Berlaku Pajak</b></label>
                <input type="date" name="pajak" class="form-control @error('pajak') is-invalid @enderror" id="pajak" value="{{$show->pajak}}">
            </div>
            @error('pajak')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <a href="http://127.0.0.1:8000/kendaraan" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
