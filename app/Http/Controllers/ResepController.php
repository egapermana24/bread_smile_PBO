<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\DataBahan;
use App\Models\ProdukJadi;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // join dengan tabel produkJadi
        $resep = Resep::join('produkJadi', 'resep.kd_produk', '=', 'produkJadi.kd_produk')
            ->select('resep.*', 'produkJadi.nm_produk')
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

        $dataBahan = DataBahan::join('satuan', 'databahan.kd_satuan', '=', 'satuan.id_satuan')
            ->select('databahan.*', 'satuan.nm_satuan')
            ->get();
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
        $messages = [
            'kd_resep.required' => 'Kode Resep tidak boleh kosong',
            'kd_produk.required' => 'Kode Produk tidak boleh kosong',
            'nm_bahan.required' => 'Kode Bahan tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'nm_satuan.required' => 'Satuan tidak boleh kosong',
        ];

        $request->validate([
            'kd_resep' => 'required',
            'kd_produk' => 'required',
            'nm_bahan' => 'array|required',
            'jumlah' => 'array|required',
            'nm_satuan' => 'array|required',
        ], $messages);
        $kd_produk = $request->kd_produk; //HARUS UNIQ
        $nm_bahan = $request->input('nm_bahan');
        $jumlah = $request->input('jumlah');
        $nm_satuan = $request->input('nm_satuan');



        if ($request->kd_produk == 0) {
            Alert::error('Data Resep', 'Gagal ditambahakan!');
            return redirect()->route('resep.create')->withInput();
        } else {



            if ($jumlah == '' || $jumlah == null) {
                Alert::error('Data Resep', 'Gagal ditambahakan!');
                return redirect()->route('resep.create')->withInput();
            }

            if ($kd_produk == !null) {

                // membersihkan nama bahan jika tidak ada jumlah
                $nm_bahan = array_intersect_key($nm_bahan, $jumlah);

                // menampilkan $nm_satuan berdasarkan $nm_bahan yang dipilih
                $nm_satuan = array_intersect_key($nm_satuan, $nm_bahan, $jumlah);

                // menghilangkan null pada array
                $jumlah = array_intersect_key($jumlah, $nm_bahan);

                // menggabungkan 2 array berdasarkan index yang sama dan ubah menjadi string
                $bahan = array_map(function ($nm_bahan, $jumlah, $nm_satuan) {
                    return $nm_bahan . ' ' . '(' . $jumlah . ' ' . $nm_satuan . ')';
                }, $nm_bahan, $jumlah, $nm_satuan);

                // mengubah array menjadi string
                $bahan = implode(', ', $bahan);

                // masukkan ke database
                Resep::create([
                    'kd_resep' => $request->kd_resep,
                    'kd_produk' => $kd_produk,
                    'bahan' => $bahan,
                ]);

                Alert::success('Data Resep', 'Berhasil ditambahakan!');
                return redirect()->route('resep.index');
            } elseif (htmlspecialchars(array_key_exists('nm_bahan', $request->input()))) {
                Alert::error('Data Resep', 'Gagal ditambahakan!');
                return redirect()->route('resep.create')->withInput();
            } else {
                Alert::error('Data Resep', 'Gagal ditambahakan!');
                return redirect()->route('resep.create')->withInput();
            }
            Alert::error('Data Resep', 'Gagal ditambahakan!');
            return redirect()->route('resep.create')->withInput();
        }






        // METODE LAMA
        // $kd_resep = $request->kd_resep;
        // $kd_bahan = $request->input('kd_bahan');
        // $message = [
        //     'kd_bahan.required' => 'Pilih minimal 1 bahan',
        // ];

        // $request->validate([
        //     'kd_bahan' => 'required',
        // ], $message);
        // if (!empty($kd_bahan)) { // Jika ada checkbox yang dipilih
        //     $will_insert = []; // Buat array kosong
        //     foreach ($kd_bahan as $key => $value) { // Lakukan looping pada array checkbox
        //         array_push($will_insert, ['kd_bahan' => $value]);
        //     }

        //     // masukkan semua data ke tabel resep

        //     DB::table('resep')->insert(['kd_resep' => $kd_resep, 'kd_bahan' => $will_insert]);

        //     Alert::success('Data Resep', 'Berhasil ditambahakan!');
        //     return redirect('resep');
        // } else {
        //     Alert::error('Data Resep', 'Gagal ditambahakan!');
        //     return redirect('resep');
        // }
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
        // hapus data resep
        Resep::destroy($resep->kd_resep);
        Alert::success('Data Resep', 'Berhasil dihapus!');
        return redirect('resep');
    }
}
