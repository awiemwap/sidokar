@extends('deskapp.app')
@section('tittle', ' Ubah Password')
@section('judul', 'Ubah Password')
@section('halaman', 'Ubah Password')
@section('submenu', 'Ubah Password')
@section('container')

<div class="alert alert-primary" role="alert">
    <h4 class="alert-heading h4">Informasi Penting!!! :</h4>
    <p>
    <h5>Sebelum menggunakan aplikasi ini, anda WAJIB mengubah password lebih dahulu.
    Demi keamanan password minimal 8 karakter dan harus mengandung huruf besar, huruf kecil, dan angka ( contoh Bumibulat1 ).</h5>
    <hr />
    <p class="mb-0">
       
    </p>
</div>
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Ubah Password</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('simpanpassword') }}">
          @csrf  

            <input type="hidden" name="must_change_password" class="form-control" value="0">

            <div class="form-group">
                  <label for="password_lama"><b>Password Lama</b></label>
                  <input type="password" name="password_lama" class="form-control @error('password_baru') is-invalid @enderror" value="" id="password_lama" placeholder="">
            </div>
            @if (session('password_lama'))
                        <div class="alert alert-danger alert-dismissible">
                        {{ session('password_lama') }}
                        </div>
            @endif
            @error('password_lama')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                  <label for="password_baru"><b>Password Baru</b></label>
                  <input type="password" name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" value="" id="password_baru" placeholder="">
            </div>
            @error('password_baru')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror

            <div class="form-group">
                  <label for="v"><b>Ulangi Password Baru</b></label>
                  <input type="password" name="konfirmasi_password" class="form-control @error('konfirmasi_password') is-invalid @enderror" value="" id="perihal" placeholder="">
            </div>

            @error('konfirmasi_password')
                  <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            {{-- @if (session('konfirmasi_password'))
                        <div class="alert alert-danger alert-dismissible">
                        {{ session('konfirmasi_password') }}
            </div>
            @endif --}}
            
            <a href="{{ route('suratbiasa') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection




