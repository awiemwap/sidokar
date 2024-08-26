@extends('deskapp.app')
@section('tittle', ' Edit TV 01 UIPUR')
@section('judul', 'TV 01 UIPUR')
@section('halaman', 'TV 01 UIPUR')
@section('submenu', 'Ubah TV 01 UIPUR')
@section('container')
<div class="pd-20 card-box mb-30">
  <div class="clearfix">
     <div class="pull-left">
       <h3 class="text-blue h4">Form Ubah Nomor TV 01 UIPUR</h3>
     </div>
  </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./uipurtv01/update">
            {{ method_field('patch') }}
            @csrf  
                  <input type="hidden" name="id" value="{{ $show->id}}"> 
            <div class="form-group">
                  <label for="rubrik"><b>Nomor dan Rubrik Lengkap</b></label>
                  <input type="text" name="rubrik" class="form-control" id="rubrik" value="{{ $show->rubrik }}" readonly="">
            </div>
            <div class="form-group">
                <label for="pelaksana"><b>Pelaksana PDDN</b></label>
                <input type="text" name="pelaksana" class="form-control" value="{{ $show->pelaksana }}" id="pelaksana" placeholder="">
             </div>
          
            <div class="form-group">
                <label for="kegiatan"><b>Kegiatan PDDN</b></label>
                <input type="text" name="kegiatan" class="form-control" value="{{ $show->kegiatan }}" id="kegiatan" placeholder="">
            </div>
          
            <div class="form-group">
                <label for="kota"><b>Kota Tujuan PDDN</b></label>
                <input type="text" name="kota" class="form-control " value="{{ $show->kota }}" id="kota" placeholder="">
            </div>
          
            <a href="{{ route('uipurtv01') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection

