@extends('layout')

@section('content')

<!-- halaman create data bahan -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <!-- menampilkan pesan gagal -->
      @if ($errors->any())
      <div class=" alert alert-danger alert-dismissible fade show col-10 my-2 mx-auto" role="alert">
        <strong>Upss!</strong> Terjadi masalah<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach

        </ul>
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <form action="{{ route('resep.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="kd_resep">Kode Resep</label>
          <input type="text" class="form-control" id="kd_resep" name="kd_resep" value="{{ $kode_otomatis }}" readonly>
        </div>
        <div class="form-group">
          <label for="kd_produk">Nama Produk</label>
          <select class="form-control" name="kd_produk" id="kd_produk">
            <option disabled hidden selected>-- Pilih Produk --</option>
            @foreach ($produkJadi as $produk)
            @if (old('kd_produk') == $produk->kd_produk)
            <option value="{{ $produk->kd_produk }}" selected>{{ $produk->nm_produk }}</option>
            @else
            <option value="{{ $produk->kd_produk }}">{{ $produk->nm_produk }}</option>
            @endif
            @endforeach
          </select>
        </div>
        <label for="bahan">Bahan-bahan</label>
        <br>
        <span class="text-danger">*ceklis bahan yang dipilih</span>
        @foreach ($dataBahan as $bahan )
<<<<<<< HEAD
        <div class="input-group mb-2">
          <div class="input-group-text">
            <input class="form-check-input mt-0" type="checkbox" value="{{ $bahan->nm_bahan }}" name="nm_bahan[]">
          </div>
          <input type="text" class="form-control" value="{{ $bahan->nm_bahan }}" readonly>
          <input type="number" class="form-control" placeholder="jumlah" value="{{ old('jumlah') }}" name="jumlah[]">
          <input type="text" class="form-control" value="{{ $bahan->nm_satuan }}" readonly name="nm_satuan[]">

=======
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="{{ $bahan->kd_bahan, old('kd_bahan[]') }}" name="kd_bahan[]">
          <label class="form-check-label">
            {{ $bahan->nm_bahan }}
          </label>
>>>>>>> main
        </div>
        @endforeach
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        <button type="reset" class="btn btn-danger mb-3">Reset</button>
      </form>
    </div>
  </div>
</div>

@endsection