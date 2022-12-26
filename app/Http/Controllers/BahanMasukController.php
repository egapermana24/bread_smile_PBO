<?php

namespace App\Http\Controllers;

use App\Models\BahanMasuk;
use App\Models\DataBahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BahanMasukController extends Controller
{

    public function index()
    {
        // join table bahan masuk dan data bahan
        $bahanMasuk = BahanMasuk::join('dataBahan', 'bahanMasuk.kd_bahan', '=', 'dataBahan.kd_bahan')->join('satuan', 'dataBahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('bahanMasuk.*', 'dataBahan.nm_bahan', 'dataBahan.kd_satuan', 'dataBahan.harga_beli', 'satuan.nm_satuan')
            ->get();


        // mengirim tittle dan judul ke view
        return view(
            'bahanMasuk.index',
            ['bahanMasuk' => $bahanMasuk],
            [
                'tittle' => 'Pembelian Bahan',
                'judul' => 'Pembelian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Pembelian Bahan'
            ]
        );
    }


    public function create()
    {
        // join dengan tabel satuan
        $dataBahan = DataBahan::join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('databahan.*', 'satuan.nm_satuan')
            ->get();

        return view(
            'bahanMasuk.create',
            ['dataBahan' => $dataBahan],
            [
                'tittle' => 'Pembelian Bahan',
                'judul' => 'Pembelian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Pembelian Bahan'
            ]
        );
    }


    public function store(Request $request)
    {
        // stok bahan bertambah
        $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
        $stok->stok = $stok->stok + $request->jumlah;
        $stok->save();

        // merubah harga_beli dan jumlah menjadi integer
        $harga_beli = (int) $request->harga_beli;
        $jumlah = (int) $request->jumlah;

        // mencari total harga
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


    public function show(BahanMasuk $bahanMasuk)
    {
        //
    }


    public function edit(bahanMasuk $bahanMasuk)
    {
        // join dengan tabel satuan
        $dataBahan = DataBahan::join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('databahan.*', 'satuan.nm_satuan')
            ->get();

        return view(
            'bahanMasuk.edit',
            compact('bahanMasuk', 'dataBahan'),
            // ['dataBahan' => $dataBahan],
            [
                'tittle' => 'Edit Data',
                'judul' => 'Edit Data Pembelian Bahan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Edit Data'
            ]
        );
    }


    public function update(Request $request, bahanMasuk $bahanMasuk)
    {

        // cek apakah bahannya di ubah
        if ($request->has('kd_bahan')) {

            // mengembalikan stok bahan yg lama 
            $stok = DataBahan::where('kd_bahan', $bahanMasuk->kd_bahan)->first();
            $stok->stok = $stok->stok - $bahanMasuk->jumlah;
            $stok->save();

            // update stok bahan baru
            $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
            $stok->stok = $stok->stok + $request->jumlah;
            $stok->save();

            // merubah harga_beli dan jumlah menjadi integer
            $harga_beli = (int) $stok->harga_beli;
            $jumlah = (int) $request->jumlah;

            $request->validate([
                'kd_bahan' => 'required',
                'jumlah' => 'required',
                'tgl_masuk' => 'required',
                'ket' => 'required|min:3',
            ]);

            $input = $request->all();

            // mencari total harga
            $total = $harga_beli * $jumlah;
            $input['total'] = $total;

            $bahanMasuk->update($input);

            return redirect()->route('bahanMasuk.index')
                ->with('status', 'Data Berhasil Diubah!');
        } else {
            $request->validate([
                'kd_bahan' => 'required',
                'jumlah' => 'required',
                'tgl_masuk' => 'required',
                'ket' => 'required|min:3',
            ]);

            if ($request->has('jumlah')) {

                // update stok bahan 
                $stok = DataBahan::where('kd_bahan', $request->kd_bahan)->first();
                $stok->stok = $stok->stok + $request->jumlah;
                $stok->save();

                // merubah harga_beli dan jumlah menjadi integer
                $harga_beli = (int) $stok->harga_beli;
                $jumlah = (int) $request->jumlah;

                $input = $request->all();

                // mencari total harga
                $total = $harga_beli * $jumlah;
                $input['total'] = $total;

                $bahanMasuk->update($input);

                return redirect()->route('bahanMasuk.index')
                    ->with('status', 'Data Berhasil Diubah!');
            } else {
                $input = $request->all();
                $bahanMasuk->update($input);

                return redirect()->route('bahanMasuk.index')
                    ->with('status', 'Data Berhasil Diubah!');
            }
        }
    }


    public function destroy(bahanMasuk $bahanMasuk)
    {
        // update stok bahan
        $stok = DataBahan::where('kd_bahan', $bahanMasuk->kd_bahan)->first();
        $stok->stok = $stok->stok - $bahanMasuk->jumlah;
        $stok->save();

        $bahanMasuk->delete();
        return redirect()->route('bahanMasuk.index')->with('status', 'Data Berhasil Dihapus');
    }
}
