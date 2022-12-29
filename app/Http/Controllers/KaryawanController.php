<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{

    public function index()
    {
        // join tabel dengan tabel jabatan
        $karyawan = Karyawan::join('jabatan', 'karyawan.kd_jabatan', '=', 'jabatan.id_jabatan')
            ->select('karyawan.*', 'jabatan.nm_jabatan')
            ->get();

        // mengirim tittle dan judul ke view
        return view(
            'karyawan.index',
            [
                'karyawan' => $karyawan,
                'tittle' => 'Data Karyawan',
                'judul' => 'Data Karyawan',
                'menu' => 'Data Karyawan',
                'submenu' => 'Data Karyawan'
            ]
        );
    }

    public function create()
    {
        // join tabel dengan tabel jabatan
        // $karyawan = Karyawan::join('jabatan', 'karyawan.kd_jabatan', '=', 'jabatan.id_jabatan')
        //     ->select('karyawan.*', 'jabatan.nm_jabatan')
        //     ->get();

        // mengirim tittle dan judul ke view
        return view(
            'karyawan.create',
            [
                'jabatan' => Jabatan::all(),
                'tittle' => 'Tambah Data',
                'judul' => 'Tambah Data Karyawan',
                'menu' => 'Data Karyawan',
                'submenu' => 'Tambah Data'
            ]
        );
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|min:11|max:11|unique:karyawan,nip',
            'namaDepan' => 'required',
            'kd_jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'no_telp' => 'required|min:11|min:12|numeric',
            'provinsi' => 'required',
            'select_kota' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'alamat_lengkap' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        // cek apakah nama belakang terisi
        if ($request->namaBelakang) {
            $nm_karyawan = [
                $request->namaDepan,
                $request->namaBelakang
            ];
            $nm_karyawan = implode(' ', $nm_karyawan);
        } else {
            $nm_karyawan = $request->namaDepan;
        }

        $ttl = [
            $request->tempat_lahir,
            date('d F Y', strtotime($request->tgl_lahir))
        ];
        $ttl = implode(', ', $ttl);

        $alamat = [
            $request->alamat_lengkap,
            'Kec. ' . $request->kecamatan,
            $request->select_kota . ' ' . $request->kota,
            'Prov. ' . $request->provinsi
        ];
        $alamat = strtoupper(implode(', ', $alamat));

        $no_telp = '+62' . $request->no_telp;

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $foto = "$profileImage";
        }

        Karyawan::create([
            'nip' => $request->nip,
            'nm_karyawan' => $nm_karyawan,
            'kd_jabatan' => $request->kd_jabatan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ttl' => $ttl,
            'no_telp' => $no_telp,
            'alamat' => $alamat,
            'foto' => $foto
        ]);

        Alert::success('Data Karyawan', 'Berhasil Ditambahkan!');
        return redirect('karyawan');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Karyawan $karyawan)
    {
        $karyawan->delete();
        Alert::success('Data Karyawan', 'Berhasil dihapus!');
        return redirect('karyawan');
    }
}
