<x-app-layout>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Dashboard') }}</div>

          <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="alert-success" :status="session('status')" />

            {{ __('You are logged in!') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>