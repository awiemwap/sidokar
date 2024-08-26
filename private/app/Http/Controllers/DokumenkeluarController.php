<?php

namespace App\Http\Controllers;

use App\Models\Dokumenkeluar;
use App\Models\Tahunmasehi;
use Illuminate\Http\Request;
use DB;
use Auth;

class DokumenkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $dokumenkeluar= DB::table('dokumenkeluars')
        ->where('jenis_dokumen', '=', 'Surat Biasa' )
        ->get();
        return view('surat.rahasia.index', ['dokumenkeluar'=> $dokumenkeluar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pilih()
    {
        //$tahun= DB::table('tahun_masehi')->get()->sortByDesc('created_at');
        $tahun= DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= DB::table('jenis_dokumen')->get();

        return $tahun;

        //return view('surat.rahasia.tambah', ['tahun'=> $tahun], ['jenis_dokumen'=> $jenis_dokumen]);
    }


    public function tambah(Request $request){
        $tahun= DB::table('tahun_masehi')->max('tahun_masehi');
        $jenis_dokumen= 'Surat Biasa';
        //return $tahun;
        $cari   = DB::table('dokumenkeluars')
                ->where('jenis_dokumen', '=', $jenis_dokumen)
                ->where('tahun', '=', $tahun)
                ->max('nomor');
        $urutan = $cari+1;


        //return $cari;
        
        $carirubrik= DB::table('rubrik')
        ->where('jenis_dokumen', '=', $jenis_dokumen )
        ->where('tahun_masehi', '=', $tahun )
        ->first();
                $tahunBuku= $carirubrik->tahun_buku;
                $rubrikLengkap= $carirubrik->rubrik;
                $nomor = $carirubrik->nomor;
                $rubrik= $tahunBuku.'/'.$urutan.'/'.$rubrikLengkap;
       return view('surat.rahasia.ambil', ['rubrik'=> $rubrik, 'carirubrik'=> $carirubrik, 'urutan'=> $urutan]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'tujuan' => 'required',
            'perihal' => 'required',
            'unit' => 'required',
        ]);
        Dokumenkeluar::create([
            'jenis_dokumen'    => 'Surat Biasa',
            'tahun'     => $request->tahun,
            'nomor'     => $request->nomor,
            'rubrik'    => $request->rubrik,
            'tujuan'    => $request->tujuan,
            'perihal'   => $request->perihal,
            'unit'      => $request->unit,
            'user'      => Auth::user()->name
        ]);

        return redirect('dokumenkeluar')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumenkeluar  $dokumenkeluar
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumenkeluar $dokumenkeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumenkeluar  $dokumenkeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumenkeluar $dokumenkeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumenkeluar  $dokumenkeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumenkeluar $dokumenkeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumenkeluar  $dokumenkeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumenkeluar $dokumenkeluar)
    {
        //
    }
}
