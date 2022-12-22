<?php

namespace App\Http\Controllers;

use App\Models\BahanMasuk;
use App\Models\DataBahan;
use Illuminate\Http\Request;

class BahanMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // join table bahan masuk dan data bahan
        $bahanMasuk = BahanMasuk::join('dataBahan', 'bahanMasuk.kd_bahan', '=', 'dataBahan.kd_bahan')->join('satuan', 'dataBahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('bahanMasuk.*', 'dataBahan.nm_bahan', 'dataBahan.kd_satuan', 'dataBahan.harga_beli', 'satuan.nm_satuan')
            ->get();


        // mengirim tittle dan judul ke view
        return view('bahanMasuk.index', ['bahanMasuk' => $bahanMasuk], ['tittle' => 'Pembelian Bahan', 'judul' => 'Pembelian Bahan', 'menu' => 'Bahan Baku', 'submenu' => 'Pembelian Bahan']);
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

        return view('bahanMasuk.create', ['dataBahan' => $dataBahan], ['tittle' => 'Pembelian Bahan', 'judul' => 'Pembelian Bahan', 'menu' => 'Bahan Baku', 'submenu' => 'Pembelian Bahan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // stok bahan bertambah
        $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
        $stok->stok = $stok->stok + $request->jumlah;
        $stok->save();

        // merubah harga_beli dan jumlah menjadi integer
        $harga_beli = (int) $request->harga_beli;
        $jumlah = (int) $request->jumlah;

        $total = $harga_beli * $jumlah;

        $request->validate([
            'kd_bahan' => 'required',
            'nm_bahan' => 'required',
            'tgl_masuk' => 'required',
            'jumlah' => 'required',
            'ket' => 'required',
        ]);

        BahanMasuk::create([
            'kd_bahan' => $request->kd_bahan,
            'nm_bahan' => $request->nm_bahan,
            'tgl_masuk' => $request->tgl_masuk,
            'jumlah' => $request->jumlah,
            'total' => $total,
            'ket' => $request->ket,
        ]);


        return redirect()->route('bahanMasuk.index')
            ->with('success', 'Bahan Masuk Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bahanMasuk  $bahanMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BahanMasuk $bahanMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bahanMasuk  $bahanMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(bahanMasuk $bahanMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bahanMasuk  $bahanMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bahanMasuk $bahanMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bahanMasuk  $bahanMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(bahanMasuk $bahanMasuk)
    {
        //
    }
}
