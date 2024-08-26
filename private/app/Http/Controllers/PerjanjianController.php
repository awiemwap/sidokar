<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Dokumenkeluar;
use App\Models\TahunMasehi;
use Auth;
use Alert;
use DB;

class PerjanjianController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function perjanjian()
    {

        //if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        //{
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Perjanjian' )
            ->get();
       // } else {
          //  $dokumenkeluar= DB::table('dokumenkeluars')
           // ->where('jenis_dokumen', '=', 'Perjanjian' )
           // ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
           // ->get();
       // }

        return view('perjanjian.index', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function perjanjianAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Perjanjian';
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
       return view('perjanjian.FormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function perjanjianSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'tujuan' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Perjanjian',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'       => $request->tujuan,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('perjanjian');
    }



    // method untuk menghapus data berdasarkan id
    public function perjanjianHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('perjanjian');
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mempunyai akses untuk menghapus nomor ini!');
        return redirect('perjanjian');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function perjanjianUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('perjanjian.FormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak mempunyai akses untuk menhgapus nomor ini!');
        return redirect('perjanjian');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function perjanjianUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'perihal'   => $request->perihal,
                    'tujuan'   => $request->tujuan,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah');
        return redirect('perjanjian');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function perjanjianEdit(Dokumenkeluar $show)
    {
        return view('perjanjian.FormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function perjanjianStore(Request $request)
    {

        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'tujuan'   => $request->tujuan,
                    'unit'      => $request->unit
                     ]);


        Alert::success('Selesai', 'Data berhasil diubah');
        return redirect('perjanjian');



    }
    // method untuk meneruskan ke form backdate
    public function perjanjianBackdate(Dokumenkeluar $show)
    {
        return view('perjanjian.Backdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function perjanjianBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            'tujuan' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'Perjanjian',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'created_at'    => $request->created_at,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'tujuan'       => $request->tujuan,
            'unit'          => $request->unit,
            'status'        => 'Backdate',
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor backdate berhasil ditambahkan');
        return redirect('perjanjian');
    }



    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
