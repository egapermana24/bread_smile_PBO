<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

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

        return redirect('satuan')->with('status', 'Data Satuan Berhasil Ditambahkan!');
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
        return redirect()->route('satuan.index')
            ->with('status', 'Data Berhasil Diubah!');
    }

    public function destroy(Satuan $satuan)
    {
        $satuan->delete();
        return redirect()->route('satuan.index')
            ->with('status', 'Data Berhasil Dihapus.');
    }
}
