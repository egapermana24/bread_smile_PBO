<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Satuan::all();

        // mengirim tittle dan judul ke view
        return view(
            'satuan.index',
            [
                'satuan' => $satuan,
                'tittle' => 'Data Satuan',
                'judul' => 'Data Satuan',
                'menu' => 'Bahan Baku',
                'submenu' => 'Data Satuan'
            ]
        );
    }

    public function store(Request $request)
    {
        // mengubah error ke bahasa indonesia
        $messages = [
            'required' => ':attribute tidak boleh kosong',
        ];

        $errors = [
            'nm_satuan' => 'Nama Satuan',
        ];

        // validasi data
        $request->validate([
            'nm_satuan' => 'required',
        ], $messages, $errors);



        Satuan::create($request->all());

        Alert::success('Data Satuan', 'Berhasil Ditambahkan!');
        return redirect('satuan');
    }

    public function show(Satuan $satuan)
    {
        //
    }

    public function edit(Satuan $satuan)
    {
        return view(
            'satuan.edit',
            compact('satuan'),
            [
                'tittle' => 'Edit Data Satuan',
                'judul' => 'Edit Data Satuan',
                'menu' => 'Data Satuan',
                'submenu' => 'Edit Data Satuan'
            ]
        );
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'nm_satuan' => 'required'
        ]);

        $satuan->update($request->all());
        Alert::success('Data Satuan', 'Berhasil diubah!');
        return redirect('satuan');
    }

    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        Alert::success('Data Satuan', 'Berhasil dihapus!');
        return redirect('satuan');
    }
}
