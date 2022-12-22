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
              <form action="{{ route('dataBahan.destroy', $bahan->kd_bahan) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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