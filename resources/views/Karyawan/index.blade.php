@extends('layout')

@section('content')

<!-- halaman index data karyawan -->
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <!-- menampilkan pesan berhasil -->
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <a href="{{ route('karyawan.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <!-- agar tabel responsive -->
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>TTL</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawan as $krywn)
                    <tr>
                        <td>
                            <img src="{{ asset('images/'.$krywn->foto) }}" height="100px">
                        </td>
                        <td>{{ $krywn->nip }}</td>
                        <td>{{ $krywn->nm_karyawan }}</td>
                        <td>{{ $krywn->nm_jabatan }}</td>
                        <td>{{ $krywn->ttl }}</td>
                        <td>{{ $krywn->no_telp }}</td>
                        <td>{{ $krywn->alamat }}</td>
                        <td>
                            <a href="{{ route('karyawan.edit',$krywn->id_karyawan) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('karyawan.destroy', $krywn->id_karyawan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $krywn->id_karyawan }}">
                                    Hapus
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="hapus{{ $krywn->id_karyawan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $krywn->nm_karyawan }} ?</h1>
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

@endsection