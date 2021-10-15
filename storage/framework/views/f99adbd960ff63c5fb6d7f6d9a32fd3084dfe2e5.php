<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e(config('app.name', 'CMS')); ?> - <?php echo $__env->yieldContent('page_title'); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- All CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('admin_dashboard/assets/css/app.css')); ?>">
  <?php echo $__env->yieldContent('head_style'); ?>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?php if($appSettings): ?><?php echo e(asset('/storage/settings/'.$appSettings->logo)); ?><?php endif; ?>"
        alt="CMS Logo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php echo $__env->make('dashboard.admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php echo $__env->make('dashboard.admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Wrapper. Contains page content -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php echo $__env->make('dashboard.admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <!-- ./wrapper -->

  <!-- All js -->
  <script src="<?php echo e(asset('admin_dashboard/assets/js/app.js')); ?>"></script>
  <?php echo $__env->yieldContent('bottom_script'); ?>

</body>

</html><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/admin/layouts/app.blade.php ENDPATH**/ ?>