@php


@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    @include('sweetalert::alert')
    <div class="row justify-content-center">
        <div class="col-lg-5">
            @if (session()->has('registerError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('registerError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <main class="form-registration w-100 m-auto mt-5">
                <form action="/register" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>

                    @php
                    $jsArray = "var prdName = new Array();\n";
                    @endphp
                    <div class="form-floating">
                        <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip" value="{{ old('nip') }}" placeholder="Nip" required onkeyup="isi_nama(this.value)" onclick="isi_nama(this.value)" onkeydown="hapus(this.value)">
                        @foreach ($karyawan as $krywn)
                        @php
                        $jsArray .= "prdName['" . $krywn['nip'] . "']= {
                        nm_karyawan : '" . addslashes($krywn['nm_karyawan']) . "',
                        };\n";
                        @endphp
                        @endforeach
                        <label for="nip">Nip</label>
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mt-2">
                        <input type="text" class="form-control @error('nm_karyawan') is-invalid @enderror" name="nm_karyawan" id="nm_karyawan" value="{{ old('nm_karyawan') }}" placeholder="Nama Lengkap" readonly>
                        <label for="nm_karyawan">Nama Lengkap</label>
                        @error('nm_karyawan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row mt-5">
                        <div class="form-floating px-1 col-6">
                            <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating px-1 col-6">
                            <input type="password" class="form-control rounded-bottom @error('rePassword') is-invalid @enderror" name="rePassword" id="rePassword" placeholder="Konfirmasi Password" required>
                            <label for="rePassword">Konfirmasi Password</label>
                            @error('rePassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-3">Already register? <a href="/login" class="text-decoration-none">Login Now!</a></small>
            </main>
        </div>
    </div>
    <script type="text/javascript">
        <?= $jsArray; ?>

        function isi_nama(x) {
            if (x == "") {
                document.getElementById('nm_karyawan').value = "";
            } else {
                document.getElementById('nm_karyawan').value = prdName[x].nm_karyawan;
            }
        }
    </script>
</body>

</html>