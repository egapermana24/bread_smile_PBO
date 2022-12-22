@extends('layout')

@section('content')

<!-- halaman create data sopir -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <form action="{{ route('sopir.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="kd_sopir">Kode Sopir</label>
          <input type="text" class="form-control @error('kd_sopir') is-invalid @enderror" id="kd_sopir" name="kd_sopir" value="{{ $kode_otomatis }}" readonly>
          @error('kd_sopir')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="no_ktp">Nomor KTP</label>
          <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" placeholder="Masukkan Nomor KTP" value="{{ old('no_ktp') }}" required>
          @error('no_ktp')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="nm_sopir">Nama Sopir</label>
          <input type="text" class="form-control @error('nm_sopir') is-invalid @enderror" id="nm_sopir" name="nm_sopir" placeholder="Masukkan Nama Sopir" value="{{ old('nm_sopir') }}" required>
          @error('nm_sopir')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label>
          <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option disabled hidden selected>-- Silahkan Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
          @error('alamat')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="foto">Foto</label>
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