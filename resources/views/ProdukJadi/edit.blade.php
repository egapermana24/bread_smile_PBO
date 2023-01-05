@extends('layout')

@section('content')

<!-- halaman edit data produk -->
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-11">
            <form action="{{ route('produkJadi.update', $produkJadi->kd_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kd_produk">Kode Produk</label>
                    <input type="text" class="form-control" id="kd_produk" name="kd_produk" value="{{ $produkJadi->kd_produk }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nm_produk">Nama Produk</label>
                    <input type="text" class="form-control" id="nm_produk" name="nm_produk" value="{{ $produkJadi->nm_produk }}" required>
                    @error('nm_produk')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" value="{{ $produkJadi->stok }}" required>
                    @error('stok')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kd_satuan">Satuan</label>
                    <select class="form-control" name="kd_satuan" id="kd_satuan">
                        <option value="{{ $produkJadi->kd_satuan }}" selected hidden>{{ $produkJadi->nm_satuan }}</option>
                        @foreach ($satuan as $sat)
                        <option value="{{ $sat->id_satuan }}">{{ $sat->nm_satuan }}</option>
                        @endforeach
                    </select>
                    @error('kd_satuan')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="{{ $produkJadi->harga_jual }}" required>
                    @error('harga_jual')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea class="form-control" id="ket" name="ket" required>{{ $produkJadi->ket }}</textarea>
                    @error('ket')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Gambar Produk</label>
                    <div class="card" style="width: 10rem;">
                        <img src="{{ asset('images/'.$produkJadi->foto) }}" class="card-img-top" alt="Foto Kamar" id="output">
                        <div class="card-body">
                            <p class="card-text">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror mx-2" style="width: 6.5rem;" id="foto" name="foto" value="{{ old('foto') }}" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </p>
                        </div>
                    </div>
                    @error('foto')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                <button type="reset" class="btn btn-danger mb-3">Reset</button>
            </form>
        </div>
    </div>
</div>

@endsection