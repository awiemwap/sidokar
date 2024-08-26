@extends('deskapp.app')
@section('tittle', 'Nomor Batch Backdate')
@section('judul', 'Nomor Batch Backdate')
@section('halaman', 'Nomor Batch Backdate')
@section('submenu', 'Ambil Nomor Batch Backdate')
@section('container')
<div class="pd-20 card-box mb-30">
  <div class="clearfix">
     <div class="pull-left">
       <h3 class="text-blue h4">Form Ambil Nomor Batch Backdate</h3>
     </div>
    </div>
      <div class="dropdown-divider"></div>
      <br>
        <form method="POST" id="quickForm" action="./batch/backdateStore">
            {{ method_field('patch') }}
            @csrf  
            <input type="hidden" name="id" value="{{ $show->id}}">
            <input type="hidden" name="nomor" class="form-control" value="{{ $show->nomor }}" readonly="">
            <input type="hidden" name="tahun" class="form-control" value="{{ $show->tahun }}" readonly="">      
            <input type="hidden" name="created_at" class="form-control" value="{{ $show->created_at }}" readonly="">      
            <div class="form-group">
              <label for="rubrik"><b>Nomor Batch ERP</b></label>
              <input type="text" name="rubrik" class="form-control @error('rubrik') is-invalid @enderror" id="rubrik" value="{{ $show->rubrik }}">
            </div>
            <div class="alert alert-info" role="alert">Silakan tambahkan Alphabet pada nomor batch, contoh KD-2025-01-0001A</div> 
            @error('rubrik')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="perihal"><b>Perihal</b></label>
                <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror" id="perihal" value="{{ old('perihal') }}">
            </div>
            @error('perihal')
              <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="nominal"><b>Nominal</b></label>
                <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" id="nominal" value="{{ old('nominal')}}" placeholder="Masukkan nominal pengadaan (format : 100000 tanpa titik koma), kosongkan jika tidak ada" >
            </div>
            <a href="{{ route('batch') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
</div>
@endsection
