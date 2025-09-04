<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | FunNewJersey</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('backend/login_custom.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon.png') }}">

</head>

<body>
        @php
            $setting = App\Models\WebSetting::first();
        @endphp
    <div class="login-box">
        <div class="login-logo">
               <img src="{{ asset('/storage/settings/' . $setting->logo) }}" alt="{{$setting->site_title}}">
        </div>

        {{-- <div class="login-title">FunNew<span>Jersey</span></div> --}}
        <div class="login-subtitle">Sign in to start your session</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    {{-- Name --}}
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user" style="color:#365264;"></i>
            </span>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Name"
                   required
                   autofocus
                   autocomplete="name">
        </div>
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope" style="color:#365264;"></i>
            </span>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email"
                   required
                   autocomplete="username">
        </div>
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock" style="color:#365264;"></i>
            </span>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password"
                   required
                   autocomplete="new-password">
        </div>
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="mb-3">
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock" style="color:#365264;"></i>
            </span>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   placeholder="Confirm Password"
                   required
                   autocomplete="new-password">
        </div>
    </div>

    {{-- Submit + Already Registered --}}
    <div class="d-grid mb-2">
        <button type="submit" class="btn customNomi"
            style="color:white; font-weight:700; background-color:#365264;">
            Register
        </button>
    </div>

</form>




        <div class="extra-links mt-3">
            <div><a href="{{ route('password.request') }}" style="color:#365264;font-weight:700;">Forgot your
                    password?</a></div>
            <div><a href="{{ route('login') }}" style="color:#365264;font-weight:700;">Already registered?</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
