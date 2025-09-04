<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mode" content="{{ env('PROJECT_MODE') ?? 'LIVE' }}">
    <!-- Custom Meta -->
    @yield('custom_meta')

    @yield('title')
    <link rel="icon" href="">
    @include('admin.partials.styles')
    @stack('css')
    @yield('vite')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('dashboard.admin.includes.header')
            @include('dashboard.admin.includes.sidebar')
            @yield('admin-content')
            @include('dashboard.admin.includes.footer')


        </div>
    </div>

    {{-- start admin logout form --}}
    <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    {{-- end admin logout form --}}
    @include('admin.partials.modal')
    @include('admin.partials.javascripts')
    @include('global.dynamic-js-variables')
    @stack('js')
</body>

</html>
