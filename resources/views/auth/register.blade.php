<x-app-layout>
    <x-auth-card>
        <x-slot name="header">
            {{ __('Register') }}
        </x-slot>

        <!-- Validation Errors -->
        {{--
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group row">
                <x-label for="name" :value="__('Name')" />

                <div class="col-md-6">
                    @error('name')
                    <x-input id="name" class="is-invalid" type="text" name="name" :value="old('name')" required
                        autofocus />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @else
                    <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                    @enderror
                </div>
            </div>

            <!-- Email Address -->
            <div class="form-group row">
                <x-label for="email" :value="__('Email')" />

                <div class="col-md-6">
                    @error('email')
                    <x-input id="email" class="is-invalid" type="email" name="email" :value="old('email')" required />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @else
                    <x-input id="email" type="email" name="email" :value="old('email')" required />
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="form-group row">
                <x-label for="password" :value="__('Password')" />

                <div class="col-md-6">
                    @error('password')
                    <x-input id="password" class="is-invalid" type="password" name="password" required
                        autocomplete="new-password" />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @else
                    <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                    @enderror
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group row">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <div class="col-md-6">
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <x-button class="btn-primary">
                        {{ __('Register') }}
                    </x-button>

                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>