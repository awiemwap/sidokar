<?php

namespace App\Http\Controllers;

use App\Models\Jenisdokumen;
use App\Models\Rubrik;
use App\Models\Tahunmasehi;
use App\Models\Koderubrik;
use Illuminate\Http\Request;
use DB;
use Auth;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // Ini menghandel penambahan jenis dokumen
    public function dokumen()
    {
        $jenisDokumen = DB::table('jenis_dokumen')->get();
        return view('setting.dokumen', ['jenisDokumen'=> $jenisDokumen]);
    }

    public function dokumenTambah()
    {
        return view('setting.dokumenTambah');
    }

    public function dokumenSimpan(Request $request)
    {
        $jenisDokumen= DB::table('jenis_dokumen')->insert([
            'jenis_dokumen' => $request->jenis_dokumen,
            'keterangan' => $request->keterangan
        ]);
        return redirect('dokumen')->with('status', 'Data berhasil ditambahkan');
    }

    public function destroy(Jenisdokumen $show)
    {
        if (Auth()->user()->level == 'admin'){
            Jenisdokumen::destroy($show->id);
            return redirect('jenisDokumen')->with('status', 'Data berhasil dihapus!');
            }
            return redirect('dokumen')->with('hapus', 'Anda tidak dapat menghapus!!');
    }
    // Akhir fungsi menambahkan jenis dokumen

    // Ini fungsi untuk menambahkan tahun

    public function tahun(){

        $tahun= DB::table('tahun_masehi')->get();
        return view('setting.tahun', ['tahun' => $tahun]);
    }

    public function tahunTambah(){
        $kode= DB::table('kode')->get();
        $jeniskode= DB::table('jenis_dokumen')->get();
        return view('setting.tahunTambah', ['kode'=>$kode], ['jeniskode'=> $jeniskode]);
    }

    public function tahunSimpan(Request $request){
        DB::table('tahun_masehi')->insert([
            'tahun_masehi'=> $request->tahun_masehi,
            'tahun_buku' => $request->tahun_buku
        ]);
        return redirect('tahun')->with('status', 'Data berhasil ditambahkan');
    }
    // Fungsi tambah tahun selesai


    // Fungsi menambahkan rubrik

    public function rubrik(){
        $rubrik= DB::table('rubrik')->get();
        return view('setting.rubrik', ['rubrik'=> $rubrik]);
    }
    
    public function rubrikTambah(){
        $kode= DB::table('kode')->get();
        $jenis_dokumen= DB::table('jenis_dokumen')->get();
        $tahun= DB::table('tahun_masehi')->get()->sortByDesc('tahun_masehi');
        return view('setting.rubrikTambah', ['kode'=>$kode,'tahun'=>$tahun, 'jenis_dokumen'=> $jenis_dokumen],);
        
    }


    public function rubrikSimpan(Request $request){
        DB::table('rubrik')->insert([
            'tahun_masehi'=> $request->tahun_masehi,
            'tahun_buku' => $request->tahun_buku,
            'jenis_dokumen' => $request->jenis_dokumen,
            'rubrik' => $request->rubrik
        ]);
        return redirect('rubrik')->with('status', 'Data berhasil ditambahkan');
    }

    // fungsi tambah kode rubrik
    public function kodeRubrik(){
        $kodeRubrik= DB::table('kode')->get();
        return view('setting.kodeRubrik', ['kodeRubrik'=> $kodeRubrik]);
    }

    public function kodeRubrikTambah(){
        return view('setting.kodeRubrikTambah');
    }

    public function kodeRubrikSimpan(Request $request){
        DB::table('kode')->insert([
            'kode'=> $request->kode,
            'keterangan'=> $request->keterangan,
        ]);
        return redirect('koderubrik')->with('status', 'Kode rubrik berhasil ditambahkan');
    }


    /**
     * Aplikasi ini dibuat oleh :
     * Awim Krisdianto
     * Pengawas Pengamanan Bank Indonesia Kediri
     * Siapapun boleh mengubah source code untuk dikembangkan lagi sesuai kebutuhan
     * Quote: Dua tangan yang bekerja lebih baik dari seribu tangan yang berdoa
     */
    
}
