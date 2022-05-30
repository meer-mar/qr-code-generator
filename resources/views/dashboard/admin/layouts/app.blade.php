<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'CMS') }} - @yield('page_title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/css/OverlayScrollbars.min.css"
    integrity="sha512-pYQcc5kgavar0ah58/O8hw/6Tbo3mWlmQTmvoi1i96cBz7jQYS9as5J+Nfy32rAHY6CgR9ExwnFMcBdGVcKM7g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin_dashboard/assets/css/adminlte.min.css') }}">
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

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"
    integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- overlayScrollbars -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.0/js/OverlayScrollbars.min.js"
    integrity="sha512-5R3ngaUdvyhXkQkIqTf/k+Noq3phjmrqlUQyQYbgfI34Mzcx7vLIIYTy/K1VMHkL33T709kfh5y6R9Xy/Cbt7Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin_dashboard/assets/js/adminlte.min.js') }}"></script>
  <!-- All js -->
  <script src="{{ asset('admin_dashboard/assets/js/app.js')}}"></script>
  @yield('bottom_script')

</body>

</html>