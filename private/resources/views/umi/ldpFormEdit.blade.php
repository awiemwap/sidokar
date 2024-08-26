@extends('deskapp.app')
@section('tittle', ' Edit LDP 02 UMI By Admin')
@section('judul', 'Nomor LDP 02 UMI')
@section('halaman', 'Nomor LDP 02 UMI')
@section('submenu', 'Edit Nomor LDP 02 By Admin')
@section('container')
<div class="pd-20 card-box mb-30">
     <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Edit Nomor LDP 02 UMI By Admin</h3>
        </div>
      </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./umildp/store">
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
                  <label for="rubrik"><b>Tanggal LDP 02</b></label>
                  <input type="text" name="tanggal" class="form-control" id="rubrik" value="{{ $show->created_at }}" >
            </div>
            <div class="form-group">
                <label><b>Unit/Fungsi Penerima</b></label>
                <select class="custom-select" name="tujuan">
                  <option>UIPUR</option>
                  <option>UIKSP</option>
                  <option>UMI</option>
                  <option>FDSEK</option>
                  <option>FPPU KI Syariah</option>
                  <option>Kehumasan</option>
                  <option>ICO</option>
                  <option>PM</option>
                  <option>TIM SPPURMI</option>
                  <option>TIM KEKDA</option>
                </select>
            </div>
            <div class="form-group">
                  <label for="perihal"><b>Perihal</b></label>
                  <input type="text" name="perihal" class="form-control" id="perihal" value="{{ $show->perihal }}">
            </div>
            <a href="{{ route('umildp') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection