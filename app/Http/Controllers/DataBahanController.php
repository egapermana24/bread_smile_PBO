<?php

namespace App\Http\Controllers;

use App\Models\DataBahan;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Alert;
// sweetalert
use App\Config\sweetalert;


class DataBahanController extends Controller
{

    public function index()
    {

        // join tabel dengan tabel satuan
        $dataBahan = DataBahan::join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('databahan.*', 'satuan.nm_satuan')
            ->get();

        // mengirim tittle dan judul ke view
        return view('dataBahan.index', ['dataBahan' => $dataBahan], ['tittle' => 'Data Bahan', 'judul' => 'Data Bahan', 'menu' => 'Bahan Baku', 'submenu' => 'Data Bahan']);
    }


    public function create()
    {
        $kode = DataBahan::max('kd_bahan');
        $kode = (int) substr($kode, 3, 3);
        $kode = $kode + 1;
        $kode_otomatis = "BHN" . sprintf("%03s", $kode);

        $satuan = Satuan::all();

        return view(
            'DataBahan.create',
            ['kode_otomatis' => $kode_otomatis, 'satuan' => $satuan],
            ['tittle' => 'Tambah Data', 'judul' => 'Tambah Data Bahan', 'menu' => 'Data Bahan', 'submenu' => 'Tambah Data']
        );
    }


    public function store(Request $request)
    {
        $request->validate([
            'kd_bahan' => 'required|min:3|max:10',
            'nm_bahan' => 'required|min:3|max:50',
            'harga_beli' => 'required',
            'stok' => 'required|numeric',
            'ket' => 'required|min:3',
        ]);

        DataBahan::create($request->all());

        Alert::success('Data Bahan', 'Berhasil Ditambahkan!');
        return redirect('/dataBahan');
    }

    public function show(DataBahan $dataBahan)
    {
        //
    }

    public function edit(DataBahan $dataBahan)
    {

        $dataBahan = DB::table('databahan')->join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')->select('databahan.*', 'satuan.nm_satuan')->where('kd_satuan', $dataBahan->kd_satuan)->first();

        $satuan = Satuan::all();
        return view(
            'DataBahan.edit',
            compact('dataBahan', 'satuan'),
            ['tittle' => 'Edit Data', 'judul' => 'Edit Data Bahan', 'menu' => 'Data Bahan', 'submenu' => 'Edit Data']
        );
    }

    public function update(Request $request, DataBahan $dataBahan)
    {
        $request->validate([
            'kd_bahan' => 'required',
            'nm_bahan' => 'required|min:3|max:50',
            'kd_satuan' => 'required',
            'harga_beli' => 'required|integer',
            'stok' => 'required|integer',
            'ket' => 'required|min:3',
        ]);

        $dataBahan->update($request->all());

        Alert::success('Data Bahan', 'Berhasil diubah!');
        return redirect('/dataBahan');
    }

    public function destroy(DataBahan $dataBahan, Request $request)
    {
        Alert::question('Apakah yakin untuk menghapus data?', 'Data yang dihapus tidak dapat dikembalikan!');
        if (Alert::question() == true) {
            // DataBahan::destroy($dataBahan->kd_bahan);
            Alert::success('Data Bahan', 'Berhasil dihapus!');
            return redirect('/dataBahan');
        } else {
            Alert::info('Data Bahan', 'Tidak jadi dihapus!');
            return redirect('/dataBahan');
        }
    }
}
