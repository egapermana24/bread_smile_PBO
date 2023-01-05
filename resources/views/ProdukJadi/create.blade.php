@extends('layout')

@section('content')

<!-- halaman create produk jadi -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <form action="{{ route('produkJadi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="kd_produk">Kode Produk</label>
          <input type="text" class="form-control" id="kd_produk" name="kd_produk" value="{{ $kode_otomatis }}" readonly>
        </div>
        <div class="form-group">
          <label for="nm_produk">Nama Produk</label>
          <input type="text" class="form-control" name="nm_produk" id="nm_produk" value="{{ old('nm_produk') }}" placeholder="Masukkan Nama Produk">
          @error('nm_produk')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group row">
          <div class="col-6">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" value="{{ old('stok') }}" placeholder="Masukkan Stok">
            @error('stok')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
          <div class="col-6">
            <label for="satuan">Satuan</label>
            <!-- mengambil satuan dari tabel satuan -->
            <select class="form-control" name="kd_satuan" id="satuan" value="{{ old('kd_satuan') }}">
              <option disabled hidden selected>-- Pilih Satuan --</option>
              @foreach ($satuan as $sat)
              @if (old('kd_satuan') == $sat->id_satuan)
              <option value="{{ $sat->id_satuan }}" selected>{{ $sat->nm_satuan }}</option>
              @else
              <option value="{{ $sat->id_satuan }}">{{ $sat->nm_satuan }}</option>
              @endif
              @endforeach
            </select>
            @error('kd_satuan')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="harga_jual">Harga Jual</label>
          <input type="number" class="form-control" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" placeholder="Masukkan Harga Jual">
          @error('harga_jual')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="ket">Keterangan</label>
          <textarea type="text" class="form-control" name="ket" id="ket" placeholder="Masukkan Keterangan">{{ old('ket') }}</textarea>
          @error('ket')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="foto">Gambar Produk</label>
          <div class="card" style="width: 10rem;">
            <img src="" class="card-img-top" id="output">
            <div class="card-body">
              <p class="card-text">
                <input type="file" id="foto" class="form-control @error('foto') is-invalid @enderror mx-2" style="width: 6.5rem;" name="foto" value="{{ old('foto') }}" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                @error('foto')
              <div class="text-danger mt-2 mx-1">
                {{ $message }}
              </div>
              @enderror
              </p>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        <button type="reset" class="btn btn-danger mb-3">Reset</button>
      </form>
    </div>
  </div>
</div>

@endsection