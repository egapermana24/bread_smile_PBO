<!-- halaman tampilan bahan masuk -->
@extends('layout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{route ('produkKeluar.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode produk</th>
            <th>Nama produk</th>
            <th>Pencatat</th>
            <th>Jumlah</th>
            <th>Tanggal Keluar</th>
            <th>Tanggal Expired</th>
            <th>Harga Jual</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($produkKeluar as $keluar)
          <tr>
            <td>{{ $keluar->kd_produk }}</td>
            <td>{{ $keluar->nm_produk }}</td>
            <td>{{ $keluar->name }}</td>
            <td>{{ $keluar->jumlah }} {{ $keluar->nm_satuan }}</td>
            <td>{{ date('d F Y',strtotime($keluar->tgl_keluar)) }}</td>
            <td>{{ date('d F Y',strtotime($keluar->tgl_expired)) }}</td>
            <td>Rp. {{ number_format($keluar->harga_jual, 0, ',', '.') }}</td>
            <td>Rp. {{ number_format($keluar->total, 0, ',', '.') }}</td>
            <td>{{ $keluar->ket }}</td>
            <td>
              <a href="{{ route('produkKeluar.edit', $keluar->id_produkKeluar) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('produkKeluar.destroy', $keluar->id_produkKeluar) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $keluar->kd_produk }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $keluar->kd_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $keluar->nm_produk }} ?</h1>
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