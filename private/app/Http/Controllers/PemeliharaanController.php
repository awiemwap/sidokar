<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeliharaan;
use App\Models\Kendaraan;
use Alert;
use Auth;
use DB;


class PemeliharaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeliharaan = Pemeliharaan::with('kendaraan')->get();
        return view('pemeliharaan.index', compact('pemeliharaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraan = Kendaraan::all();
        return view('pemeliharaan.create', compact('kendaraan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Pemeliharaan::create($request->all());
        Alert::success('Selesai', 'Data pemeliharaan kendaraan dinas berhasil ditambahkan');

        return redirect()->route('pemeliharaan.index');
    }

    // Method Hapus data
    public function pemeliharaanHapus(Pemeliharaan $show)
    {
        Pemeliharaan::find($show->id)->delete();
        Alert::success('Selesai', 'Data pemeliharaan kendaraan dinas berhasil dihapus');
        return redirect()->route('pemeliharaan.index');
    }
}


