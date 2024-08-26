@extends('deskapp.app')
@section('tittle', 'Pengaturan Rubrik')
@section('judul', 'Pengaturan Rubrik')
@section('halaman', 'Pengaturan Rubrik')
@section('container')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  @if (session('hapus'))
    <div class="alert alert-danger">
      {{ session('hapus') }}
    </div>
  @endif
  <div class="card-box mb-30">
    <div class="pd-20">
        <h4 class="text-blue h4"><a href="{{ route('rubrik.tambah') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah Rubrik</button></a></h4>
    </div>
    <div class="pb-20">
      <table id="example1" class="data-table table hover multiple-select-row nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>jenis Dokumen</th>
          <th>Tahun Buku</th>
          <th>Tahun Masehi</th>
          <th>Rubrik</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rubrik as $show)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{  $show->jenis_dokumen}}</td>
          <td>{{ $show->tahun_masehi }}</td>
          <td>{{ $show->tahun_buku }}</td>
          <td>{{ $show->tahun_buku }}/xxx/{{ $show->rubrik }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

    <div class="card-box mb-30">
      <div class="card text-white bg-info card-box">
        <div class="card-header">
          <h3 class="card-title text-white"><b>Informasi Penting :</b></h3>
        </div>
        <div class="card-body">
          <p class="card-text">
          <h5 class="card-title text-white"> Setiap pergantian tahun anggaran harus menambahkan tahun dan rubrik baru agar dapat ditampilkan di form pengambilan dokumen.</h5> 
          </p>
        </div>
      </div>
    </div>
@endsection

