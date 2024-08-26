<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Dokumenkeluar;
use App\Models\TahunMasehi;
use Alert;
use Auth;
use DB;

class Memorandum01Controller extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }



    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m01biasa()
    {
        
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Memorandum M.01 Biasa' )
            ->get();
    
        return view('memorandum01.biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m01biasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Memorandum M.01 Biasa';
        $cari   = DB::table('dokumenkeluars')
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
       return view('memorandum01.biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m01biasaSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'tujuan' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Memorandum M.01 Biasa',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');

        return redirect('m01biasa');
    }



    // method untuk menghapus data berdasarkan id
    public function m01biasaHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');

        return redirect('m01biasa');
        }else
        {

        Alert::warning('gagal', 'Anda tidak dapat menghapus nomor ini!');

        return redirect('m01biasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m01biasaUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('memorandum01.biasaFormUbah', ['show'=>$show]);
        }else
        {
        
        Alert::warning('gagal', 'Anda tidak dapat mengubah nomor ini!');

        return redirect('m01biasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m01biasaUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);

        Alert::success('Selesai', 'Nomor berhasil diubah');

        return redirect('m01biasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m01biasaEdit(Dokumenkeluar $show)
    {
        return view('memorandum01.biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m01biasaStore(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);

        Alert::success('Selesai', 'Nomor berhasil diubah');
                     
        return redirect('m01biasa');



    }
    // method untuk meneruskan ke form backdate
    public function m01biasaBackdate(Dokumenkeluar $show)
    {
        return view('memorandum01.biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m01biasaBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'tujuan' => 'required', // Validasi kolom tujuan
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Memorandum M.01 Biasa',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');

        return redirect('m01biasa');
    }




    // Batas MO1 Biasa dengan M01 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function m01rahasia()
    {

        if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Memorandum M.01 Rahasia' )
            ->get();
        } else {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Memorandum M.01 Rahasia' )
            ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
            ->get();
        }

        return view('memorandum01.rahasia', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function m01rahasiaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Memorandum M.01 Rahasia';
        $cari   = DB::table('dokumenkeluars')
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
       return view('memorandum01.rahasiaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function m01rahasiaSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'tujuan' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Memorandum M.01 Rahasia',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);
        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('m01rahasia');
    }



    // method untuk menghapus data berdasarkan id
    public function m01rahasiaHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();
        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('m01rahasia');
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini');

        return redirect('m01rahasia');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function m01rahasiaUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('memorandum01.rahasiaFormUbah', ['show'=>$show]);
        }else
        {
        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini');

        return redirect('m01rahasia');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function m01rahasiaUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Nomor berhasil diubah');

        return redirect('m01rahasia');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function m01rahasiaEdit(Dokumenkeluar $show)
    {
        return view('memorandum01.rahasiaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m01rahasiaStore(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
                     
        Alert::success('Selesai', 'Nomor berhasil diubah');

        return redirect('m01rahasia');



    }
    // method untuk meneruskan ke form backdate
    public function m01rahasiaBackdate(Dokumenkeluar $show)
    {
        return view('memorandum01.rahasiaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function m01rahasiaBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'tujuan' => 'required', // Validasi kolom tujuan
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Memorandum M.01 Rahasia',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');

        return redirect('m01rahasia');
    }


    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */



     public function m01biasabackdatenew(){

    return view('memorandum01.biasaBackdateNew');


     }




     public function m01biasabackdatenewstore(Request $request){

    $tanggal = $request->tanggal;
    $cari   = DB::table('dokumenkeluars')
        ->where('tanggal', '=', $tanggal)
        ->where('jenis_dokumen', '=', 'Memorandum M.01 Biasa')
        ->max('tanggal');
    
    if ( ! ($tanggal = $cari)) {
        return 'Hahahahahha';
    } else {
        
        
        return 'Xixixixix';
    }
    //return $cari;
    

    //return $request;


     }

}
