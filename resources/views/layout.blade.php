<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- mangambil tittle dari controller -->
  <title>{{ $tittle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('Assets/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- css saya -->
  <link rel="stylesheet" href="{{ asset('Assets/css/style.css')}}">
</head>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('Assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto mr-4">
        <!-- Navbar Search -->
        <li class="nav-item">
        <li class="nav-item d-none d-sm-inline-block">
          @if (!Auth::check())
          <a href="/register" class="nav-link">Register</a>
          @endif
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          @if (!Auth::check())
          <a href="/login" class="nav-link">Login</a>
          @endif
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          @if (Auth::check())
          <form action="/logout" method="POST">
            @csrf
            <a class="nav-link"><button class="text-secondary" style="border: none; background:none;" type="submit">Logout</button></a>
          </form>
          @endif
        </li>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ asset('Assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Bread Smile</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset('Assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Administrator</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Dashboard
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/satuan" class="nav-link {{ Request::is('satuan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Satuan Massa
                </p>
              </a>
            </li>
            <li class="nav-item">
              <!-- bahan baku -->
              <a href="#" class="nav-link {{ Request::is('dataBahan*', 'bahanMasuk*', 'bahanKeluar*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Bahan Baku
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/dataBahan" class="nav-link {{ Request::is('dataBahan*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Bahan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bahanMasuk" class="nav-link {{ Request::is('bahanMasuk*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pembelian Bahan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/bahanKeluar" class="nav-link {{ Request::is('bahanKeluar*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemakaian Bahan</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <!-- Produk -->
              <a href="#" class="nav-link {{ Request::is('resep*', 'produkJadi*', 'produkMasuk*', 'produkKeluar*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Produk
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/resep" class="nav-link {{ Request::is('resep*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Resep Produk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/produkJadi" class="nav-link {{ Request::is('produkJadi*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Produk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/produkMasuk" class="nav-link {{ Request::is('produkMasuk*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pembuatan Produk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/produkKeluar" class="nav-link {{ Request::is('produkKeluar*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan Produk</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <!-- Laporan -->
              <a href="#" class="nav-link {{ Request::is('mobil*', 'sopir*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Pengiriman
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/mobil" class="nav-link {{ Request::is('mobil*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mobil</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/sopir" class="nav-link {{ Request::is('sopir*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sopir</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <!-- Laporan -->
              <a href="#" class="nav-link {{ Request::is('lapPermintaanBahan*', 'lapPermintaanProduk*', 'lapPengirimanProduk*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Laporan
                  <i class="fas fa-angle-left right"></i>
                  <!-- <span class="badge badge-info right">6</span> -->
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/lapPermintaanBahan" class="nav-link {{ Request::is('lapPermintaanBahan*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan Bahan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/lapPermintaanProduk" class="nav-link {{ Request::is('lapPermintaanProduk*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permintaan Produk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/lapPengirimanProduk" class="nav-link {{ Request::is('lapPengirimanProduk*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengiriman Produk</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">{{ $judul }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dataBahan">{{ $menu }}</a></li>
                <li class="breadcrumb-item active">{{ $submenu }}</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('content')
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Bread Smile</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('Assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('Assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('Assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('Assets/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('Assets/plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('Assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('Assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('Assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('Assets/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('Assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('Assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('Assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('Assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('Assets/dist/js/adminlte.js')}}"></script>
  <!-- bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>