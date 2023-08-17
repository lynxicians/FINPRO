<nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand text-white fw-bold fs-5" href="#">Campus Voice</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="{{ route('homepage') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('about') }}">About</a>
          </li>
          @auth
            @if(auth()->user()->role_id == 1)
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('suggestion.SuggestionManagementSystem') }}">Suggestion</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.index') }}">Admin Management</a>
              </li>
            @endif
          @endauth
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            @guest
            <a class="nav-link text-white fw-bold fs-5" href="{{ route('login') }}">Login</a>
            @endguest
            @auth
            <a class="nav-link text-white fw-bold fs-5" href="{{ route('logout') }}">Logout</a>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>
  