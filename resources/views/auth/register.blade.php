@extends('layout')

@section('content')

<div class="container">
  <div class="row">

    <div class="register-box col-4 mb-5 mx-auto">
      <div class="register-logo">
        <b>Silahkan Mendaftar</b>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Masukkan datamu dengan benar</p>

          <form action="/register" method="post" class="needs-validation">
            @csrf
            <div class="input-group">

              <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" name="name" value="{{ old('name') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('name')
            <div class="text-danger mx-1">
              {{ $message }}
            </div>
            @enderror

            <div class="input-group mt-3">
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
              <div class=" input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            @error('email')
            <div class="text-danger mx-1">
              {{ $message }}
            </div>
            @enderror
            <div class="input-group mt-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('password')
            <div class="text-danger mx-1">
              {{ $message }}
            </div>
            @enderror
            <div class="input-group mt-3">
              <input type="password" class="form-control @error('rePassword') is-invalid @enderror" placeholder="Ulangi password" name="rePassword">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('rePassword')
            <div class="text-danger mx-1">
              {{ $message }}
            </div>
            @enderror
            <div class="row mt-3">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center">
            <p>- Atau -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Daftar dengan Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Daftar dengan Google+
            </a>
          </div>
          <a href="/login" class="text-center">Sudah Menjadi Anggota</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>

  </div>
</div>

@endsection