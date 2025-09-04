<x-app-layout>
    <x-auth-card>
        <x-slot name="header">
            {{ __('Reset Password') }}
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 font-medium text-sm text-green-600" :status="session('status')" />

        <!-- Validation Errors -->
        {{--
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />
                <div class="mt-1">
                    @error('email')
                    <x-input id="email" class="border-red-300 focus:border-red-500 focus:ring-red-500" type="email" name="email" :value="old('email')" required autofocus />
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @else
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-center">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>