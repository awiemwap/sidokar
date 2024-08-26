@extends('deskapp.app')
@section('tittle', 'Kendaraan')
@section('judul', 'DATA KENDARAAN DINAS')
@section('halaman', 'Data Kendaraan Dinas')
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
    <h4 class="text-blue h4"><a href="{{ route('kendaraan.create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah Kendaraan</button></a></h4>
  </div>
    <div class="pb-20">
      <table id="example1" class="table hover multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Nomor Polisi</th>
          <th>Merk</th>
          <th>Jenis</th>
          <th>Tipe</th>
          <th>Warna KB</th>
          <th>Tahun Perakitan</th>
          <th>Noka/nosin</th>
          <th>Masa Berlaku STNK</th>
          <th>Masa Berlaku Pajak</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($kendaraan as $show)
        <tr>
          <td >{{ $loop->iteration }}</td>
          <td class="table-plus">{{  $show->nopol}}</td>
          <td class="table-plus">{{  $show->merk}}</td>
          <td class="table-plus">{{ $show->jenis }}</td>
          <td class="table-plus">{{ $show->tipe }}</td>
          <td class="table-plus">{{ $show->warna }}</td>
          <td class="table-plus">{{$show->tahun}}</td>
          <td class="table-plus">{{ $show->noka }}</td>
          <td class="table-plus">{{\Carbon\Carbon::parse($show->stnk)->isoFormat(' D MMMM Y ')}}</td>
          <td class="table-plus">{{\Carbon\Carbon::parse($show->pajak)->isoFormat(' D MMMM Y ')}}</td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info">Action</button>
              <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item" href="./kendaraan/detail/{{$show->id}}"><i class="fa fa-eye"></i> | Detail</a>
               @if ((Auth::user()->level == 'admin') && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <a class="dropdown-item" href="./kendaraan/edit/{{$show->id}}"><i class="dw dw-edit2"></i> | Edit</a>
                @endif
                @if ((Auth::user()->level == 'admin') && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <form action="./kendaraan/hapus/{{$show->id}}"    method="POST">
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

@endsection

