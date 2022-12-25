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
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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
