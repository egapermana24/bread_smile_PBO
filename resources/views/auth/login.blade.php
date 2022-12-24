@extends('layout')

@section('content')

<div class="container">
  <div class="row">

    <div class="login-box col-lg-5 col-md-8 col-sm-11 mb-5 mx-auto">
      <div class="login-logo">
        <b>Silahkan Masuk</b>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Masuk Agar bisa mengakses website</p>

          <form action="/login" method="post">
            @csrf
            <div class="input-group">
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
              <div class="input-group-append">
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
            <div class="row mt-3">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Ingat Saya
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <p>- Atau -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Masuk Menguunakan Facebook
            </a>
            <a href="{{ route('auth.google') }}" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Masuk Menguunakan Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="#">Saya lupa Password</a>
          </p>
          <p class="mb-0">
            <a href="/register" class="text-center">Daftar agar bisa login</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>

  </div>
</div>

@endsection