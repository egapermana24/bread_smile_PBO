@extends('layout')

@section('content')

<!-- halaman tampil data satuan -->
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">

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

            <a href="{{ route('sopir.create') }}" class="btn btn-primary mb-3">Tambah</a>

            <!-- agar tabel responsive -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Kode Sopir</th>
                        <th>No KTP</th>
                        <th>Nama Sopir</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sopir as $spr)
                    <tr>
                        <td>
                            <img src="{{ asset('images/'.$spr->foto) }}" height="100px">
                        </td>
                        <td>{{ $spr->kd_sopir }}</td>
                        <td>{{ $spr->no_ktp }}</td>
                        <td>{{ $spr->nm_sopir }}</td>
                        <td>{{ $spr->jenis_kelamin }}</td>
                        <td>{{ $spr->alamat }}</td>
                        <td>
                        <a href="{{ route('sopir.edit', $spr->kd_sopir) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sopir.destroy', $spr->kd_sopir) }}" method="POST">
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
@endsection