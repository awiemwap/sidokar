@extends('deskapp.app')
@section('tittle', 'LDP Tim KEKDA')
@section('judul', 'LDP Tim KEKDA')
@section('halaman', 'LDP TIm KEKDA')
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
    <h4 class="text-blue h4"><a href="{{ route('kekdaldp.ambil') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Ambil Nomor</button></a></h4>
  </div>
    <div class="pb-20">
      <table id="example1" class="table hover multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Tahun</th>
          <th>Nomor dan Rubrik Lengkap</th>
          <th>Tanggal LDP</th>
          <th>Penerima LDP</th>
          <th>Perihal</th>
          <th>nominal</th>
          <th>Fungsi</th>
          <th>Nama pembuat</th>
          <th>Backdate</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($dokumenkeluar as $show)
        <tr>
          <td >{{ $loop->iteration }}</td>
          <td class="table-plus">{{  $show->tahun}}</td>
          <td class="table-plus">{{  $show->rubrik}}</td>
          <td class="table-plus">{{\Carbon\Carbon::parse($show->created_at)->isoFormat('dddd, D MMMM Y ')}}</td>
          <td class="table-plus">{{ $show->tujuan }}</td>
          <td class="table-plus">{{ $show->perihal }}</td>
          <td class="table-plus">{{ 'Rp' . number_format($show->nominal, 2, ',', '.') }}</td>
          <td class="table-plus">{{ $show->unit }}</td>
          <td class="table-plus">{{ $show->user }}</td>
          <td class="table-plus"><font color="red">{{ $show->status}}</font></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info">Action</button>
              <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                @if ((Auth::user()->level == 'admin') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <a class="dropdown-item" href="./kekdaldp/ubah/{{$show->id}}"><i class="dw dw-edit2"></i> | Edit</a>
                @endif
                @if ((Auth::user()->level == 'admin') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <form action="./kekdaldp/hapus/{{$show->id}}"    method="POST">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <button type="submit" class="dropdown-item" onclick="return confirm('Anda yakin mau menghapus Nomor ini ?')"><i class="dw dw-delete-3"></i> | Hapus</button>
                </form>
                @endif
                <a class="dropdown-item" href="./kekdaldp/backdate/{{$show->id}}"><font color="red"><i class="bi bi-arrow-left-square"></i> | Nomor Backdate</font></a>
                @if (Auth::user()->level == 'admin')
                <a class="dropdown-item" href="./kekdaldp/edit/{{$show->id}}"><font color="red"><i class="icon-copy fa fa-edit" aria-hidden="true"></i> | Edit Admin</font></a>
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

