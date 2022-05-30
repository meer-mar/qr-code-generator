<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ secure_url('/admin') }}" class="brand-link">
    <img src="@if($appSettings){{ asset('/storage/settings/'.$appSettings->logo) }}@endif" alt="CMS Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">@if($appSettings){{ $appSettings->name }}@endif</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ url('storage/user_profile_photos/'.Auth::user()->profile_photo) }}" class="img-circle elevation-2"
          alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
        <li class="nav-header">Main</li>
        <li class="nav-item">
          <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @permission('view.users')
        <li
          class="nav-item {{ request()->is('admin/users') || request()->is('admin/roles-permissions') || request()->is('admin/user/*') || request()->is('admin/role/*') ? 'menu-open' : '' }}">
          <a href="#"
            class="nav-link {{ request()->is('admin/users') || request()->is('admin/roles-permissions') || request()->is('admin/user/*') || request()->is('admin/role/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ url('/admin/users') }}"
                class="nav-link {{ request()->is('admin/users') || request()->is('admin/user/*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/roles-permissions') }}"
                class="nav-link {{ request()->is('admin/roles-permissions') || request()->is('admin/role/*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles & Permissions</p>
              </a>
            </li>
          </ul>
        </li>
        @endpermission

        @permission('view.pages')
        <li class="nav-header">Site Data</li>
        <li class="nav-item">
          <a href="{{ secure_url('/admin/pages') }}"
            class="nav-link {{ request()->is('admin/pages') || request()->is('admin/page/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Site Pages
            </p>
          </a>
        </li>
        @endpermission

        @permission('view.blog.category')
        <li class="nav-item">
          <a href="{{ route('blog.category.view') }}"
            class="nav-link {{ request()->is('admin/blog/*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Blogs
            </p>
          </a>
        </li>
        @endpermission

        <li class="nav-header">Settings</li>
        <li
          class="nav-item {{ request()->is('admin/web-setting/*') || request()->is('admin/app-setting/*') ? 'menu-open' : ''}}">
          <a href="#"
            class="nav-link {{ request()->is('admin/web-setting/*') || request()->is('admin/app-setting/*') ? 'active' : ''}}">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @permission('update.web.settings')
            <li class="nav-item">
              <a href="{{ secure_url('/admin/web-setting/edit/1') }}"
                class="nav-link {{ request()->is('admin/web-setting/*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Web Settings</p>
              </a>
            </li>
            @endpermission

            @permission('update.app.settings')
            <li class="nav-item">
              <a href="{{ secure_url('/admin/app-setting/edit/1') }}"
                class="nav-link {{ request()->is('admin/app-setting/*') ? 'active' : ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>App Settings</p>
              </a>
            </li>
            @endpermission
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>