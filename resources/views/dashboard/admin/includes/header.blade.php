<nav class="navbar navbar-expand-lg main-navbar">
    <div class="mr-2 form-inline">
        <ul class="mr-3 navbar-nav d-flex align-items-center">
            <li><a href="" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="" data-toggle="search" class="nav-link nav-link-lg d-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </div>

    <!-- User Profile on the Left Side -->
    <ul class="navbar-nav navbar-right"style="margin-left: 67%;">
        <li class="dropdown dropdown-list-toggle">
            <a target="_blank" href="{{ route('home') }}" class="nav-link nav-link-lg">
                <i class="fas fa-home"></i> Visit Website
            </a>
        </li>
        <li class="dropdown"><a href="" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ url('storage/user_profile_photos/' . Auth::user()->profile_photo) }}"
                    class="mr-1 rounded-circle">

                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>


                <a href="" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="javascript:;" class="dropdown-item has-icon d-flex align-items-center text-danger"
                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
            </div>
        </li>

    </ul>
</nav>
