@extends('deskapp.app')
@section('tittle', 'Kode Rubrik')
@section('judul', 'Kode Rubrik')
@section('halaman', 'Kode Rubrik')
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
        <a href="{{ route('kodeRubrik.tambah') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah Kode Rubrik</button></a>
    </div>
    <div class="card-body">
      <table id="example1" class="data-table table hover multiple-select-row nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Kode Rubrik</th>
          <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($kodeRubrik as $show)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{  $show->kode}}</td>
          <td>{{  $show->keterangan}}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
@endsection

