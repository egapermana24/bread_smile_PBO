<!-- halaman tampilan bahan masuk -->
@extends('layout')

@section('content')

<!-- halaman index data bahan -->
<div class="container">
  <div class="row">
    <div class="col-12 table-responsive">
      <!-- menampilkan pesan berhasil -->
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      <a href="{{ route('dataBahan.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <!-- agar tabel responsive -->
      <table class="table" id="datatable">
        <thead>
          <tr>
            <th>Kode Bahan</th>
            <th>Nama Bahan</th>
            <th>Harga Beli</th>
            <th>Stok</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dataBahan as $bahan)
          <tr>
            <td>{{ $bahan->kd_bahan }}</td>
            <td>{{ $bahan->nm_bahan }}</td>
            <td>Rp. {{ number_format($bahan->harga_beli, 0, ',', '.') }}</td>
            <td>{{ $bahan->stok }} {{ $bahan->nm_satuan }}</td>
            <td>{{ $bahan->ket }}</td>
            <td>
              <a href="{{ route('dataBahan.edit',$bahan->kd_bahan) }}" class="btn btn-sm btn-warning">Edit</a>
              <!-- FUNGSI HAPUS -->
              <form action="{{ route('dataBahan.destroy', $bahan->kd_bahan) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $bahan->nm_bahan }} ?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Data bahan yang dihapus tidak akan bisa dikembalikan!</p>
                      </div>
                      <div class="modal-footer mx-auto">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <!-- END FUNGSI HAPUS -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection