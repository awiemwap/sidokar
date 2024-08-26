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

class KeputusanController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function gbi()
    {

        if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Keputusan GBI' )
            ->get();
        } else {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Keputusan GBI' )
            ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
            ->get();
        }

        return view('keputusan.gbi', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function gbiAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Keputusan GBI';
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
       return view('keputusan.gbiFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function gbiSimpan(Request $request)
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
            'jenis_dokumen' => 'Keputusan GBI',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);


        Alert::success('Selesai', 'Nomor berhasil ditambahkan');
        return redirect('gbi');
    }



    // method untuk menghapus data berdasarkan id
    public function gbiHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();

        Alert::success('Selesai', 'Nomor berhasil dihapus');
        return redirect('gbi');
        }else
        {
        
        Alert::warning('Gagal', 'Anda tidak dapat dapat menghapus nomor ini!');
        return redirect('gbi');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function gbiUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('keputusan.gbiFormUbah', ['show'=>$show]);
        }else
        {
        return redirect('gbi')->with('gagal_edit', 'Anda tidak dapat mengedit nomor ini!');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function gbiUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'Data berhasil diubah');
        return redirect('gbi');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function gbiEdit(Dokumenkeluar $show)
    {
        return view('keputusan.gbiFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function gbiStore(Request $request)
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

        Alert::success('Selesai', 'data berhasil diubah');            
        return redirect('gbi');



    }
    // method untuk meneruskan ke form backdate
    public function gbiBackdate(Dokumenkeluar $show)
    {
        return view('keputusan.gbiBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function gbiBackdateStore(Request $request)
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
            'jenis_dokumen' => 'Keputusan GBI',
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
        return redirect('gbi');
    }


    // Batas Method 
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    // ==================================
    
    

    // Mengarahkan ke halaman index dengan mengambil isi database
    public function pbi()
    {

        if (Auth::user()->level == 'admin') // jika yang login admin, maka tampilkan semua isi
        {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Keputusan PBI' )
            ->get();
        } else {
            $dokumenkeluar= DB::table('dokumenkeluars')
            ->where('jenis_dokumen', '=', 'Keputusan PBI' )
            ->where('user', Auth::user()->name) // menampilkan isi berdasarkan nama user yang login
            ->get();
        }

        return view('keputusan.pbi', ['dokumenkeluar'=> $dokumenkeluar]);
    }


    // Method untuk form pengambilan nomor dokumen
    public function pbiAmbil(Request $request)
    {
        $tahun = DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Keputusan PBI';
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
       return view('keputusan.pbiFormAmbil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);
       
    }


    // Method untuk menangkap request dari form dan menyimpan ke database
    public function pbiSimpan(Request $request)
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
            'jenis_dokumen' => 'Keputusan PBI',
            'tahun'         => $request->tahun,
            'nomor'         => $request->nomor,
            'rubrik'        => $request->rubrik,
            'perihal'       => $request->perihal,
            'unit'          => $request->unit,
            'user'          => Auth::user()->name
        ]);

        Alert::success('Selesai', 'Nomor berhasil ditambahkan!');
        return redirect('pbi');
    }



    // method untuk menghapus data berdasarkan id
    public function pbiHapus(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        Dokumenkeluar::find($show->id)->delete();
        Alert::success('Selesai', 'Data berhasil dihapus!');
        return redirect('pbi');
        }else
        {

        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini!');
        return redirect('pbi');
        }
    }


    // method untuk meneruskan ke form ubah data
    public function pbiUbah(Dokumenkeluar $show)
    {
        if ((Auth::user()->name == $show->user) or (Auth::user()->level == 'admin')) // pengkondisian untuk validasi nama dan level
        {
        return view('keputusan.pbiFormUbah', ['show'=>$show]);
        }else
        {
        Alert::warning('Gagal', 'Anda tidak dapat menghapus nomor ini!');
        return redirect('pbi');
        }
        
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data
    public function pbiUpdate(Request $request)
    {
        Dokumenkeluar::where('id', $request->id)
            ->update([
                    'rubrik'    => $request->rubrik,
                    'perihal'   => $request->perihal,
                    'unit'      => $request->unit
                     ]);
        
        Alert::success('Selesai', 'data berhasil diubah!');
        return redirect('pbi');
    }



    // method untuk meneruskan ke form ubah data khusus admin
    public function pbiEdit(Dokumenkeluar $show)
    {
        return view('keputusan.pbiFormEdit', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function pbiStore(Request $request)
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
        return redirect('pbi');



    }
    // method untuk meneruskan ke form backdate
    public function pbiBackdate(Dokumenkeluar $show)
    {
        return view('keputusan.pbiBackdate', ['show'=>$show]);
    }


    // method untuk menyimpan data yang sudah dikirim dari form ubah data oleh Admin
    public function pbiBackdateStore(Request $request)
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
            'jenis_dokumen' => 'Keputusan PBI',
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
        return redirect('pbi');
    }


    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */


}
