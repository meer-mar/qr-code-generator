<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'CMS') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- All CSS -->
  <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/app.css') }}">

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="{{ url('storage/settings/'.$appSettings->logo) }}" alt="CMS Logo" height="60"
        width="60">
    </div>

    <!-- Navbar -->
    @include('dashboard.includes.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('dashboard.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('dashboard.includes.footer')
  </div>
  <!-- ./wrapper -->

  <!-- All js -->
  <script src="{{ asset('admin_dashboard/assets/js/app.js')}}"></script>

</body>

</html>