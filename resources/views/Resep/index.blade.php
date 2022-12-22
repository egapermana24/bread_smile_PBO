<!-- halaman tampilan bahan masuk -->
@extends('layout')

@section('content')
@php
$dataBahan = $resep->keyBy('id')->toArray();
dd($dataBahan)
@endphp
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
      <a href="{{ route('resep.create') }}" class="btn btn-primary mb-3">Tambah</a>
      <!-- agar tabel responsive -->
      <table class="table" id="datatable">
        <thead>
          <tr>
            <th>Kode Resep</th>
            <th>Nama Produk</th>
            <th>Bahan-bahan</th>
            <th>Keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resep as $r)
          <tr>
            <td>{{ $r->kd_resep }}</td>
            <td>{{ $r->kd_produk }}</td>
            <td>
              @php
              $bahan = $explode(',' ,$r->kd_bahan);
              @endphp
              @foreach ($bahan as $b)
              {{ ($dataBahan[$b]->nm_bahan) }}
              @endforeach
            </td>
            <td>{{ $r->ket }}</td>
            <td>
              <a href="" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('resep.destroy', $r->kd_resep) }}" method="POST">
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