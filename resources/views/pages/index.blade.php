<x-app-layout>
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">{{$title}}</h1>
      <p>Welcome to my first project</p>
      <p>
        <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
        <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
      </p>
    </div>
  </div>
</x-app-layout>