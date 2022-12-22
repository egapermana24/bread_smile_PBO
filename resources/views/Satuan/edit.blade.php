@extends('layout')

@section('content')

<!-- halaman edit satuan -->
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <form action="{{ route('satuan.update', $satuan->id_satuan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nm_satuan">Nama Satuan</label>
                        <input type="text" class="form-control" id="nm_satuan" name="nm_satuan" value="{{ $satuan->nm_satuan }}" required>
                        @error('nm_satuan')
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