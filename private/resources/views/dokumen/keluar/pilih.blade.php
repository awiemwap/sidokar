@extends('adminlte.app')
@section('title', 'Ambil Surat Biasa')
@section('judul', 'Surat Biasa')
@section('halaman', 'Suratbiasa')
@section('submenu', 'ambilsuratbiasa')
@section('container')
  {{-- <div class="card card-info"> --}}
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Ambil Nomor Surat Biasa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('dokumenkeluar.ambil')}}">
          @csrf
          <div class="form-group">
            <label for="position-option">Jenis Dokumen</label>
            <select class="form-control" id="jenis_dokumen" name="jenis_dokumen">
               @foreach ($cariDokumen as $c)
                  <option value="{{ $c->jenis_dokumen }}">{{ $c->jenis_dokumen }}</option>
               @endforeach
            </select>
         </div>
          <div class="form-group">
            <label for="position-option">Tahun</label>
            <select class="form-control" id="jenis_dokumen" name="tahun">
               @foreach ($cariTahun as $c)
                  <option value="{{ $c->tahun_masehi }}">{{ $c->tahun_masehi }}</option>
               @endforeach
            </select>
         </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <a href="/suratbiasa"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</button></a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Cari</button>
          </div>
        </form>
      </div>
  
@endsection


