<nav class="navbar navbar-expand-lg bg-slate-500">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">{{config('app.name')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-white"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        @auth
        <li class="nav-item visible">
          <a class="nav-link active text-white" aria-current="page" href="{{route('todos.index')}}">Home</a>
        </li>
        <li class="nav-item visible">
          <a class="nav-link text-white" href="{{route('logout')}}">Logout</a>
        </li>
        @else
        <li class="nav-item visible">
          <a class="nav-link text-white" href="{{route('login')}}">Login</a>
        </li>
        <li class="nav-item visible">
          <a class="nav-link text-white" href="{{route('registration')}}">Registration</a>
        </li>

        @endauth
      </ul>
      <span class="navbar-text">
        @auth
          <span class="text-white visible mr-9">{{auth()->user()->name}}</span>
        @endauth
      </span>
    </div>
  </div>
</nav>
