@extends('layout')

@section('content')

<!-- halaman tambah data karyawan -->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="nip">NIP</label>
          <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}" autofocus required>
          @error('nip')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label for="namaDepan">Nama Depan</label>
            <input type="text" class="form-control @error('namaDepan') is-invalid @enderror" name="namaDepan" id="namaDepan" placeholder="Nama Depan" value="{{ old('namaDepan') }}" required>
            @error('namaDepan')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group col-6">
            <label for="namaBelakang">Nama Belakang</label>
            <input type="text" class="form-control @error('namaBelakang') is-invalid @enderror" name="namaBelakang" id="namaBelakang" placeholder="Nama Belakang" value="{{ old('namaBelakang') }}">
            @error('namaBelakang')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label for="jabatan">Jabatan</label>
            <select class="form-control @error('kd_jabatan') is-invalid @enderror" name="kd_jabatan" id="jabatan" required>
              <option disabled hidden selected>-- Pilih Jabatan --</option>
              @foreach ($jabatan as $jbtn)
              @if (old('kd_jabatan') == $jbtn->id_jabatan)
              <option value="{{ $jbtn->id_jabatan }}" selected>{{ $jbtn->nm_jabatan }}</option>
              @else
              <option value="{{$jbtn->id_jabatan }}">{{ $jbtn->nm_jabatan }}</option>
              @endif
              @endforeach
            </select>
            @error('kd_jabatan')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group col-6">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
              <option disabled hidden selected>-- Silahkan Pilih --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
            @error('jenis_kelamin')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
            @error('tempat_lahir')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="form-group col-6">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
            @error('tgl_lahir')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="no_telp">No Telepon</label>
          <div class="input-group">
            <span class="input-group-text">+62</span>
            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" id="no_telp" placeholder="Nomor Telepon" value="{{ old('no_telp') }}" required>
          </div>
          @error('no_telp')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="provinsi">Provinsi</label>
          <input type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" id="provinsi" placeholder="Provinsi" value="{{ old('provinsi') }}" required>
          @error('provinsi')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="kota">Kota/Kabupaten</label>
          <div class="input-group">
            <select class="form-control form-select col-3" name="select_kota" id="select_kota" required>
              <option value="Kota" selected>Kota</option>
              <option value="Kab.">Kab</option>
            </select>
            <input type="text" class="form-control @error('kota') is-invalid @enderror col-9" name="kota" id="kota" placeholder="Kota/Kabupaten" value="{{ old('kota') }}" required>
            @error('kota')
            <div class="text-danger mt-2 mx-1">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <label for="kecamatan">Kecamatan</label>
          <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan" placeholder="Kecamatan" value="{{ old('kecamatan') }}" required>
          @error('kecamatan')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="alamat_lengkap">Alamat</label>
          <textarea type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" id="alamat_lengkap" placeholder="Masukkan Alamat" required>{{ old('alamat_lengkap') }}</textarea>
          @error('alamat_lengkap')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="role">Login Sebagai</label>
          <select class="form-control" name="role" id="role" required>
            <option disabled hidden selected>-- Silahkan Pilih --</option>
            <option value="backoffice">Backoffice</option>
            <option value="gudang">Gudang</option>
            <option value="produksi">Produksi</option>
            <option value="distribusi">Distribusi</option>
          </select>
          @error('role')
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