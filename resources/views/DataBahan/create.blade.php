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
      <form action="{{ route('dataBahan.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="kd_bahan">Kode Bahan</label>
          <input type="text" class="form-control" id="kd_bahan" name="kd_bahan" value="{{ $kode_otomatis }}" readonly>
        </div>
        <div class="form-group">
          <label for="nm_bahan">Nama Bahan</label>
          <input type="text" class="form-control" name="nm_bahan" id="nm_bahan" placeholder="Masukkan Nama Bahan">
        </div>
        <div class="form-group">
          <label for="satuan">Satuan</label>
          <!-- mengambil satuan dari tabel satuan -->
          <select class="form-control" name="kd_satuan" id="satuan">
            <option disabled hidden selected>-- Pilih Satuan --</option>
            @foreach ($satuan as $sat)
            <option value="{{ $sat->id_satuan }}">{{ $sat->nm_satuan }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="harga_beli">Harga Beli</label>
          <input type="number" class="form-control" name="harga_beli" id="harga_beli" placeholder="Masukkan Harga Beli">
        </div>
        <div class="form-group">
          <label for="stok">Stok</label>
          <input type="number" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok">
        </div>
        <div class="form-group">
          <label for="ket">Keterangan</label>
          <textarea type="text" class="form-control" name="ket" id="ket" placeholder="Masukkan Keterangan"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        <button type="reset" class="btn btn-danger mb-3">Reset</button>
      </form>
    </div>
  </div>
</div>

@endsection