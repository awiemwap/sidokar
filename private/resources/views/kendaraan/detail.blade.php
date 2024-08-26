@extends('deskapp.app')
@section('tittle', 'detail kendaraan')
@section('judul', 'DETAIL KENDARAAN DINAS')
@section('halaman', 'Detail Kendaraan Dinas')
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
    <h5>DATA KENDARAAN :<h5><br>
    <h6>
    <table>
        <tr>
            <td><b>Tipe Kendaraan </b></td>
            <td>: {{$kendaraan->tipe}}</td>
        </tr>
        <tr>
            <td><b>Nomor Polisi</b></td>
            <td>: {{$kendaraan->nopol}}</td> 
        </tr>
        <tr>
            <td><b>Warna Kendaraan</b></td>
            <td>: {{$kendaraan->warna}}</td> 
        </tr>
        <tr>
            <td><b>Tahun Pembuatan</b></td>
            <td>: {{$kendaraan->tahun}}</td> 
        </tr>
        <tr>
            <td><b>Noka/Nosin</b> </td>
            <td>: {{$kendaraan->noka}}</td> 
        </tr>
        <tr>
            <td><b>Masa Berlaku STNK</b> </td>
            <td>: {{\Carbon\Carbon::parse($kendaraan->stnk)->isoFormat(' D MMMM Y ')}}</td> 
        </tr>
        <tr>
            <td><b>Masa Berlaku Pajak</>&nbsp;</td>
            <td>: {{\Carbon\Carbon::parse($kendaraan->pajak)->isoFormat(' D MMMM Y ')}}</td> 
        </tr>
    </table>
    <h6>
  

    <br><br>
    <h5>RIWAYAT PEMELIHARAAN :<h5>
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
      </tr>
      </thead>
      <tbody>
      @foreach ($detail as $show)
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
      </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

