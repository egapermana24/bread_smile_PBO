@extends('layout')

@section('content')

<!-- halaman edit mobil -->
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <form action="{{ route('mobil.update', $mobil->kd_mobil) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kd_mobil">Kode Mobil</label>
                        <input type="text" class="form-control" id="kd_mobil" name="kd_mobil" value="{{ $mobil->kd_mobil }}" readonly>
                        @error('kd_mobil')
                            <div class="text-danger mt-2 mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk Mobil</label>
                        <input type="text" class="form-control @error('merk') is-invalid @enderror" id="merk" name="merk" value="{{ old('merk', $mobil->merk) }}" required>
                        @error('merk')
                            <div class="text-danger mt-2 mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="plat_nomor">Plat Nomor</label>
                        <input type="text" class="form-control @error('plat_nomor') is-invalid @enderror" id="plat_nomor" name="plat_nomor" value="{{ old('plat_nomor', $mobil->plat_nomor) }}" required>
                        @error('plat_nomor')
                            <div class="text-danger mt-2 mx-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <textarea class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket">{{ old('ket', $mobil->ket) }}</textarea>
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