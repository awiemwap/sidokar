@extends('deskapp.app')
@section('tittle', 'Rekap Pemeliharaan Kendaraan')
@section('judul', 'REKAPITULASI PEMELIHARAAN KENDARAAN DINAS')
@section('halaman', 'Rekapitulasi Pemeliharaan Kendaraan Dinas')
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
    <h4 class="text-blue h4"><a href="{{ route('pemeliharaan.create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Tambah Data</button></a></h4>
  </div>
    <div class="pb-20">
      <table id="example1" class="table hover multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Nomor Polisi/NRKB</th>
          <th>Tipe Kendaraan</th>
          <th>Tanggal Pemeliharaan</th>
          <th>Jenis Pemeliharaan</th>
          <th>Nama Bengkel</th>
          <th>Detail Pemeliharaan</th>
          <th>Pembelian Material</th>
          <th>Jumlah Biaya</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pemeliharaan as $show)
        <tr>
          <td >{{ $loop->iteration }}</td>
          <td class="table-plus">{{  $show->kendaraan->nopol}}</td>
          <td class="table-plus">{{  $show->kendaraan->tipe}}</td>
          <td class="table-plus">{{\Carbon\Carbon::parse($show->tanggal_pemeliharaan)->isoFormat(' D MMMM Y ')}}</td>
          <td class="table-plus">{{ $show->jenis_pemeliharaan }}</td>
          <td class="table-plus">{{ $show->bengkel }}</td>
          <td class="table-plus">@foreach (explode("\n", $show->keterangan) as $line)
                                {{ $line }}<br>
                                @endforeach</td></td>
          <td class="table-plus">@foreach (explode("\n", $show->material) as $line)
                                {{ $line }}<br>
                                @endforeach</td></td>
          <td class="table-plus">{{ 'Rp' . number_format($show->biaya, 2, ',', '.') }}</td>
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
                <form action="./pemeliharaan/hapus/{{$show->id}}"    method="POST">
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

