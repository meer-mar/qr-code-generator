<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'CMS') }} - @yield('page_title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- All CSS -->
  <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/app.css') }}">
  @yield('head_style')

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="@if($appSettings){{ asset('/storage/settings/'.$appSettings->logo) }}@endif"
        alt="CMS Logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('dashboard.admin.includes.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('dashboard.admin.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('dashboard.admin.includes.footer')
  </div>
  <!-- ./wrapper -->

  <!-- All js -->
  <script src="{{ asset('admin_dashboard/assets/js/app.js')}}"></script>
  @yield('bottom_script')

</body>

</html>