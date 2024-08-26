<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Pemeliharaan;
use Alert;
use Auth;
use DB;

class KendaraanController extends Controller
{
    
    // Method agar user login dulu sebelum membuka halaman ini, menggunakan middleware "auth"
    public function __construct()
    {
        $this->middleware('auth');
    }


    // Mengarahkan ke halaman index dengan mengambil isi database
    public function index()
    {

        $kendaraan= DB::table('kendaraans')->get();
        
        return view('kendaraan.index', ['kendaraan'=> $kendaraan]);
    }


    public function create()
    {
        return view('kendaraan.create');
    }


    public function store(Request $request)
    {
    
        Kendaraan::create($request->all());
        Alert::success('Selesai', 'Data kendaraan dinas berhasil ditambahkan');

        return redirect()->route('kendaraan.index');
    }


    // Method hapus
    public function kendaraanHapus(Kendaraan $show)
    {
        Kendaraan::find($show->id)->delete();
        Alert::success('Selesai', 'Data kendaraan dinas berhasil dihapus');
        return redirect()->route('kendaraan.index');
    }
    
    //detail kendaraan
    public function detail(Kendaraan $show)
    {
        $kendaraan_id= $show->id;
        $kendaraan=$show;
        
        $detail = Pemeliharaan::where('kendaraan_id', $kendaraan_id)->get();
        return view('kendaraan.detail', compact('detail','kendaraan'));

    }
    
    // method edit
    public function edit(Kendaraan $show)
    {
        //return $show;
        return view('kendaraan.edit', compact('show'));
    }

    // apdet
    public function update(Request $request)
    {

    Kendaraan::where('id', $request->id)
            ->update([
                    'nopol'      => $request->nopol,
                    'merk'       => $request->merk,
                    'jenis'      => $request->jenis,
                    'tipe'       => $request->tipe,
                    'warna'      => $request->warna,
                    'tahun'      => $request->tahun,
                    'noka'       => $request->noka,
                    'stnk'       => $request->stnk,
                    'pajak'      => $request->pajak
                     ]);

        Alert::success('Selesai', 'Data kendaraan berhasil diubah');
        return redirect('kendaraan');
    }
    
}

