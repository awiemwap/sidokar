<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Dokumenunit;
use App\Models\TahunMasehi;
use Auth;
use Alert;
use DB;
use Carbon\carbon;

class UmiController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02umibiasa()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UMI BIASA' )
            ->get();

        return view('umi.m02biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02umibiasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UMI BIASA';
        $cari   = DB::table('dokumenunits')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan= $cari+1; // Mencari nilai tertinggi pada kolom nomor dengan keyword jenis dokumen dan tahun

        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_buku;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= $tahunBuku.'/ '.$urutan.' /'.$rubrikLengkap;
       return view('umi.m02biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02umibiasaSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'M02 UMI BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02umibiasa');
    }



    // method untuk menghapus data berdasarkan id
    public function m02umibiasaHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02umibiasa');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02umibiasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02umibiasaUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('umi.m02biasaFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02umibiasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02umibiasaUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02umibiasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02umibiasaEdit(Dokumenunit $show)
    {
        return view('umi.m02biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02umibiasaStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('m02umibiasa');



    }
    // method untuk meneruskan ke form backdate
    public function m02umibiasaBackdate(Dokumenunit $show)
    {
        return view('umi.m02biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02umibiasaBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'M02 UMI BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('m02umibiasa');
    }




    // Batas MO2 Biasa dengan M02 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    
    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02umirhs()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UMI RAHASIA' )
            ->get();

        return view('umi.m02rhs', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02umirhsAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UMI RAHASIA';
        $cari   = DB::table('dokumenunits')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan= $cari+1; // Mencari nilai tertinggi pada kolom nomor dengan keyword jenis dokumen dan tahun

        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_buku;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= $tahunBuku.'/ '.$urutan.' /'.$rubrikLengkap;
       return view('umi.m02rhsFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02umirhsSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'M02 UMI RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02umirhs');
    }



    // method untuk menghapus data berdasarkan id
    public function m02umirhsHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02umirhs');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02umirhs');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02umirhsUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        return view('umi.m02rhsFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02umirhs');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02umirhsUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02umirhs');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02umirhsEdit(Dokumenunit $show)
    {
        return view('umi.m02rhsFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02umirhsStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('m02umirhs');



    }
    // method untuk meneruskan ke form backdate
    public function m02umirhsBackdate(Dokumenunit $show)
    {
        return view('umi.m02rhsBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02umirhsBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'M02 UMI RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('m02umirhs');
    }



    // batas Batch
    // jaran
    

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function batch()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'Batch' )
            ->get();

        return view('umi.batch', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function batchAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Batch';
        $cari   = DB::table('dokumenunits')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan= $cari+1; // Mencari nilai tertinggi pada kolom nomor dengan keyword jenis dokumen dan tahun
        $digit=str_pad($urutan, 4, '0', STR_PAD_LEFT);

        $waktu= Carbon::now();
        $bulan= $waktu->Format('m');


        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_masehi;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= 'KD-'.$tahunBuku.'-'.$bulan.'-'.$digit;

                // KD-2024-10-0001
       return view('umi.batchFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function batchSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'Batch',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('batch');
    }



    // method untuk menghapus data berdasarkan id
    public function batchHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('batch');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('batch');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function batchUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('umi.batchFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('batch');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function batchUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('batch');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function batchEdit(Dokumenunit $show)
    {
        return view('umi.batchFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function batchStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('batch');



    }
    // method untuk meneruskan ke form backdate
    public function batchBackdate(Dokumenunit $show)
    {
        return view('umi.batchBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function batchBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor Batch sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'Batch',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('batch');
    }




    // Batas LDP



    // Mengarahkan ke halaman index dengan mengambil isi database
    public function umildp()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'LDP 02 UMI' )
            ->get();

        return view('umi.ldp', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function umildpAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'LDP 02 UMI';
        $cari   = DB::table('dokumenunits')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan= $cari+1; // Mencari nilai tertinggi pada kolom nomor dengan keyword jenis dokumen dan tahun

        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_buku;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= $tahunBuku.'/ '.$urutan.' /'.$rubrikLengkap;
       return view('umi.ldpFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function umildpSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'LDP 02 UMI',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('umildp');
    }



    // method untuk menghapus data berdasarkan id
    public function umildpHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('umildp');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('umildp');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function umildpUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('umi.ldpFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('umildp');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function umildpUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'tujuan'    => $request->tujuan
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('umildp');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function umildpEdit(Dokumenunit $show)
    {
        return view('umi.ldpFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function umildpStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'tujuan'    => $request->tujuan
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('umildp');



    }
    // method untuk meneruskan ke form backdate
    public function umildpBackdate(Dokumenunit $show)
    {
        return view('umi.ldpBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function umildpBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'LDP 02 UMI',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'         => $request->tujuan,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('umildp');
    }


     // Batas Nomor TV01


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function umitv01()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'TV 01 UMI' )
            ->get();

        return view('umi.tv01', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function tv01Ambil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'TV 01 UMI';
        $cari   = DB::table('dokumenunits')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan= $cari+1; // Mencari nilai tertinggi pada kolom nomor dengan keyword jenis dokumen dan tahun

        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_buku;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= $tahunBuku.'/ '.$urutan.' /'.$rubrikLengkap;
       return view('umi.tv01FormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function tv01Simpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenunit,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'pelaksana' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'kota' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'kegiatan' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
            
        ],$messages);

        Dokumenunit::create([
            'jenis_dokumen' => 'TV 01 UMI',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'pelaksana'     => $request->pelaksana,
            'kegiatan'      => $request->kegiatan,
            'kota'          => $request->kota,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('umitv01');
    }



    // method untuk menghapus data berdasarkan id
    public function tv01Hapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('umitv01');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('umitv01');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function tv01Ubah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('umi.tv01FormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('umitv01');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function tv01Update(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'     => $request->rubrik,
                    'pelaksana'  => $request->pelaksana,
                    'kegiatan'   => $request->kegiatan,
                    'kota'       => $request->kota
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('umitv01');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function tv01Edit(Dokumenunit $show)
    {
        return view('umi.tv01FormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function tv01Store(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'pelaksana' => $request->pelaksana,
                    'kegiatan'  => $request->kegiatan,
                    'kota'      => $request->kota
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('umitv01');



    }

    

    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
