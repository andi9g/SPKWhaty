
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SPK MAUT</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css', []) }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css', []) }}">
  <link rel="stylesheet" href="{{ url('dist/css/cssku.css?v=12', []) }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="sidebar-mini sidebar-closed text-sm">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light pinkku">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout', []) }}" role="button">
          <i class="fa fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar text-dark pinkku2 elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home', []) }}" class="brand-link pink-gelapku">
      <h4 class="brand-image rounded-circle px-1 ml-0 text-danger text-bold" style="padding-top:4px">SPK</h4>
      <span class="brand-text text-bold text-white" style="font-size: 17px;letter-spacing: 2px">MAUT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-1 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('gambar/user.png', []) }}" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-danger">{{Session::get('nama')}}</a>
          <span>{{Session::get('posisi')}}</span>
        </div>
      </div>
      <hr>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item hoverku">
            <a href="{{ url('home', []) }}" class="nav-link @yield('activekuhome')">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item hoverku">
            <a href="{{ url('toko', []) }}" class="nav-link @yield('activekuinstansi')">
              <i class="nav-icon fa fa-city"></i>
              <p>
                Data Toko
              </p>
            </a>
          </li>

          <li class="nav-item hoverku">
            <a href="{{ url('kriteria', []) }}" class="nav-link @yield('activekukriteria')">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Kriteria
              </p>
            </a>
          </li>

          <li class="nav-item hoverku">
            <a href="{{ url('nilai', []) }}" class="nav-link @yield('activekunilai')">
              <i class="nav-icon fa fa-star"></i>
              <p>
                Nilai Matriks
              </p>
            </a>
          </li>

          <li class="nav-item hoverku">
            <hr>
            <a href="{{ url('admin', []) }}" class="nav-link @yield('activekuadmin')">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          <li class="nav-item hoverku">
            <a href="{{ url('pengunjung', []) }}" class="nav-link @yield('activekupengunjung')">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Data Pengunjung
              </p>
            </a>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('judul')</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm footerku">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js', []) }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js', []) }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js', []) }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ url('dist/js/demo.js', []) }}"></script> --}}
@include('sweetalert::alert')
</body>
</html>
