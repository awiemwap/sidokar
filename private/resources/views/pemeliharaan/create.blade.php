@extends('deskapp.app')
@section('tittle', ' Tambah Data Pemeliharaan Kendaraan Dinas')
@section('judul', 'TAMBAH DATA PEMELIHARAAN KENDARAAN DINAS')
@section('halaman', 'Tambah Data Pemeliharaan')
@section('submenu', 'Tambah Data Pmeliharaan')
@section('container')
    <div class="pd-20 card-box mb-30">
      <div class="clearfix">
        <div class="pull-left">
          <h3 class="text-blue h4">Form Tambah Data Pemeliharaan Kendaraan Dinas</h3>
        </div>
      </div>
        <div class="dropdown-divider"></div>
        <br>
        <form method="POST" id="quickForm" action="{{ route('pemeliharaan.store') }}">
          @csrf 
          
            <div class="form-group">
            <label for="kendaraan_id">Plat Nomor</label>
            <select name="kendaraan_id" id="kendaraan_id" class="form-control">
                @foreach($kendaraan as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->nopol }}</option>
                @endforeach
            </select>
            </div>

            <div class="form-group">
                <label for="maintenance_date">Tanggal Pemeliharaan</label>
                <input type="date" name="tanggal_pemeliharaan" id="tanggal_pemeliharaan" class="form-control" required>
            </div>

            <div class="form-group">
                <label><b>Jenis Pemeliharaan</b></label>
                <select class="custom-select" name="jenis_pemeliharaan">
                  <option>Rutin</option>
                  <option>Insidentil</option>
                </select>
            </div>

            <div class="form-group">
                <label><b>Nama Bengkel Rekanan</b></label>
                <select class="custom-select" name="bengkel">
                  <option>Toyota AUTO 2000 Hasanudin</option>
                  <option>PT. Jolo Indah Isuzu</option>
                  <option>PT. Indomobil Hino</option>
                  <option>Shop And Drive</option>
                  <option>Sinar Ban Kediri</option>
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Detail Pemeliharaan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="material">Pembelian Material/Sparepart</label>
                <textarea name="material" id="material" class="form-control" required></textarea>
            </div>
            <div class="form-group">

                <label for="biaya">Biaya</label>
                <input type="text" name="biaya" id="biaya" class="form-control" required>
            </div>
            

            <a href="http://127.0.0.1:8000/pemeliharaan" class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
        </form>
    </div>
@endsection

