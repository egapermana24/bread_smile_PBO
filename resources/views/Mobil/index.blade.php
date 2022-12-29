@extends('layout')

@section('content')

<!-- halaman tampil data satuan -->
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">

            <!-- menampilkan pesan gagal -->
            @if ($errors->any())
            <div class=" alert alert-danger alert-dismissible fade show col-12 my-2 mx-auto" role="alert">
                <strong>Upss!</strong> Terjadi masalah<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- menampilkan pesan berhasil -->
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <!-- button modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMobil">
                Tambah
            </button>

            <!-- agar tabel responsive -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Mobil</th>
                        <th>Merk</th>
                        <th>Plat Nomor</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mobil as $mbl)
                    <tr>
                        <td>{{ $mbl->kd_mobil }}</td>
                        <td>{{ $mbl->merk }}</td>
                        <td>{{ $mbl->plat_nomor }}</td>
                        <td>{{ $mbl->ket }}</td>
                        <td>
                            <a href="{{ route('mobil.edit', $mbl->kd_mobil) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('mobil.destroy', $mbl->kd_mobil) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $mbl->kd_mobil }}">
                                    Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus{{ $mbl->kd_mobil }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus mobil berplat {{ $mbl->plat_nomor }} ?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Data yang dihapus tidak akan bisa dikembalikan!</p>
                                            </div>
                                            <div class="modal-footer mx-auto">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                                <button type="submit" class="btn btn-primary">Ya</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end button trigger modal -->
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="tambahMobil" tabindex="-1" aria-labelledby="tambahMobilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMobilLabel">Tambah Mobil</h5>
                <!-- button clode -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mobil.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kd_mobil" class="form-label">Kode Mobil</label>
                        <input type="text" class="form-control" id="kd_mobil" name="kd_mobil" value="{{ $kode_otomatis }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="merk" class="form-label">Merk Mobil</label>
                        <input type="text" class="form-control" id="merk" name="merk" placeholder="Masukkan Merk Mobil" required>
                    </div>
                    <div class="mb-3">
                        <label for="plat_nomor" class="form-label">Plat Nomor</label>
                        <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" placeholder="Masukkan Plat Nomor" required>
                    </div>
                    <div class="mb-3">
                        <label for="ket" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection