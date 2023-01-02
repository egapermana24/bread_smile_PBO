<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DataBahan;
use App\Models\ProdukJadi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        // mengubah nama validasi
        $messages = [
            'kd_resep.required' => 'Kode Resep tidak boleh kosong',
            'kd_produk.required' => 'Kode Produk tidak boleh kosong',
            'kd_bahan.required' => 'Kode Bahan tidak boleh kosong',
            'ket.required' => 'Keterangan tidak boleh kosong',
        ];

        // validasi form
        $request->validate([
            'kd_resep' => 'required',
            'kd_produk' => 'required',
            'kd_bahan' => 'required',
            'ket' => 'required',
        ], $messages);

        // ambil data kd_bahan[] dan kd_produk[]
        $kd_bahan = $request->kd_bahan;
        $kd_produk = $request->kd_produk;

        // looping data kd_bahan[] dan kd_produk[]
        for ($i = 0; $i < count($kd_bahan); $i++) {
            // insert data ke tabel resep

            dd($kd_bahan[$i]);
            Resep::create([
                'kd_resep' => $request->kd_resep,
                'kd_produk' => $kd_produk[$i],
                'kd_bahan' => $kd_bahan[$i],
                'ket' => $request->ket,
            ]);
        }

        Alert::success('Data Resep', 'Berhasil ditambahakan!');
        return redirect('resep');
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
