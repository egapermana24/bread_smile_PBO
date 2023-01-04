<?php

namespace App\Http\Controllers;

use App\Models\ProdukJadi;
use Illuminate\Http\Request;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukJadiController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ProdukJadi::class);

        // join tabel dengan tabel satuan
        $produkJadi = ProdukJadi::join('satuan', 'produkjadi.kd_satuan', '=', 'satuan.id_satuan')
            ->select('produkjadi.*', 'satuan.nm_satuan')
            ->get();

        // mengirim tittle dan judul ke view
        return view(
            'produkJadi.index',
            ['produkJadi' => $produkJadi],
            ['tittle' => 'Data Produk', 'judul' => 'Data Produk', 'menu' => 'Produk', 'submenu' => 'Data Produk']
        );
    }

    public function create()
    {
        $this->authorize('create', ProdukJadi::class);

        $kode = ProdukJadi::max('kd_produk');
        $kode = (int) substr($kode, 4, 4);
        $kode = $kode + 1;
        $kode_otomatis = "PRDK" . sprintf("%03s", $kode);

        $satuan = Satuan::all();

        return view(
            'produkJadi.create',
            ['kode_otomatis' => $kode_otomatis, 'satuan' => $satuan],
            ['tittle' => 'Tambah Data', 'judul' => 'Tambah Data Produk', 'menu' => 'Data Produk', 'submenu' => 'Tambah Data']
        );
    }

    public function store(Request $request)
    {
        $this->authorize('create', ProdukJadi::class);

        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Kode Produk tidak boleh kosong',
            'nm_produk.required' => 'Nama Produk tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.integer' => 'Stok harus berupa angka',
            'kd_satuan.required' => 'Kode Satuan tidak boleh kosong',
            'harga_jual.required' => 'Harga Jual tidak boleh kosong',
            'harga_jual.integer' => 'Harga Jual harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan minimal 3 karakter',
        ];

        $request->validate([
            'kd_produk' => 'required',
            'nm_produk' => 'required',
            'stok' => 'required|integer',
            'kd_satuan' => 'required',
            'harga_jual' => 'required|integer',
            'ket' => 'required|min:3',
        ], $messages);

        ProdukJadi::create($request->all());

        Alert::success('Data Produk', 'Berhasil Ditambahkan!');
        return redirect('produkJadi');
    }

    public function show(ProdukJadi $produkJadi)
    {
        //
    }


    public function edit(ProdukJadi $produkJadi)
    {
        $this->authorize('update', $produkJadi);

        $produkJadi = DB::table('produkjadi')->join('satuan', 'produkjadi.kd_satuan', '=', 'satuan.id_satuan')->select('produkjadi.*', 'satuan.nm_satuan')->where('kd_satuan', $produkJadi->kd_satuan)->first();

        $satuan = Satuan::all();
        return view(
            'ProdukJadi.edit',
            compact('produkJadi', 'satuan'),
            [
                'tittle' => 'Edit Data',
                'judul' => 'Edit Data Produk',
                'menu' => 'Data Produk',
                'submenu' => 'Edit Data'
            ]
        );
    }

    public function update(Request $request, ProdukJadi $produkJadi)
    {
        $this->authorize('update', $produkJadi);

        // mengubah nama validasi
        $messages = [
            'kd_produk.required' => 'Kode Produk tidak boleh kosong',
            'nm_produk.required' => 'Nama Produk tidak boleh kosong',
            'stok.required' => 'Stok tidak boleh kosong',
            'stok.integer' => 'Stok harus berupa angka',
            'kd_satuan.required' => 'Kode Satuan tidak boleh kosong',
            'harga_jual.required' => 'Harga Jual tidak boleh kosong',
            'harga_jual.integer' => 'Harga Jual harus berupa angka',
            'ket.required' => 'Keterangan tidak boleh kosong',
            'ket.min' => 'Keterangan minimal 3 karakter',
        ];

        $request->validate([
            'kd_produk' => 'required',
            'nm_produk' => 'required',
            'stok' => 'required|integer',
            'kd_satuan' => 'required',
            'harga_jual' => 'required|integer',
            'ket' => 'required|min:3',
        ], $messages);

        $produkJadi->update($request->all());
        Alert::success('Data Produk', 'Berhasil diubah!');
        return redirect('produkJadi');
    }

    public function destroy(ProdukJadi $produkJadi)
    {
        $this->authorize('delete', $produkJadi);

        ProdukJadi::destroy($produkJadi->kd_produk);
        Alert::success('Data Produk', 'Berhasil dihapus!');
        return redirect('produkJadi');
    }
}
