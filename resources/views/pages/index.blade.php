<x-app-layout>
    <div class="bg-white dark:bg-gray-900">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white mb-6">
                    Welcome to Laravel 12 🚀
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                    This is your new Laravel 12 project. Build something amazing!
                </p>

                <div class="space-x-4">
                    <a href="https://laravel.com/docs" class="btn btn-primary">Documentation</a>
                    <a href="https://laracasts.com" class="btn btn-secondary">Laracasts</a>
                    <a href="https://laravel-news.com" class="btn btn-success">News</a>
                    <a href="https://github.com/laravel/laravel" class="btn btn-dark">GitHub</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
