@extends('deskapp.app')
@section('tittle', 'Dokumen')
@section('judul', 'Nama Dokumen Bank Indonesia')
@section('halaman', 'Nama Dokumen')
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
      <h4 class="text-blue h4"><a href="{{ route('dokumen.tambah') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah Kategori Dokumen</button></a></h4>
    </div>
    <div class="pb-20">
      <table id="example1" class="data-table table hover multiple-select-row nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>jenis Dokumen</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($jenisDokumen as $show)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{  $show->jenis_dokumen}}</td>
          <td>{{ $show->keterangan }}</td>
          <td>
            
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

