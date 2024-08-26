@extends('deskapp.app')
@section('tittle', 'Tambah User')
@section('judul', 'Tambah User')
@section('halaman', 'Tambah User')
@section('submenu', 'Tambah user')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Tambah user</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" enctype="multipart/form-data" id="quickForm" action="{{ route('simpanuser') }}">
          @csrf  
              
            <div class="form-group">
                  <label for="username"><b>Username</b></label>
                  <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{old('username')}}">
            </div>
            @error('username')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror 

            <div class="form-group">
                  <label for="email"><b>Email</b></label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}">
            </div>
            @error('email')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror 
            <div class="form-group">
                  <label for="name"><b>Nama Pegawai</b></label>
                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" placeholder="">
            </div>
            @error('name')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
           
            <div class="form-group">
              <label><b>Unit/Fungsi</b></label>
              <select class="custom-select" name="unit">
                <option>UIPUR</option>
                <option>UIKSP</option>
                <option>UMI</option>
                <option>KEKDA</option>
              </select>
          </div>

            <div class="form-group">
                <label><b>Level</b></label>
                <select class="custom-select" name="level">
                  <option>admin</option>
                  <option>Pengguna</option>
                  <option>Manajer</option>
                </select>
            </div>

            <div class="form-group">
                <label><b>Ganti Password?</b></label>
                <select class="custom-select" name="gantipwd">
                  <option>0</option>
                  <option>1</option>
                </select>
            </div>

            <div class="form-group">
              <label for="foto"><b>Upload Foto</b></label>
              <input type="file" name="foto" class="form-control">
            </div>

            <input type="hidden" name="password" class="form-control" id="password" value="123456789">
            <a href="{{ route('user') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection
