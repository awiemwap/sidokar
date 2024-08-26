@extends('deskapp.app')
@section('tittle', 'M02 UIPUR Rahasia')
@section('judul', 'M02 UIPUR Rahasia')
@section('halaman', 'M02 UIPUR Rahasia')
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
    <h4 class="text-blue h4"><a href="{{ route('m02uipurrhs.ambil') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> | Ambil Nomor</button></a></h4>
  </div>
    <div class="pb-20">
      <table id="example1" class="table hover multiple-select-row data-table-export nowrap">
        <thead>
        <tr>
          <th>No.</th>
          <th>Tahun</th>
          <th>Nomor dan Rubrik Lengkap</th>
          <th>Tanggal M02</th>
          <th>Perihal</th>
          <th>Nominal</th>
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
          <td class="table-plus">{{ $show->perihal }}</td>
          <td class="table-plus">{{ 'Rp' . number_format($show->nominal, 2, ',', '.') }}</td>
          <td class="table-plus">{{ $show->user }}</td>
          <td class="table-plus"><font color="red">{{ $show->status}}</font></td>
          <td>
            <div class="btn-group">
              <button type="button" class="btn btn-info">Action</button>
              <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu" role="menu">
                @if ((Auth::user()->level == 'manajer') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <a class="dropdown-item" href="./m02uipurrhs/ubah/{{$show->id}}"><i class="dw dw-edit2"></i> | Edit</a>
                @endif
                @if ((Auth::user()->level == 'manajer') or (Auth::user()->name == $show->user) && ( \Carbon\Carbon::now()->isoFormat('D MMMM Y') == \Carbon\Carbon::parse($show->created_at)->isoFormat('D MMMM Y')))
                <form action="./m02uipurrhs/hapus/{{$show->id}}"    method="POST">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <button type="submit" class="dropdown-item" onclick="return confirm('Anda yakin mau menghapus Nomor ini ?')"><i class="dw dw-delete-3"></i> | Hapus</button>
                </form>
                @endif
                <a class="dropdown-item" href="./m02uipurrhs/backdate/{{$show->id}}"><font color="red"><i class="bi bi-arrow-left-square"></i> | Nomor Backdate</font></a>
                @if (Auth::user()->level == 'manajer')
                <a class="dropdown-item" href="./m02uipurrhs/edit/{{$show->id}}"><font color="red"><i class="icon-copy fa fa-edit" aria-hidden="true"></i> | Edit Admin</font></a>
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

