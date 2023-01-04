@extends('layout')

@section('content')

<!-- halaman create data produk -->
<div class="container">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-11">
      <form action="{{ route('produkMasuk.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="kd_produk">Kode produk</label>
          <!-- memilih kode produk dengan javascript -->
          <select name="kd_produk" class="form-select form-control @error('kd_produk') is-invalid @enderror" required autofocus onchange="changeValue(this.value)" onclick="changeValue(this.value)">
            <option value="0" hidden disabled selected>Pilih Kode produk</option>

            @php
            $jsArray = "var prdName = new Array();\n";
            @endphp

            @foreach ($produkJadi as $produk)
            <option value="{{ $produk->kd_produk }}">{{ $produk->kd_produk }} - {{ $produk->nm_produk }} </option>

            @php
            $jsArray .= "prdName['" . $produk['kd_produk'] . "']= {
            nm_produk : '" . addslashes($produk['nm_produk']) . "',
            stok : '" . addslashes($produk['stok']) . "',
            nm_satuan : '" . addslashes($produk['nm_satuan']) . "',
            nm_satuan2 : '" . addslashes($produk['nm_satuan']) . "',

            };\n";
            @endphp

            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="nm_produk">Nama produk</label>
          <input type="text" class="form-control" id="nm_produk" readonly>
        </div>

        <label for="stok">Stok</label>
        <div class="form-group input-group">
          <input type="number" class="form-control" name="stok" id="stok" readonly>
          <input type="text" class="form-control" id="nm_satuan" readonly>
        </div>

        <label for="jumlah">Jumlah</label>
        <div class="form-group input-group">
          <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
          <input type="text" class="form-control" id="nm_satuan2" readonly>
          @error('jumlah')
          <div class="col-12 text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="modal">Modal</label>
          <input type="number" class="form-control @error('jumlah') is-invalid @enderror" name="modal" id="modal" value="{{ old('modal') }}">
          @error('modal')
          <div class="col-12 text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="tgl_produksi">Tanggal Produksi</label>
          <input type="date" class="form-control @error('tgl_produksi') is-invalid @enderror" name="tgl_produksi" id="tgl_produksi" value="{{ old('tgl_produksi') }}" required>
          @error('tgl_produksi')
          <div class="text-danger mt-2 mx-1">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="tgl_expired">Tanggal Expired</label>
          <input type="date" class="form-control @error('tgl_expired') is-invalid @enderror" name="tgl_expired" id="tgl_expired" value="{{ old('tgl_expired') }}" required>
          @error('tgl_expired')
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

<script type="text/javascript">
  <?= $jsArray; ?>

  function changeValue(x) {
    document.getElementById('nm_produk').value = prdName[x].nm_produk;
    document.getElementById('stok').value = prdName[x].stok;
    document.getElementById('nm_satuan').value = prdName[x].nm_satuan;
    document.getElementById('nm_satuan2').value = prdName[x].nm_satuan2;
  }
</script>

@endsection