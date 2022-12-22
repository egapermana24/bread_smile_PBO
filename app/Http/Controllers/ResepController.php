<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DataBahan;
use App\Models\ProdukJadi;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // join tabel dengan produkJadi dan dataBahan
        $resep = Resep::join('produkJadi', 'resep.kd_produk', '=', 'produkJadi.kd_produk')
            ->join('databahan', 'resep.kd_bahan', '=', 'databahan.kd_bahan')
            ->select('resep.*', 'produkJadi.nm_produk', 'databahan.nm_bahan')
            ->get();

        return view('resep.index', ['resep' => $resep], ['tittle' => 'Data Resep', 'judul' => 'Data Resep', 'menu' => 'Resep', 'submenu' => 'Data Resep']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kode_otomatis = Resep::max('kd_resep');
        $kode_otomatis = (int) substr($kode_otomatis, 3, 3);
        $kode_otomatis = $kode_otomatis + 1;
        $kode_otomatis = "RSP" . sprintf("%03s", $kode_otomatis);


        $dataBahan = DataBahan::all();
        $produkJadi = ProdukJadi::all();
        //join tabel dengan tabel produk dan tabel bahan
        $resep = Resep::all();

        return view(
            'resep.create',
            ['dataBahan' => $dataBahan, 'produkJadi' => $produkJadi, 'resep' => $resep, 'kode_otomatis' => $kode_otomatis],
            ['tittle' => 'Tambah Data', 'judul' => 'Tambah Data Resep', 'menu' => 'Resep', 'submenu' => 'Tambah Data']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->kd_bahan)) {
            $kd_bahan = implode(',', $request->kd_bahan);
        } else {
            $request->validate([
                'kd_bahan' => 'required',
            ]);
        }

        $request->validate([
            'kd_resep' => 'required',
            'kd_produk' => 'required',
            'kd_bahan' => 'required',
            'ket' => 'required',
        ]);

        // inputkan $kd_bahan ke tabel
        $request->request->add(['kd_bahan' => $kd_bahan]);

        Resep::create($request->all());

        return redirect('/resep')->with('status', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function show(Resep $resep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function edit(Resep $resep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resep $resep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resep  $resep
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resep $resep)
    {
        //
    }
}
