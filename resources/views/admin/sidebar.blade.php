<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href=""><img class="admin_logo" src=""
                    alt="logo"></a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href=""><img src=""
                    alt="fav"></a>
        </div>

        <ul class="sidebar-menu">
                <li class="">
                    <a class="nav-link" href=""><i class="fas fa-home"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

<li
class="nav-item dropdown ">
<a href="#" class="nav-link has-dropdown"
data-toggle="dropdown"><i class="fas fa-shopping-bag"></i>
<span class="">{{ __('Manage Order') }} </span>

</a>
<ul class="dropdown-menu">
<li class=""><a class="nav-link"
href="">{{ __('Order History') }}</a></li>

<li class=""><a class="nav-link"
href="">{{ __('Pending Payment') }}
</a>
</li>

</ul>
</li>
            <li class="nav-item dropdown" id="addon_sidemenu">
                <a class="nav-link has-dropdown" data-toggle="dropdown" href="#"><i class="fas fa-gem"></i>
                    <span>{{ __('Manage Addons') }} </span>
                </a>
                <ul class="dropdown-menu addon_menu">
                </ul>
            </li>
        </ul>
        <div class="py-3 text-center">
            <div class="btn-sm-group-vertical version_button" role="group" aria-label="Responsive button group">
                <button class="btn btn-primary logout_btn mt-2" disabled>{{ __('version') }}
                    </button>
                <button class="btn btn-danger mt-2"
                    onclick="event.preventDefault(); $('#admin-logout-form').trigger('submit');"><i
                        class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
    </aside>
</div>
