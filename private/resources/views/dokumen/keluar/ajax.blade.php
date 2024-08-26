@extends('adminlte.app')
@section('title', 'Ambil Surat Biasa')
@section('judul', 'Surat Biasa')
@section('halaman', 'Suratbiasa')
@section('submenu', 'ambilsuratbiasa')
@section('container')
  {{-- <div class="card card-info"> --}}
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Form Ambil Nomor Surat Biasa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="GET">
          @csrf 
          
          <div class="form-group">
            <label for="rubrik">Nomor Agenda</label>
            <input type="text" name="nomor" class="form-control" id="rubrik" value="" readonly="">
          </div>
          <div class="form-group">
            <label for="rubrik">Tahun Buku</label>
            <input type="text" name="tahun" class="form-control" id="rubrik" value="" readonly="">
          </div>   
          <div class="form-group">
            <label for="rubrik">Jenis Dokumen</label>
            <input type="text" name="jenis_dokumen" class="form-control" id="rubrik" value="" readonly="">
          </div>  
          <div class="form-group">
              <label for="rubrik">Rubrik Lengkap</label>
              <input type="text" name="rubrik" class="form-control" id="rubrik" value="" readonly="">
            </div>

            <div class="form-group">
              <label for="tujuan">Tujuan</label>
              <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan') }}" id="tujuan" placeholder="">
            </div>
            

            <div class="form-group">
              <label for="perihal">Perihal</label>
              <input type="text" name="perihal" class="form-control" value="{{ old('perihal') }}" id="perihal" placeholder="">
            </div>
            

            <div class="form-group">
                <label>Unit/Fungsi</label>
                <select class="custom-select" name="unit">
                  <option>UIPUR</option>
                  <option>UIKSP</option>
                  <option>UMI</option>
                  <option>FDSEK</option>
                  <option>FPPU KI Syariah</option>
                  <option>Kehumasan</option>
                  <option>ICO</option>
                  <option>PM</option>
                  <option>TIM SPPURMI</option>
                  <option>TIM KEKDA</option>
                </select>
            </div>
            
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <a href="/suratbiasa"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> | Kembali</button></a>
            <button class="btn btn-primary"><i class="fa fa-check"></i> | Simpan</button>
          </div>
        </form>
      </div>

      <script type="text/javascript">
        $(document).ready(function(){
        
         $('#unit').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
          var unitform = $('#unit').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
          var token   = $("meta[name='csrf-token']").attr("content");
          $.ajax({        // Memulai ajax
            method: "GET",      
            url: "ajaxStore",    // file PHP yang akan merespon ajax
            data: {
                "unit": unitform,
                "_token": token
            }   // data POST yang akan dikirim
          })
            .done(function( hasilajax ) {   // KETIKA PROSES Ajax Request Selesai
                $('#rubrik').val(hasilajax);  // Isikan hasil dari ajak ke field 'nama' 
            });
         })
        });
        </script>
  
@endsection

