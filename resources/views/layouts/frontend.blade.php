<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>SIG Layanan Kesehatan Kota Cimahi</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="{{ asset('AdminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('AdminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{ asset('AdminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('AdminLTE') }}/dist/js/demo.js"></script>
  
  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="{{ asset('leaflet-locatecontrol/dist/L.Control.Locate.min.css') }}" />
  <script src="{{ asset('leaflet-locatecontrol/src/L.Control.Locate.js') }}"></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light sticky-top navbar-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('AdminLTE') }}/dist/img/cimahi.png" alt="AdminLTE Logo" class="brand-image"
             style="height: 50px;" >
        <span class="brand-text font-weight-light" style="padding-left: 5px"><b>SIG Layanan Kesehatan Kota Cimahi</b></span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link outline-success">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kecamatan</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @foreach ($kecamatan as $data)
              <li><a href="/kecamatan/{{ $data->id_kecamatan }}" class="dropdown-item">{{ $data->kecamatan }}</a></li>
            @endforeach
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="/" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Kategori Layanan</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @foreach ($kategori as $data)
              <li><a href="/kategori/{{ $data->id_kategori }}" class="dropdown-item">{{ $data->kategori }}</a></li>
            @endforeach
            </ul>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}"><i
              class="fas fa-user"></i> Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark fw-bold"><small>{{ $title }}</small></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        @yield('content')
        </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <br>

  <footer class="bg-dark text-center text-white">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-1">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/robiul.sani.9/" role="button"
        ><i class="fab fa-facebook-f"></i
      ></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/robiul_sani31/" role="button"
        ><i class="fab fa-instagram"></i
      ></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/robiul-sani-811980274/" role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/robiulsani31" role="button"
        ><i class="fab fa-github"></i
      ></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-white" href="#">SIG Layanan Kesehatan Kota Cimahi</a>
  </div>
  <!-- Copyright -->
</footer>
</div>
<!-- ./wrapper -->
</body>


</html>
