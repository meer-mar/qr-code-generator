<div class="main-sidebar" style="overflow: hidden; outline: none;" tabindex="1">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        @php
            $setting = App\Models\WebSetting::first();
        @endphp
            <a href="{{ secure_url('/admin') }}">
                <img class="admin_logo"
                    src="{{ asset('/storage/settings/' . $setting->logo) }}"
                    alt="logo">
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ secure_url('/admin') }}">
                <img src="{{ url('storage/user_profile_photos/' . Auth::user()->profile_photo) }}" alt="fav">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- User Management -->
            <li class="menu-header">User Management</li>
            <li
                class="nav-item dropdown {{ request()->routeIs('admin.users', 'admin.roles-permissions') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users-cog"></i>
                    <span>Users & Roles</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}"
                            href="{{ url('/admin/users') }}">Users</a></li>
                    <li><a class="nav-link {{ request()->is('admin/roles-permissions') ? 'active' : '' }}"
                            href="{{ url('/admin/roles-permissions') }}">Permissions <small
                                class="badge badge-danger ml-2"></small></a></li>
                </ul>
            </li>
            <!-- Blogs -->
            <li class="menu-header">Blogs</li>
            <li class="nav-item {{ request()->routeIs('blog.category.view') ? 'active' : '' }}">
                <a href="{{ route('blog.category.view') }}" class="nav-link"><i class="fas fa-blog"></i>
                    <span>Blogs Management</span>
                </a>
            </li>
            <!-- Website Pages -->
            <li class="menu-header">Website Pages</li>
            <li class="nav-item {{ request()->routeIs('view.pages') ? 'active' : '' }}">
                <a href="{{ route('view.pages') }}" class="nav-link"><i class="fas fa-file-alt"></i>
                    <span>Pages</span>
                </a>
            </li>
            <!-- Banners -->
            <li class="menu-header">Banners</li>
            <li class="nav-item {{ request()->routeIs('banners.manage') ? 'active' : '' }}">
                <a href="{{ route('banners.manage') }}" class="nav-link"><i class="fas fa-images"></i>
                    <span>Home Page Banner</span>
                </a>
            </li>
            <!-- Sliders -->
            <li class="menu-header">Sliders</li>
            <li class="nav-item {{ request()->routeIs('sliders.index') ? 'active' : '' }}">
                <a href="{{ route('sliders.index') }}" class="nav-link"><i class="fas fa-sliders-h"></i>
                    <span>Sliders</span>
                </a>
            </li>
            <!-- Tags -->
            <li class="menu-header">Tags</li>
            <li class="nav-item {{ request()->routeIs('tags.index') ? 'active' : '' }}">
                <a href="{{ route('tags.index') }}" class="nav-link"><i class="fas fa-tags"></i>
                    <span>Tags</span>
                </a>
            </li>
            <!-- FAQ's -->
            <li class="menu-header">FAQ's</li>
            <li class="nav-item {{ request()->routeIs('faqs.manage') ? 'active' : '' }}">
                <a href="{{ route('faqs.manage') }}" class="nav-link"><i class="fas fa-question-circle"></i>

                    <span>FAQ's</span>
                </a>
            </li>

            <!-- Settings -->
            <li class="menu-header">Settings</li>
            <li class="nav-item {{ request()->routeIs('all_setting') ? 'active' : '' }}">
                <a href="{{ route('all_setting') }}" class="nav-link"><i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>

        </ul>


        <div class="py-3 text-center">
            <div class="btn-sm-group-vertical version_button" role="group" aria-label="Responsive button group">
                <button class="btn btn-primary logout_btn mt-2" disabled="">Version
                    2.0.0</button>
                <button class="btn btn-danger mt-2"
                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </button>
            </div>
        </div>
    </aside>
</div>
