@extends('deskapp.app')
@section('tittle', 'Tambah Tahun Dan Rubrik')
@section('judul', 'Tambah Tahun Dan Rubrik')
@section('halaman', 'Rubrik')
@section('submenu', 'Tambah Tahun Dan Rubrik')
@section('container')
      <div class="pd-20 card-box mb-30">
        <div class="clearfix">
         <div class="pull-left">
            <h4 class="text-blue">Form Tambah Tahun Dan Rubrik</h4>
        </div>
      </div>
         <div class="dropdown-divider"></div>
        <br>
        <form method="POST" action="{{ route('rubrik.simpan')}}">
          @csrf  
            <div class="form-group">
                <label for="position-option">Tahun Masehi</label>
                <select class="form-control" id="tahun_masehi" name="tahun_masehi">
                   @foreach ($tahun as $c)
                      <option value="{{ $c->tahun_masehi }}">{{ $c->tahun_masehi }}</option>
                   @endforeach
                </select>
             </div>
            <div class="form-group">
                <label for="position-option">Tahun Buku</label>
                <select class="form-control" id="tahun_buku" name="tahun_buku">
                   @foreach ($tahun as $c)
                      <option value="{{ $c->tahun_buku }}">{{ $c->tahun_buku }}</option>
                   @endforeach
                </select>
             </div>
            <div class="form-group">
              <label for="position-option">Jenis Dokumen</label>
              <select class="form-control" id="jenis_dokumen" name="jenis_dokumen">
                 @foreach ($jenis_dokumen as $c)
                    <option value="{{ $c->jenis_dokumen }}">{{ $c->jenis_dokumen }}</option>
                 @endforeach
              </select>
           </div>
            <div class="form-group">
              <label for="position-option">Rubrik</label>
              <select class="form-control" id="rubrik" name="rubrik">
                 @foreach ($kode as $c)
                    <option value="{{ $c->kode }}">{{ $c->kode }}</option>
                 @endforeach
              </select>
           </div>
            <a href="{{ route('rubrik') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
      </div>
@endsection

