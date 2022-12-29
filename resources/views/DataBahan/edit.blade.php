@extends('layout')

@section('content')

<!-- halaman edit data bahan -->
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-11">
            <form action="{{ route('dataBahan.update', $dataBahan->kd_bahan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kd_bahan">Kode Bahan</label>
                    <input type="text" class="form-control" id="kd_bahan" name="kd_bahan" value="{{ $dataBahan->kd_bahan }}" readonly>
                </div>

                <div class="form-group">
                    <label for="nm_bahan">Nama Bahan</label>
                    <input type="text" class="form-control @error('nm_bahan') is-invalid @enderror" id="nm_bahan" name="nm_bahan" value="{{ old('nm_bahan', $dataBahan->nm_bahan) }}" required>
                    @error('nm_bahan')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" class="form-control @error('harga_beli') is-invalid @enderror" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', $dataBahan->harga_beli) }}" required>
                    @error('harga_beli')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok', $dataBahan->stok) }}" required>
                        @error('stok')
                        <div class="text-danger mt-2 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="kd_satuan">Satuan Massa</label>
                        <select class="form-control @error('satuan') is-invalid @enderror" name="kd_satuan" id="kd_satuan" required>
                            @foreach ($satuan as $sat)
                            @if (old('kd_satuan', $dataBahan->kd_satuan) == $sat->id_satuan)
                            <option value="{{ $sat->id_satuan }}" selected>{{ $sat->nm_satuan }}</option>
                            @else
                            <option value="{{$sat->id_satuan }}">{{ $sat->nm_satuan }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('satuan')
                        <div class="text-danger mt-2 mx-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket">{{ old('ket', $dataBahan->ket) }}</textarea>
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