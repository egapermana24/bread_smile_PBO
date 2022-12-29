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
      <a href="{{ route('produkJadi.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <!-- agar tabel responsive -->
      <table class="table" id="datatable">
        <thead>
          <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Stok</th>
            <th>Tanggal Produksi</th>
            <th>Tanggal Expired</th>
            <th>Modal</th>
            <th>Harga Jual</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produkJadi as $produk)
          <tr>
            <td>{{ $produk->kd_produk }}</td>
            <td>{{ $produk->nm_produk }}</td>
            <td>{{ $produk->stok }} {{ $produk->nm_satuan }}</td>
            <td>{{ date('d F Y', strtotime($produk->tgl_produksi)) }}</td>
            <td>{{ date('d F Y', strtotime($produk->tgl_expired)) }}</td>
            <td>Rp. {{ number_format($produk->modal, 0, ',', '.') }}</td>
            <td>Rp. {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
            <td>{{ $produk->ket }}</td>
            <td>
              <a href="{{ route('produkJadi.edit',$produk->kd_produk) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('produkJadi.destroy', $produk->kd_produk) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $produk->kd_produk }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $produk->kd_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $produk->nm_produk }} ?</h1>
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