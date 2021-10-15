<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="@if($webSettings) {{ $webSettings->site_url }} @else {{ __('#') }} @endif" class="nav-link"
        target="_blank">Website</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fas fa-user mr-2"></i> {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ secure_url('/admin/user/edit/'. Auth::user()->id) }}" class="dropdown-item">
          <i class="fas fa-user-edit mr-2"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="dropdown-item">
          <i class="fas fa-users mr-2"></i> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>