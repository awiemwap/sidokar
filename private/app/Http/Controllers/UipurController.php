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

class UipurController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02uipurbiasa()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UIPUR BIASA' )
            ->get();

        return view('uipur.m02biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02uipurbiasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UIPUR BIASA';
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
       return view('uipur.m02biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02uipurbiasaSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 UIPUR BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02uipurbiasa');
    }



    // method untuk menghapus data berdasarkan id
    public function m02uipurbiasaHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02uipurbiasa');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02uipurbiasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02uipurbiasaUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uipur.m02biasaFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02uipurbiasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02uipurbiasaUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02uipurbiasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02uipurbiasaEdit(Dokumenunit $show)
    {
        return view('uipur.m02biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uipurbiasaStore(Request $request)
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
        return redirect('m02uipurbiasa');



    }
    // method untuk meneruskan ke form backdate
    public function m02uipurbiasaBackdate(Dokumenunit $show)
    {
        return view('uipur.m02biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uipurbiasaBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 UIPUR BIASA',
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
        return redirect('m02uipurbiasa');
    }




    // Batas MO2 Biasa dengan M02 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    
    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02uipurrhs()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UIPUR RAHASIA' )
            ->get();

        return view('uipur.m02rhs', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02uipurrhsAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UIPUR RAHASIA';
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
       return view('uipur.m02rhsFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02uipurrhsSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 UIPUR RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02uipurrhs');
    }



    // method untuk menghapus data berdasarkan id
    public function m02uipurrhsHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02uipurrhs');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02uipurrhs');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02uipurrhsUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uipur.m02rhsFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02uipurrhs');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02uipurrhsUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02uipurrhs');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02uipurrhsEdit(Dokumenunit $show)
    {
        return view('uipur.m02rhsFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uipurrhsStore(Request $request)
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
        return redirect('m02uipurrhs');



    }
    // method untuk meneruskan ke form backdate
    public function m02uipurrhsBackdate(Dokumenunit $show)
    {
        return view('uipur.m02rhsBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uipurrhsBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 UIPUR RAHASIA',
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
        return redirect('m02uipurrhs');
    }



    


    // Batas LDP
    //// LD COKKKK



    // Mengarahkan ke halaman index dengan mengambil isi database
    public function uipurldp()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'LDP UIPUR' )
            ->get();

        return view('uipur.ldp', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function uipurldpAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'LDP UIPUR';
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
       return view('uipur.ldpFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function uipurldpSimpan(Request $request)
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
            'jenis_dokumen' => 'LDP UIPUR',
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
        return redirect('uipurldp');
    }



    // method untuk menghapus data berdasarkan id
    public function uipurldpHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('uipurldp');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('uipurldp');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function uipurldpUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uipur.ldpFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('uipurldp');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function uipurldpUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal,
                    'tujuan'    => $request->tujuan
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('uipurldp');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function uipurldpEdit(Dokumenunit $show)
    {
        return view('uipur.ldpFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function uipurldpStore(Request $request)
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
        return redirect('uipurldp');



    }
    // method untuk meneruskan ke form backdate
    public function uipurldpBackdate(Dokumenunit $show)
    {
        return view('uipur.ldpBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function uipurldpBackdateStore(Request $request)
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
            'jenis_dokumen' => 'LDP UIPUR',
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
        return redirect('uipurldp');
    }


    // Batas Nomor TV01


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function uipurtv01()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'TV 01 UIPUR' )
            ->get();

        return view('uipur.tv01', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function tv01Ambil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'TV 01 UIPUR';
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
       return view('uipur.tv01FormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
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
            'jenis_dokumen' => 'TV 01 UIPUR',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'pelaksana'     => $request->pelaksana,
            'kegiatan'      => $request->kegiatan,
            'kota'          => $request->kota,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('uipurtv01');
    }



    // method untuk menghapus data berdasarkan id
    public function tv01Hapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('uipurtv01');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('uipurtv01');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function tv01Ubah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uipur.tv01FormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('uipurtv01');
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
        return redirect('uipurtv01');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function tv01Edit(Dokumenunit $show)
    {
        return view('uipur.tv01FormEdit', ['show'=>$show]);
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
        return redirect('uipurtv01');



    }
    

    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
