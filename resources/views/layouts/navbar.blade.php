<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">MovieList</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "home") ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "movies") ? 'active' : '' }}" href="/movies">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ ($active === "actors") ? 'active' : '' }}" href="/actors">Actors</a>
                </li>
                {{-- @can('auth')
                    <li class="nav-item">
                        <a class="nav-link" href="">My Watchlist</a>
                    </li>
                @endcan --}}
            </ul>

        </div>


        <ul class="navbar-nav ms-auto">
            @auth
            {{--  kalo udah login tampilin dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="/img/obi.jpg" alt="Foto-profile" class="rounded-circle" style="width: 50px; height: 50px">
                  {{-- <i class="bi bi-person-circle"> --}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/"><i class="bi bi-person-circle"></i> Profile</a></li>

                  <li><hr class="dropdown-divider"></li>

                  <li>
                      <form action="/logout" method="post">
                            @csrf
                          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                      </form>
                  </li>

                </ul>
              </li>
            @else
                {{--  kalo blm login tampilin tombol login v --}}
                <li class="nav-item">
                    <a href="/register" class="nav-link">
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Register</button>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/login" class="nav-link">
                    <button type="button" class="btn btn-outline-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Login</button>
                    </a>
                </li>
            @endauth
        </ul>

    </div>
  </nav>
