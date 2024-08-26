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

class UikspController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02uikspbiasa()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UIKSP BIASA' )
            ->get();

        return view('uiksp.m02biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02uikspbiasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UIKSP BIASA';
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
       return view('uiksp.m02biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02uikspbiasaSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 UIKSP BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02uikspbiasa');
    }



    // method untuk menghapus data berdasarkan id
    public function m02uikspbiasaHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'manajer')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02uikspbiasa');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02uikspbiasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02uikspbiasaUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uiksp.m02biasaFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02uikspbiasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02uikspbiasaUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02uikspbiasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02uikspbiasaEdit(Dokumenunit $show)
    {
        return view('uiksp.m02biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uikspbiasaStore(Request $request)
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
        return redirect('m02uikspbiasa');



    }
    // method untuk meneruskan ke form backdate
    public function m02uikspbiasaBackdate(Dokumenunit $show)
    {
        return view('uiksp.m02biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uikspbiasaBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 uiksp BIASA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('m02uikspbiasa');
    }




    // Batas MO2 Biasa dengan M02 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    
    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m02uiksprhs()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'M02 UIKSP RAHASIA' )
            ->get();

        return view('uiksp.m02rhs', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m02uiksprhsAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'M02 UIKSP RAHASIA';
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
       return view('uiksp.m02rhsFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m02uiksprhsSimpan(Request $request)
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
            'jenis_dokumen' => 'M02 UIKSP RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m02uiksprhs');
    }



    // method untuk menghapus data berdasarkan id
    public function m02uiksprhsHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m02uiksprhs');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('m02uiksprhs');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m02uiksprhsUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uiksp.m02rhsFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('m02uiksprhs');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m02uiksprhsUpdate(Request $request)
    {
        Dokumenunit::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'nominal'   => $request->nominal
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('m02uiksprhs');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m02uiksprhsEdit(Dokumenunit $show)
    {
        return view('uiksp.m02rhsFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uiksprhsStore(Request $request)
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
        return redirect('m02uiksprhs');



    }
    // method untuk meneruskan ke form backdate
    public function m02uiksprhsBackdate(Dokumenunit $show)
    {
        return view('uiksp.m02rhsBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m02uiksprhsBackdateStore(Request $request)
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
            'jenis_dokumen' => 'M02 uiksp RAHASIA',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('m02uiksprhs');
    }



    


    // Batas LDP
    //// LD COKKKK



    // Mengarahkan ke halaman index dengan mengambil isi database
    public function uikspldp()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'LDP UIKSP' )
            ->get();

        return view('uiksp.ldp', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function uikspldpAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'LDP uiksp';
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
       return view('uiksp.ldpFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function uikspldpSimpan(Request $request)
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
            'jenis_dokumen' => 'LDP UIKSP',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'        => $request->tujuan,
            'nominal'       => $request->nominal,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('uikspldp');
    }



    // method untuk menghapus data berdasarkan id
    public function uikspldpHapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('uikspldp');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('uikspldp');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function uikspldpUbah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uiksp.ldpFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('uikspldp');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function uikspldpUpdate(Request $request)
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
        return redirect('uikspldp');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function uikspldpEdit(Dokumenunit $show)
    {
        return view('uiksp.ldpFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function uikspldpStore(Request $request)
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
        return redirect('uikspldp');



    }
    // method untuk meneruskan ke form backdate
    public function uikspldpBackdate(Dokumenunit $show)
    {
        return view('uiksp.ldpBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function uikspldpBackdateStore(Request $request)
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
            'jenis_dokumen' => 'LDP UIKSP',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'nominal'       => $request->nominal,
            'tujuan'        => $request->tujuan,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('uikspldp');
    }


    // Batas Nomor TV01


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function uiksptv01()
    {
            $dokumenkeluar= DB::table('dokumenunits')
            ->where('jenis_dokumen', '=', 'TV 01 UIKSP' )
            ->get();

        return view('uiksp.tv01', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function tv01Ambil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'TV 01 uiksp';
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
       return view('uiksp.tv01FormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
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
            'jenis_dokumen' => 'TV 01 uiksp',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'pelaksana'     => $request->pelaksana,
            'kegiatan'      => $request->kegiatan,
            'kota'          => $request->kota,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('uiksptv01');
    }



    // method untuk menghapus data berdasarkan id
    public function tv01Hapus(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenunit::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('uiksptv01');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('uiksptv01');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function tv01Ubah(Dokumenunit $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uiksp.tv01FormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('uiksptv01');
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
        return redirect('uiksptv01');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function tv01Edit(Dokumenunit $show)
    {
        return view('uiksp.tv01FormEdit', ['show'=>$show]);
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
        return redirect('uiksptv01');



    }
    

    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
