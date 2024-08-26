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

class KekdaController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02kekdabiasa()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 KEKDA BIASA' )
            ->get();

        return view('kekda.m02biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02kekdabiasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 KEKDA BIASA';
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
       return view('kekda.m02biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02kekdabiasaSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 KEKDA BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02kekdabiasa');
    }



    // method untuk menghapus data berdasarkan id
    public function m02kekdabiasaHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02kekdabiasa');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02kekdabiasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02kekdabiasaUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('kekda.m02biasaFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02kekdabiasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02kekdabiasaUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02kekdabiasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02kekdabiasaEdit(Dokumenunit $show)
    {
        return view('kekda.m02biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02kekdabiasaStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'unit'      => $request->unit
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('m02kekdabiasa');



    }
    // method untuk meneruskan ke form backdate
    public function m02kekdabiasaBackdate(Dokumenunit $show)
    {
        return view('kekda.m02biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02kekdabiasaBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 KEKDA BIASA',
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
        return redirect('m02kekdabiasa');
    }




    // Batas MO2 Biasa dengan M02 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    
    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02kekdarhs()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 KEKDA RAHASIA' )
            ->get();

        return view('kekda.m02rhs', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02kekdarhsAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 KEKDA RAHASIA';
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
       return view('kekda.m02rhsFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02kekdarhsSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 KEKDA RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02kekdarhs');
    }



    // method untuk menghapus data berdasarkan id
    public function m02kekdarhsHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02kekdarhs');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02kekdarhs');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02kekdarhsUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('kekda.m02rhsFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02kekdarhs');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02kekdarhsUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'unit'   => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02kekdarhs');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02kekdarhsEdit(Dokumenunit $show)
    {
        return view('kekda.m02rhsFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02kekdarhsStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'unit'      => $request->unit
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('m02kekdarhs');



    }
    // method untuk meneruskan ke form backdate
    public function m02kekdarhsBackdate(Dokumenunit $show)
    {
        return view('kekda.m02rhsBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02kekdarhsBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 KEKDA RAHASIA',
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
        return redirect('m02kekdarhs');
    }



    


    // Batas LDP
    //// LD COKKKK



    // Mengarahkan ke halaman index dengan mengambil isi database
    public function kekdaldp()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'LDP KEKDA' )
            ->get();

        return view('kekda.ldp', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function kekdaldpAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'LDP KEKDA';
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
       return view('kekda.ldpFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function kekdaldpSimpan(Request $request)
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
            'jenis_dokumen' => 'LDP KEKDA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('kekdaldp');
    }



    // method untuk menghapus data berdasarkan id
    public function kekdaldpHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('kekdaldp');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('kekdaldp');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function kekdaldpUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('kekda.ldpFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('kekdaldp');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function kekdaldpUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'tujuan'    => $request->tujuan,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('kekdaldp');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function kekdaldpEdit(Dokumenunit $show)
    {
        return view('kekda.ldpFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function kekdaldpStore(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'tujuan'    => $request->tujuan
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('kekdaldp');



    }
    // method untuk meneruskan ke form backdate
    public function kekdaldpBackdate(Dokumenunit $show)
    {
        return view('kekda.ldpBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function kekdaldpBackdateStore(Request $request)
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
            'jenis_dokumen' => 'LDP KEKDA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'tujuan'        => $request->tujuan,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('kekdaldp');
    }


    // Batas Nomor TV01


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function kekdatv01()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'TV 01 KEKDA' )
            ->get();

        return view('kekda.tv01', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function tv01Ambil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'TV 01 KEKDA';
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
       return view('kekda.tv01FormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
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
            'jenis_dokumen' => 'TV 01 KEKDA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'pelaksana'     => $request->pelaksana,
            'kegiatan'      => $request->kegiatan,
            'kota'          => $request->kota,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('kekdatv01');
    }



    // method untuk menghapus data berdasarkan id
    public function tv01Hapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('kekdatv01');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('kekdatv01');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function tv01Ubah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('kekda.tv01FormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('kekdatv01');
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
                    'unit'          => $request->unit,
                    'kota'       => $request->kota
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('kekdatv01');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function tv01Edit(Dokumenunit $show)
    {
        return view('kekda.tv01FormEdit', ['show'=>$show]);
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
                    'unit'       => $request->unit,
                    'kota'      => $request->kota
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('kekdatv01');



    }
    

    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
