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
                        <select name="kd_bahan" class="form-select form-control @error('kd_bahan') is-invalid @enderror" required>
                            @foreach ($dataBahan as $bahan)
                                @if (old('kd_bahan', $bahanMasuk->kd_bahan) == $bahan->kd_bahan)
                                    <option value="{{ $bahan->kd_bahan }}" selected>{{ $bahan->kd_bahan }} - {{ $bahan->nm_bahan }}</option>
                                @else
                                    <option value="{{ $bahan->kd_bahan }}">{{ $bahan->kd_bahan }} - {{ $bahan->nm_bahan }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('kd_bahan')
                            <div class="col-12 text-danger mt-2 mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah', $bahanMasuk->jumlah) }}" required>
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