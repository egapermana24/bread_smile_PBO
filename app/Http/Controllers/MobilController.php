<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        Alert::success('Data Mobil', 'Berhasil ditambahakan!');
        return redirect('mobil');
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
        $rules = [
            'kd_mobil' => 'required',
            'merk' => 'required',
            'ket' => 'required'
        ];

        if ($request->plat_nomor != $mobil->plat_nomor) {
            $rules['plat_nomor'] = 'required|unique:mobil,plat_nomor';
        };

        $validateData = $request->validate($rules);
        $mobil->update($validateData);
        Alert::success('Data Mobil', 'Berhasil diubah!');
        return redirect('mobil');
    }

    public function destroy(Mobil $mobil)
    {
        Mobil::destroy($mobil->kd_mobil);
        Alert::success('Data Mobil', 'Berhasil dihapus!');
        return redirect('mobil');
    }
}
