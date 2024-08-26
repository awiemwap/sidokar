@extends('adminlte.app')
@section('title', 'Surat Biasa')
@section('judul', 'Surat Biasa')
@section('halaman', 'Suratbiasa')
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
<div class="card">
    <div class="card-header">
      <div class="d-grid gap-2 d-md-block">
        {{-- <a href="/suratbiasa/create" class="btn btn-primary" data-bs-toggle="button">Ambil Nomor</a> --}}
        <a href="/dokumenkeluar/create"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Ambil Nomor</button></a>
      </div>
      {{-- <h3 class="card-title">Daftar Surat Keluar Biasa</h3> --}}
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No.</th>
          <th>jenis Dokumen</th>
          <th>Tahun Buku</th>
          <th>Nomor dan Rubrik Lengkap</th>
          <th>Tanggal Surat</th>
          <th>Tujuan</th>
          <th>Perihal</th>
          <th>Unit Pembuat</th>
          <th>Nama pembuat</th>
          <th>Backdate</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($dokumen_keluar as $show)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{  $show->jenis_dokumen}}</td>
          <td>{{  $show->tahun}}</td>
          <td>{{  $show->rubrik}}</td>
          <td>{{\Carbon\Carbon::parse($show->created_at)->isoFormat('dddd, D MMMM Y ')}}</td>
          <td> {{ $show->tujuan }}</td>
          <td>{{ $show->perihal }}</td>
          <td>{{ $show->unit }}</td>
          <td>{{ $show->user }}</td>
          <td>{{ $show->status }}</td>
          <td><a href="/dokumenkeluar/{{ $show->id }}" class="btn btn-app bg-success">
              <i class="fas fa-edit"></i>Edit</a>
              <a href="" class="btn btn-app bg-warning">
              <i class="fa fa-backward"></i>Backdate</a>
              <form action="/dokumenkeluar/destroy/{{$show->id}}" method="POST">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-app bg-danger" onclick="return confirm('Anda yakin mau menghapus Nomor ini ?')"><i class="fas fa-trash"></i>Hapus</button>
              </form>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    
@endsection
