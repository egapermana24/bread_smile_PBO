@extends('layout')

@section('content')

<!-- halaman edit data bahan masuk -->
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-11">
            <form action="{{ route('bahanMasuk.update', $bahanMasuk->id_bahanMasuk) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kd_bahan">Kode Bahan</label>
                    <!-- memilih kode bahan dengan javascript -->
                    <input type="hidden" name="kd_bahan" class="form-control @error('kd_bahan') is-invalid @enderror" id="kd_bahan" value=" {{ $bahanMasuk->kd_bahan  }}">
                    <input type="text" class="form-control @error('kd_bahan') is-invalid @enderror" required id="kd_bahan" value="{{ $bahanMasuk->kd_bahan . ' - ' . $bahanMasuk->nm_bahan  }}" readonly>
                    @error('kd_bahan')
                    <div class="col-12 text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <div class="input-group">
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror col-6" name="jumlah" id="jumlah" value="{{ old('jumlah', $bahanMasuk->jumlah) }}" required>
                        <input type="text" class="form-control col-6" value="{{ $dataBahan->nm_satuan }}" readonly>
                    </div>
                    @error('jumlah')
                    <div class="col-12 text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $bahanMasuk->tgl_masuk) }}" required>
                    @error('tgl_masuk')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea type="text" class="form-control @error('ket') is-invalid @enderror" name="ket" id="ket" placeholder="Masukkan Keterangan" required>{{ old('ket', $bahanMasuk->ket) }}</textarea>
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