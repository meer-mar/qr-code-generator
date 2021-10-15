<x-app-layout>
  <x-auth-card>
    <x-slot name="header">
      {{ __('Login') }}
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="alert-success" :status="session('status')" />

    <!-- Validation Errors -->
    {{--
    <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div class="form-group row">
        <x-label for="email" :value="__('Email Address')" />

        <div class="col-md-6">

          @error('email')
          <x-input id="email" class="is-invalid" type="email" name="email" :value="old('email')" required autofocus />

          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @else
          <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
          @enderror
        </div>
      </div>

      <!-- Password -->
      <div class="form-group row">
        <x-label for="password" :value="__('Password')" />

        <div class="col-md-6">
          <x-input id="password" type="password" name="password" required autocomplete="current-password" />

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <!-- Remember Me -->
      <div class="form-group row">
        <div class="col-md-6 offset-md-4">
          <div class="form-check">

            <input id="remember_me" type="checkbox" class="form-check-input" name="remember" {{ old('remember')
              ? 'checked' : '' }}>

            <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
          </div>
        </div>
      </div>

      <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
          <x-button class="btn-primary">
            {{ __('Log in') }}
          </x-button>

          @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
          @endif
        </div>
      </div>
    </form>
  </x-auth-card>
</x-app-layout>