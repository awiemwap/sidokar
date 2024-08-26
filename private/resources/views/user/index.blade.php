@extends('deskapp.app')
@section('tittle', 'DAFTAR USER')
@section('judul', 'DAFTAR USER')
@section('halaman', 'DAFTAR USER')
@section('container')
@if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
@endif
@if (session('hapus'))
  <div class="alert alert-success" role="alert">
    {{ session('hapus') }}
  </div>
@endif
@if (session('gagal_hapus'))
  <div class="alert alert-danger" role="alert">
    {{ session('gagal_hapus') }}
  </div>
@endif

<div class="card-box mb-30">
  <div class="pd-20">
    <h4 class="text-blue h4"><a href="{{ route('tambahuser') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah User</button></a></h4>
  </div>
    <div class="pb-20">
      <table id="example1" class="table hover multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Nama Pegawai</th>
          <th>Username</th>
          <th>Email</th>
          <th>Hak Akses</th>
          <th>Unit Kerja</th>
          <th>Status Password</th>
          <th>Foto</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user as $show)
        <tr>
          <td >{{ $loop->iteration }}</td>
          <td class="table-plus">{{  $show->name}}</td>
          <td class="table-plus">{{  $show->username}}</td>
          <td class="table-plus">{{  $show->email}}</td>
          <td class="table-plus">{{ $show->level }}</td>
          <td class="table-plus">{{ $show->unit }}</td>
          <td class="table-plus">{{ $show->must_change_password }}</td>
          <td class="table-plus"><img src="./foto/{{ $show->foto }}" width="60"></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info">Action</button>
              <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                @if ((Auth::user()->level == 'admin') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <a class="dropdown-item" href="./user/ubah/{{$show->id}}"><i class="dw dw-edit2"></i> | Edit</a>
                @endif
                @if ((Auth::user()->level == 'admin') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <form action="./user/hapus/{{$show->id}}"    method="POST">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <button type="submit" class="dropdown-item" onclick="return confirm('Anda yakin mau menghapus Nomor ini ?')"><i class="dw dw-delete-3"></i> | Hapus</button>
                </form>
                @endif
              </div>
            </div>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
</div>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading h4">Informasi Penting :</h4>
  <p>
      1. Fitur <b>edit dan hapus</b> hanya bisa diakses oleh user yang melakukan input dan pada tanggal yang sama saat nomor dokumen diambil, apabila ingin menghapus di hari lain dapat menghubungi admin <a href="https://wa.me/6285230526994">Disini</a>.
      <br>
      2. Khusus nomor dokumen klasifikasi <b>Rahasia</b> hanya dapat dilihat oleh user pengambil nomor, apabila membutuhkan nomor dokumen rahasia backdate dapat menghubungi admin <a href="https://wa.me/6285230526994">Disini</a>.
  </p>
  <hr />
  <p class="mb-0">
     
  </p>
</div>
@endsection

