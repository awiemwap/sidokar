<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Dokumenkeluar;
use App\Models\TahunMasehi;
use Auth;
use DB;
use Alert;

class SuratController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function suratbiasa()
    {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Surat Biasa' )
            ->get();

        return view('surat.biasa', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function suratbiasaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Surat Biasa';
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
       return view('surat.biasaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function suratbiasaSimpan(Request $request)
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
            'jenis_dokumen' => 'Surat Biasa',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);
        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('suratbiasa');
    }



    // method untuk menghapus data berdasarkan id
    public function suratbiasaHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();
        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('suratbiasa');
        }else
        {
        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini');
        return redirect('suratbiasa');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function suratbiasaUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('surat.biasaFormUbah', ['show'=>$show]);
        }else
        {
         Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini');
        return redirect('suratbiasa');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function suratbiasaUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Nomor berhasil diubah');
        return redirect('suratbiasa');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function suratbiasaEdit(Dokumenkeluar $show)
    {
        return view('surat.biasaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function suratbiasaStore(Request $request)
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
        return redirect('suratbiasa');



    }
    // method untuk meneruskan ke form backdate
    public function suratbiasaBackdate(Dokumenkeluar $show)
    {
        return view('surat.biasaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function suratbiasaBackdateStore(Request $request)
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
            'jenis_dokumen' => 'Surat Biasa',
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

        return redirect('suratbiasa');
    }




    // Batas MO1 Biasa dengan M01 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function suratrahasia()
    {

        if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Surat Rahasia' )
            ->get();
        } else {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Surat Rahasia' )
            ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
            ->get();
        }

        return view('surat.rahasia', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function suratrahasiaAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Surat Rahasia';
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
       return view('surat.rahasiaFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function suratrahasiaSimpan(Request $request)
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
            'jenis_dokumen' => 'Surat Rahasia',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');

        return redirect('suratrahasia');
    }



    // method untuk menghapus data berdasarkan id
    public function suratrahasiaHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');

        return redirect('suratrahasia');
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini');
            
        return redirect('suratrahasia');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function suratrahasiaUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('surat.rahasiaFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini');
            
        return redirect('suratrahasia');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function suratrahasiaUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);

        Alert::success('Selesai', 'Nomor berhasil diubah');        
        
        return redirect('suratrahasia');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function suratrahasiaEdit(Dokumenkeluar $show)
    {
        return view('surat.rahasiaFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function suratrahasiaStore(Request $request)
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
                     
        return redirect('suratrahasia');



    }
    // method untuk meneruskan ke form backdate
    public function suratrahasiaBackdate(Dokumenkeluar $show)
    {
        return view('surat.rahasiaBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function suratrahasiaBackdateStore(Request $request)
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
            'jenis_dokumen' => 'Surat Rahasia',
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

        return redirect('suratrahasia');
    }



    // Batas metod surat tugas 
    // Jancokkkkkk

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function surattugas()
    {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Surat Tugas' )
            ->get();

        return view('surat.tugas', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function surattugasAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Surat Tugas';
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
       return view('surat.tugasFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function surattugasSimpan(Request $request)
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
            'jenis_dokumen' => 'Surat Tugas',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'tujuan'        => $request->tujuan,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);
        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('surattugas');
    }



    // method untuk menghapus data berdasarkan id
    public function surattugasHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();
        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('surattugas');
        }else
        {
        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini');
        return redirect('surattugas');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function surattugasUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('surat.tugasFormUbah', ['show'=>$show]);
        }else
        {
         Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini');
        return redirect('surattugas');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function surattugasUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Nomor berhasil diubah');
        return redirect('surattugas');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function surattugasEdit(Dokumenkeluar $show)
    {
        return view('surat.tugasFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function surattugasStore(Request $request)
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
        return redirect('surattugas');



    }
    // method untuk meneruskan ke form backdate
    public function surattugasBackdate(Dokumenkeluar $show)
    {
        return view('surat.tugasBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function surattugasBackdateStore(Request $request)
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
            'jenis_dokumen' => 'Surat Tugas',
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

        return redirect('surattugas');
    }

    


    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
