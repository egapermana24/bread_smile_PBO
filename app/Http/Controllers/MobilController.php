<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        // kode otomatis
        $kode = Mobil::max('kd_mobil');
        $kode = (int) substr($kode, 4, 4);
        $kode = $kode + 1;
        $kode_otomatis = "MBL" . sprintf("%03s", $kode);

        $mobil = Mobil::all();

        // mengirim tittle dan judul ke view
        return view(
            'mobil.index',
            [
                'mobil' => $mobil,
                'kode_otomatis' => $kode_otomatis,
                'tittle' => 'Data Mobil',
                'judul' => 'Data Mobil',
                'menu' => 'Data Mobil',
                'submenu' => 'Data Mobil'
            ]
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_mobil' => 'required',
            'merk' => 'required',
            'plat_nomor' => 'required|unique:mobil,plat_nomor',
            'ket' => 'required'
        ]);

        Mobil::create($request->all());

        return redirect('mobil')->with('status', 'Data Produk Berhasil Ditambahkan!');
    }

    public function show(Mobil $mobil)
    {
        //
    }


    public function edit(Mobil $mobil)
    {
        return view(
            'mobil.edit',
            compact('mobil'),
            [
                'tittle' => 'Edit Data Mobil',
                'judul' => 'Edit Data Mobil',
                'menu' => 'Data Mobil',
                'submenu' => 'Edit Data Mobil'
            ]
        );
    }

    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'kd_mobil' => 'required',
            'merk' => 'required',
            'plat_nomor' => 'required',
            'ket' => 'required'
        ]);

        $mobil->update($request->all());
        return redirect()->route('mobil.index')
            ->with('status', 'Data Berhasil Diubah!');
    }

    public function destroy(Mobil $mobil)
    {
        Mobil::destroy($mobil->kd_mobil);
        return redirect('mobil')->with('status', 'Data Produk Berhasil Dihapus!');
    }
}
