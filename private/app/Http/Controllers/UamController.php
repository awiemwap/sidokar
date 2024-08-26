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

class UamController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function erp()
    {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'UAM ERP' )
            ->get();

        return view('uam.erp', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function erpAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'UAM ERP';
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
       return view('uam.erpFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function erpSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'UAM ERP',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('erp');
    }



    // method untuk menghapus data berdasarkan id
    public function erpHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('erp');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat mengahpus nomor ini!');
        return redirect('erp');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function erpUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uam.erpFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat mengubah nomor ini!');
        return redirect('erp');
        }
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function erpUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'tujuan'    => $request->tujuan,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('erp');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function erpEdit(Dokumenkeluar $show)
    {
        return view('uam.erpFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function erpStore(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);

        
        Alert::success('Selesai', 'Data berhasil diubah!');       
        return redirect('erp');



    }
    // method untuk meneruskan ke form backdate
    public function erpBackdate(Dokumenkeluar $show)
    {
        return view('uam.erpBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function erpBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'UAM ERP',
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
        return redirect('erp');
    }




    // Batas MO1 Biasa dengan M01 Rahasia
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function cbs()
    {

        if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'UAM CBS' )
            ->get();
        } else {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'UAM CBS' )
            ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
            ->get();
        }

        return view('uam.cbs', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function cbsAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'UAM CBS';
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
       return view('uam.cbsFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function cbsSimpan(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'UAM CBS',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('cbs');
    }



    // method untuk menghapus data berdasarkan id
    public function cbsHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus!');
        return redirect('cbs');
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini!');
        return redirect('cbs');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function cbsUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('uam.cbsFormUbah', ['show'=>$show]);
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini!');
        return redirect('cbs');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function cbsUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('cbs');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function cbsEdit(Dokumenkeluar $show)
    {
        return view('uam.cbsFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function cbsStore(Request $request)
    {

        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'nomor'     => $request->nomor,
                    'tahun'     => $request->tahun,
                    'rubrik'    => $request->rubrik,
                    'created_at'=> $request->tanggal,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah!');
        return redirect('cbs');



    }
    // method untuk meneruskan ke form backdate
    public function cbsBackdate(Dokumenkeluar $show)
    {
        return view('uam.cbsBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function cbsBackdateStore(Request $request)
    {
        $messages = [
            'unique' => 'Nomor dan rubrik sudah ada!', // pesan eror validasi
            'required' => 'Wajib diisi!',

        ];

        $validated = $request->validate([
            'rubrik' => 'unique:App\Models\Dokumenkeluar,rubrik', // Validasi, kolom rubrik tidak boleh ada nilai yang sama (unik)
            'perihal' => 'required', // Validasi kolom perihal
            
        ],$messages);

        Dokumenkeluar::create([
            'jenis_dokumen' => 'UAM CBS',
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
        return redirect('cbs');
    }


    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
