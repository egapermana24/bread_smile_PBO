<!-- halaman tampilan bahan masuk -->
@extends('layout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{route ('produkMasuk.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode produk</th>
            <th>Nama produk</th>
            <th>Resep</th>
            <th>Pencatat</th>
            <th>Jumlah</th>
            <th>Tanggal Produksi</th>
            <th>Tanggal Expired</th>
            <th>Modal</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produkMasuk as $masuk)
          <tr>
            <td>{{ $masuk->kd_produk }}</td>
            <td>{{ $masuk->nm_produk }}</td>
            <td>{{ $masuk->bahan }}</td>
            <td>{{ $masuk->name }}</td>
            <td>{{ $masuk->jumlah }} {{ $masuk->nm_satuan }}</td>
            <td>{{ date('d F Y',strtotime($masuk->tgl_produksi)) }}</td>
            <td>{{ date('d F Y',strtotime($masuk->tgl_expired)) }}</td>
            <td>Rp. {{ number_format($masuk->modal, 0, ',', '.') }}</td>
            <td>{{ $masuk->ket }}</td>
            <td>
              <a href="{{ route('produkMasuk.edit', $masuk->id_produkMasuk) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('produkMasuk.destroy', $masuk->id_produkMasuk) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $masuk->kd_produk }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $masuk->kd_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $masuk->nm_produk }} ?</h1>
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