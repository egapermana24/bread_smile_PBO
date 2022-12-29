@extends('layout')

@section('content')

<!-- halaman tampilan bahan keluar -->
<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{ route('bahanKeluar.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Bahan</th>
            <th>Nama Bahan</th>
            <th>Tanggal Keluar</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bahanKeluar as $keluar)
          <tr>
            <td>{{ $keluar->kd_bahan }}</td>
            <td>{{ $keluar->nm_bahan }}</td>
            <td>{{ $keluar->tgl_keluar }}</td>
            <td>{{ $keluar->jumlah }} {{ $keluar->nm_satuan }}</td>
            <!-- format rupiah , , , -->
            <td>Rp. {{ number_format($keluar->total) }}</td>
            <td>{{ $keluar->ket }}</td>
            <td>
              <a href="{{ route('bahanKeluar.edit', $keluar->id_bahanKeluar) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('bahanKeluar.destroy', $keluar->id_bahanKeluar) }}" method="POST">
                @csrf
                @method('DELETE')
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $keluar->kd_bahan }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $keluar->kd_bahan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $keluar->nm_bahan }} ?</h1>
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