<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo e(url('/admin')); ?>" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo e(url('/')); ?>" class="nav-link" target="_blank">Website</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fas fa-user mr-2"></i> <?php echo e(Auth::user()->name); ?>

      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?php echo e(secure_url('/admin/user/edit/'. Auth::user()->id)); ?>" class="dropdown-item">
          <i class="fas fa-user-edit mr-2"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> <?php echo e(__('Logout')); ?>

        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
        </form>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav><?php /**PATH E:\laragon\www\lara_cms\resources\views/dashboard/includes/header.blade.php ENDPATH**/ ?>