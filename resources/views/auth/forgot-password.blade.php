<x-app-layout>
    <x-auth-card>
        <x-slot name="header">
            {{ __('Reset Password') }}
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="alert-success" :status="session('status')" />

        <!-- Validation Errors -->
        {{--
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group row">
                <x-label for="email" :value="__('Email')" />

                <div class="col-md-6">
                    @error('email')
                    <x-input id="email" class="is-invalid" type="email" name="email" :value="old('email')" required
                        autofocus />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @else
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <x-button class="btn-primary">
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>