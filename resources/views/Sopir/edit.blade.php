@extends('layout')

@section('content')

<!-- halaman edit data sopir -->
<div class="container">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-11">
            <form action="{{ route('sopir.update', $sopir->kd_sopir) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kd_sopir">Kode Sopir</label>
                    <input type="text" class="form-control" id="kd_sopir" name="kd_sopir" value="{{ $sopir->kd_sopir }}" readonly>
                </div>
                <div class="form-group">
                    <label for="no_ktp">Nomor KTP</label>
                    <input type="text" class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" value="{{ $sopir->no_ktp }}" required>
                    @error('no_ktp')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nm_sopir">Nama Sopir</label>
                    <input type="text" class="form-control @error('nm_sopir') is-invalid @enderror" id="nm_sopir" name="nm_sopir" value="{{ $sopir->nm_sopir }}">
                    @error('nm_sopir')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="{{ $sopir->jenis_kelamin }}" hidden selected>{{ $sopir->jenis_kelamin }}</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat">{{ $sopir->alamat }}</textarea>
                    @error('alamat')
                    <div class="text-danger mt-2 mx-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <div class="card" style="width: 10rem;">
                        <img src="{{ asset('images/'.$sopir->foto) }}" class="card-img-top" alt="Foto Kamar" id="output">
                        <div class="card-body">
                            <p class="card-text">
                                <input type="file" class="form-control @error('foto') is-invalid @enderror mx-2" id="foto" name="foto" value="{{ old('foto') }}" accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
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