<!-- halaman tampilan bahan masuk -->
@extends('layout')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{route ('bahanMasuk.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Bahan</th>
            <th>Nama Bahan</th>
            <th>Tanggal Masuk</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bahanMasuk as $masuk)
          <tr>
                                                                <td>{{ $masuk->kd_bahan }}</td>
            <td>{{ $masuk->nm_bahan }}</td>
            <td>{{ $masuk->tgl_masuk }}</td>
            <!-- format rupiah , , , -->
            <td>{{ 'Rp. ' . number_format($masuk->harga_beli) }}</td>
            <td>{{ $masuk->jumlah }} {{ $masuk->nm_satuan }}</td>
            <!-- format rupiah , , , -->
            <td>Rp. {{ number_format($masuk->total) }}</td>
            <td>{{ $masuk->ket }}</td>
            <td>
              <a href="{{ route('bahanMasuk.edit', $masuk->id_bahanMasuk) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('bahanMasuk.destroy', $masuk->id_bahanMasuk) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $masuk->kd_bahan }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $masuk->kd_bahan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $masuk->nm_bahan }} ?</h1>
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