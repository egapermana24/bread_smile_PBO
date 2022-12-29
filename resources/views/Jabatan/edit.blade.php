@extends('layout')

@section('content')

<!-- halaman edit jabatan -->
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nm_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control @error('nm_jabatan') is-invalid @enderror" id="nm_jabatan" name="nm_jabatan" value="{{ $jabatan->nm_jabatan }}" required>
                        @error('nm_jabatan')
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