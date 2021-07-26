<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo e(secure_url('/admin')); ?>" class="brand-link">
    <img src="<?php echo e(url('storage/settings/'.$appSettings->logo)); ?>" alt="CMS Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?php echo e($appSettings->name); ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo e(url('storage/user_profile_photos/'.Auth::user()->profile_photo)); ?>" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo e(Auth::user()->name); ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-header">Main</li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin')); ?>" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo e(url('/admin/users')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(url('/admin/roles-permissions')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles & Permissions</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">Site Data</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Site Pages
            </p>
          </a>
        </li>

        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo e(secure_url('/admin/web-setting/edit/1')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Site Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo e(secure_url('/admin/app-setting/edit/1')); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>App Settings</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside><?php /**PATH D:\laragon\www\lara_cms\resources\views/dashboard/includes/sidebar.blade.php ENDPATH**/ ?>