@extends('layout')

@section('content')

<!-- halaman tampil data satuan -->
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
      <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahSatuan">
        Tambah
      </button>

      <!-- agar tabel responsive -->
      <table class="table">
        <thead>
          <tr>
            <th>Nama Satuan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($satuan as $sat)
          <tr>
            <td>{{ $sat->nm_satuan }}</td>
            <td width="100px">
              <a href="{{ route('satuan.edit',$sat->id_satuan) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('satuan.destroy', $sat->id_satuan) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $sat->id_satuan }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $sat->id_satuan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $sat->nm_satuan }} ?</h1>
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
<div class="modal fade" id="tambahSatuan" tabindex="-1" aria-labelledby="tambahSatuanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahSatuanLabel">Tambah Satuan</h5>
        <!-- button clode -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('satuan.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="nm_satuan" class="form-label">Nama Satuan</label>
            <input type="text" class="form-control" id="nm_satuan" name="nm_satuan" placeholder="Masukkan nama satuan" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>



@endsection