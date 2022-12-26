@extends('layout')

@section('content')

<!-- halaman create data bahan keluar-->
<div class="container">
  <div class="row">
    <div class="col-lg-5 col-md-6 col-sm-11">
      <form action="{{ route('bahanKeluar.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="kd_bahan">Kode Bahan</label>
          <!-- memilih kode bahan dengan javascript -->
          <select class="form-select form-control @error('kd_bahan') is-invalid @enderror" name="kd_bahan" required onchange="changeValue(this.value)">
            <option value="0" hidden disabled selected>Pilih Kode Bahan</option>
            @php
                $jsArray = "var prdName = new Array();\n";
            @endphp
            @foreach ($dataBahan as $bahan)
                <option value="{{ $bahan->kd_bahan }}">{{ $bahan->kd_bahan }} - {{ $bahan->nm_bahan }} </option>

                @php
                    $jsArray .= "prdName['" . $bahan['kd_bahan'] . "']= {
                          nm_bahan : '" . addslashes($bahan['nm_bahan']) . "',
                          harga_beli : '" . addslashes($bahan['harga_beli']) . "',
                          harga_beliTampil : '" . addslashes('Rp. ' . number_format($bahan['harga_beli'])) . "',
                          stok : '" . addslashes($bahan['stok']) . "',
                          nm_satuan : '" . addslashes($bahan['nm_satuan']) . "',
                          nm_satuan2 : '" . addslashes($bahan['nm_satuan']) . "',

                        };\n";
                @endphp
                
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="nm_bahan">Nama Bahan</label>
          <input type="text" class="form-control" name="nm_bahan" id="nm_bahan" readonly>
        </div>
        <div class="form-group">
          <label for="harga_beli">Harga</label>
          <input type="text" class="form-control" id="harga_beliTampil" readonly>
          <input type="hidden" class="form-control" name="harga_beli" id="harga_beli">
        </div>
        <label for="stok">Stok</label>
        <div class="form-group input-group">
          <input type="number" class="form-control" name="stok" id="stok" readonly>
          <input type="text" class="form-control" id="nm_satuan" readonly>
        </div>
        <label for="jumlah">Jumlah</label>
        <div class="form-group input-group">
          <input type="number" class="form-control  @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" required>
          <input type="text" class="form-control" id="nm_satuan2" readonly>
          @error('jumlah')
            <div class="col-12 text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="tgl_keluar">Tanggal Keluar</label>
          <input type="date" class="form-control  @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar') }}" required>
          @error('tgl_keluar')
            <div class="text-danger mt-2 mx-1">
                {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group">
          <label for="ket">Keterangan</label>
          <textarea type="text" class="form-control  @error('ket') is-invalid @enderror" name="ket" id="ket" placeholder="Masukkan Keterangan" required>{{ old('ket') }}</textarea>
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
    document.getElementById('nm_bahan').value = prdName[x].nm_bahan;
    document.getElementById('harga_beli').value = prdName[x].harga_beli;
    document.getElementById('harga_beliTampil').value = prdName[x].harga_beliTampil;
    document.getElementById('stok').value = prdName[x].stok;
    document.getElementById('nm_satuan').value = prdName[x].nm_satuan;
    document.getElementById('nm_satuan2').value = prdName[x].nm_satuan2;
  }
</script>

@endsection