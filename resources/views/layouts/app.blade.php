<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@if($webSettings) {{ $webSettings->site_title }} @else {{ config('app.name', 'Laravel') }} @endif</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- App Styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('head_styles')

</head>

<body class="font-sans antialiased">
  <div id="app" class="min-h-screen bg-gray-100">
    @include('layouts.navbar')

    <main class="py-4">
      <div class="container mx-auto px-4">
        {{ $slot }}
      </div>
    </main>
  </div>

  @stack('bottom_scripts')
</body>

</html>