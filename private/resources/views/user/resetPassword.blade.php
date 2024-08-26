@extends('deskapp.app')
@section('tittle', 'Tambah Tahun Dan Rubrik')
@section('judul', 'Tambah Tahun Dan Rubrik')
@section('halaman', 'Rubrik')
@section('submenu', 'Tambah Tahun Dan Rubrik')
@section('container')
      <div class="pd-20 card-box mb-30">
        <div class="clearfix">
         <div class="pull-left">
            <h4 class="text-blue">From Reset Password</h4>
        </div>
      </div>
         <div class="dropdown-divider"></div>
        <br>
        <form method="POST" action="{{ route('resetPasswordSimpan')}}">
          @csrf  
            <div class="form-group">
                <label for="position-option">Username</label>
                <select class="form-control" id="username" name="username">
                   @foreach ($nama as $nama)
                      <option value="{{ $nama->username }}">{{$nama->username }}</option>
                   @endforeach
                </select>
             </div>
             
             <input type="hidden" name="password" value="123456789">
             <input type="hidden" name="must_change_password" value="1">
            <a href="{{ route('dashboard') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Reset</button>
        </form>
      </div>
@endsection

