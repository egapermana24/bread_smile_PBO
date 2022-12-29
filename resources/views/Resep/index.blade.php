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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $r->kd_resep }}">
                  Hapus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hapus{{ $r->kd_resep }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Apakah yakin ingin menghapus {{ $r->kd_resep }} ?</h1>
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