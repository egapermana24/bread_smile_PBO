@extends('layout')

@section('content')

<!-- halaman tampilan bahan keluar -->
<div class="container">
  <div class="row">
    <div class="col-12">
      <a href="{{route ('bahanKeluar.create') }}" class="btn btn-primary mb-3">Tambah</a>
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
                <button type="submit" class="btn btn-danger">Delete</button>
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