<?php

namespace App\Http\Controllers;

use App\Models\Sopir;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SopirController extends Controller
{
    public function index()
    {
        $sopir = Sopir::all();

        // mengirim tittle dan judul ke view
        return view(
            'sopir.index',
            [
                'sopir' => $sopir,
                'tittle' => 'Data Sopir',
                'judul' => 'Data Sopir',
                'menu' => 'Data Sopir',
                'submenu' => 'Data Sopir'
            ]
        );
    }

    public function create()
    {
        $kode = Sopir::max('kd_sopir');
        $kode = (int) substr($kode, 4, 4);
        $kode = $kode + 1;
        $kode_otomatis = "SPR" . sprintf("%03s", $kode);

        return view(
            'sopir.create',
            [
                'kode_otomatis' => $kode_otomatis,
                'tittle' => 'Tambah Data',
                'judul' => 'Tambah Data Sopir',
                'menu' => 'Data Sopir',
                'submenu' => 'Tambah Data'
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_sopir' => 'required',
            'nm_sopir' => 'required|min:3|max:50',
            'no_ktp' => 'required|min:16|unique:sopir,no_ktp|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|min:3',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }

        Sopir::create($input);

        return redirect('sopir')->with('status', 'Data Berhasil Ditambahkan!');
    }

    public function show(Sopir $sopir)
    {
        //
    }

    public function edit(Sopir $sopir)
    {
        return view(
            'sopir.edit',
            compact('sopir'),
            [
                'tittle' => 'Edit Data',
                'judul' => 'Edit Data Sopir',
                'menu' => 'Data Sopir',
                'submenu' => 'Edit Data'
            ]
        );
    }

    public function update(Request $request, $id)
    {

        // cek apakah user mengganti foto atau tidak
        if ($request->has('foto')) {

            $request->validate([
                'kd_sopir' => 'required',
                'nm_sopir' => 'required|min:3|max:50',
                'no_ktp' => 'required|min:16|numeric',
                'jenis_kelamin' => 'required',
                'alamat' => 'required|min:3',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
            ]);

            if ($image = $request->file('foto')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['foto'] = "$profileImage";
            }

            $input = $request->all();
            // dd($input);

            $sopir = Sopir::find($id);
            $sopir->update($input);

            // hapus foto lama
            File::delete('images/' . $sopir->foto);

            return redirect()->route('sopir.index')->with('success', 'Data Berhasil Diubah');
        } else {
            $request->validate([
                'kd_sopir' => 'required',
                'nm_sopir' => 'required|min:3|max:50',
                'no_ktp' => 'required|min:16|numeric',
                'jenis_kelamin' => 'required',
                'alamat' => 'required|min:3',
            ]);

            $input = $request->all();

            $sopir = Sopir::find($id);
            $sopir->update($input);
            return redirect()->route('sopir.index')->with('success', 'Data Berhasil Diubah');
        }
    }

    public function destroy(Sopir $sopir)
    {
        //
    }
}
