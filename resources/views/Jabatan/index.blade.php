@extends('layout')

@section('content')

<!-- halaman tampil data jabatan -->
<div class="container">
    <div class="row">
        <div class="col-3 table-responsive">

            <!-- menampilkan pesan gagal -->
            @if ($errors->any())
                <div class=" alert alert-danger alert-dismissible fade show col-10 my-2 mx-auto" role="alert">
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
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahJabatan">
                Tambah
            </button>

            <!-- agar tabel responsive -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatan as $jbtn)
                        <tr>
                            <td>{{ $jbtn->nm_jabatan }}</td>
                            <td width="100px">
                            <a href="{{ route('jabatan.edit',$jbtn->id_jabatan) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('jabatan.destroy', $jbtn->id_jabatan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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
<div class="modal fade" id="tambahJabatan" tabindex="-1" aria-labelledby="tambahJabatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahJabatanLabel">Tambah Jabatan</h5>
                <!-- button clode -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nm_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nm_jabatan" name="nm_jabatan" placeholder="Masukkan nama jabatan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection