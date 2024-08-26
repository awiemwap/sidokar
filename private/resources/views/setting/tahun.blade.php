@extends('deskapp.app')
@section('tittle', 'Pengaturan Tahun')
@section('judul', 'Pengaturan Tahun')
@section('halaman', 'Pengaturan Tahun')
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
        <h4 class="text-blue h4"><a href="{{ route('tahun.tambah') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambahkan Tahun</button></a></h4>
    </div>
    <div class="card-body">
      <table id="example1" class="data-table table hover multiple-select-row nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Tahun Masehi</th>
          <th>Tahun Buku</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tahun as $show )
        <tr>
          <td> {{ $loop->iteration }}</td>
          <td> {{ $show->tahun_masehi }}</td>
          <td> {{ $show->tahun_buku }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection

