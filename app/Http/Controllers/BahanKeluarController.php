<?php

namespace App\Http\Controllers;

use App\Models\bahanKeluar;
use App\Models\DataBahan;
use Illuminate\Http\Request;


class BahanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // join table bahan keluar dan data bahan
        $bahanKeluar = BahanKeluar::join('dataBahan', 'bahanKeluar.kd_bahan', '=', 'dataBahan.kd_bahan')->join('satuan', 'dataBahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('bahanKeluar.*', 'dataBahan.nm_bahan', 'dataBahan.kd_satuan', 'dataBahan.harga_beli', 'satuan.nm_satuan')
            ->get();

        // mengirim tittle dan judul ke view
        return view('bahanKeluar.index', ['bahanKeluar' => $bahanKeluar], ['tittle' => 'Pemakaian Bahan', 'judul' => 'Pemakaian Bahan', 'menu' => 'Bahan Baku', 'submenu' => 'Pemakaian Bahan']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // join dengan tabel satuan
        $dataBahan = DataBahan::join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('databahan.*', 'satuan.nm_satuan')
            ->get();

        return view('bahanKeluar.create', ['dataBahan' => $dataBahan], ['tittle' => 'Pemakaian Bahan', 'judul' => 'Pemakaian Bahan', 'menu' => 'Bahan Baku', 'submenu' => 'Pemakaian Bahan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // stok bahan berkurang
        $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
        $stok->stok = $stok->stok - $request->jumlah;
        $stok->save();
        // merubah harga_beli dan jumlah menjadi integer
        $harga_beli = (int) $request->harga_beli;
        $jumlah = (int) $request->jumlah;

        $total = $harga_beli * $jumlah;

        $request->validate([
            'kd_bahan' => 'required',
            'nm_bahan' => 'required',
            'tgl_keluar' => 'required',
            'jumlah' => 'required',
            'ket' => 'required',
        ]);

        // insert data ke table bahan keluar
        BahanKeluar::create([
            'kd_bahan' => $request->kd_bahan,
            'nm_bahan' => $request->nm_bahan,
            'tgl_keluar' => $request->tgl_keluar,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'ket' => $request->ket,
        ]);

        // alihkan halaman ke halaman bahan keluar
        return redirect('/bahanKeluar')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bahanKeluar  $bahanKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(bahanKeluar $bahanKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bahanKeluar  $bahanKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(bahanKeluar $bahanKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bahanKeluar  $bahanKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bahanKeluar $bahanKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bahanKeluar  $bahanKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(bahanKeluar $bahanKeluar)
    {
        //
    }
}
