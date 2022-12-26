@extends('layout')

@section('content')

<!-- halaman create data bahan -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <form action="{{ route('dataBahan.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="kd_bahan">Kode Bahan</label>
          <input type="text" class="form-control" id="kd_bahan" name="kd_bahan" value="{{ $kode_otomatis }}" readonly>
        </div>

        <div class="form-group">
          <label for="nm_bahan">Nama Bahan</label>
          <input type="text" class="form-control @error('nm_bahan') is-invalid @enderror" name="nm_bahan" id="nm_bahan" placeholder="Masukkan Nama Bahan" value="{{ old('nm_bahan') }}" autofocus required>
          @error('nm_bahan')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="satuan">Satuan</label>
          <!-- mengambil satuan dari tabel satuan -->
          <select class="form-control @error('satuan') is-invalid @enderror" name="kd_satuan" id="satuan" required>
            <option disabled hidden selected>-- Pilih Satuan --</option>
              @foreach ($satuan as $sat)
                @if (old('kd_satuan') == $sat->id_satuan)
                    <option value="{{ $sat->id_satuan }}" selected>{{ $sat->nm_satuan }}</option>
                @else
                    <option value="{{$sat->id_satuan }}">{{ $sat->nm_satuan }}</option>
                @endif
              @endforeach
          </select>
          @error('kd_satuan')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="harga_beli">Harga Beli</label>
          <input type="number" class="form-control @error('harga_beli') is-invalid @enderror" name="harga_beli" id="harga_beli" placeholder="Masukkan Harga Beli" value="{{ old('harga_beli') }}" required>
          @error('harga_beli')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="stok">Stok</label>
          <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" placeholder="Masukkan Stok" value="{{ old('stok') }}" required>
          @error('stok')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="ket">Keterangan</label>
          <textarea type="text" class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket" placeholder="Masukkan Keterangan" required>{{ old('ket') }}</textarea>
          @error('ket')
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