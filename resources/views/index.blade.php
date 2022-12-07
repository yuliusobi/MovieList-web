@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Home</h1>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    <h2 class="text-white">Popular</h2>

    <div class="container">
        <div class="row">
          @foreach ($moviesPopular as $mov)
            <div class="col-md-4 mb-3">
                <div class="card">

                @if ($mov->thumb_img)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $mov->thumb_img) }}" alt="{{ $mov->title }}" class="card-img-top">
                    </div>
                @else
                    <img src="https://source.unsplash.com/400x350?movie" alt="{{ $mov->title }}" class="card-img-top">
                @endif

                <div class="card-body">
                    <h5><a href="/" class="text-decoration-none">{{ $mov->title }}</a></h5>

                    <p class="card-text">{{ $mov->released_date }}</p>

                    <a href="/movie/{{ $mov->title }}" class="text-decoration-none btn btn-primary">Detail</a>

                    @auth
                        <form action="/watchlist" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" value="{{ $mov->id }}" id="movie_id" name="movie_id">

                            <button class="badge bg-danger border-0" style="width: 30px;height:30px" onclick="return confirm('Are you sure ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                  </svg></button>
                        </form>
                    @endauth
                </div>
                </div>
            </div>

          @endforeach
        </div>
    </div>

    <h2 class="text-white">Show</h2>
    {{-- card buat movie --}}
    <div class="container">
        {{-- searching --}}
        <div class="d-flex">
            <form action="/">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Movie.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
             </form>
        </div>

        <div class="d-flex my-3">
            <h4 class="text-white mx-3"> Sort By</h4>
            <div class="btn-group">
                <a href="/?sortby=latest" class="btn btn-danger mx-2" aria-current="page">Latest</a>
                <a href="/?sortby=asc" class="btn btn-danger mx-2">A-Z</a>
                <a href="/?sortby=desc" class="btn btn-danger mx-2">Z-A</a>
              </div>
        </div>

        <div class="d-flex my-3">
            <h4 class="text-white mx-3">Genre</h4>
            @foreach ($genres as $genre)
                <a href="/?genre={{ $genre->name }}" class="btn btn-outline-danger mx-2">{{ $genre->name }}</a>
            @endforeach
        </div>

        <div class="row">
          @foreach ($movies as $movie)
            <div class="col-md-4 mb-3">
                <div class="card">

                @if ($movie->thumb_img)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $movie->thumb_img) }}" alt="{{ $movie->title }}" class="card-img-top">
                    </div>
                @else
                    <img src="https://source.unsplash.com/400x350?movie" alt="{{ $movie->title }}" class="card-img-top">
                @endif

                <div class="card-body">
                    <h5><a href="/" class="text-decoration-none">{{ $movie->title }}</a></h5>

                    <p class="card-text">{{ $movie->released_date }}</p>

                    <a href="/movie/{{ $movie->title }}" class="text-decoration-none btn btn-primary">Detail</a>

                    @auth
                        <form action="/watchlist" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" value="{{ $movie->id }}" id="movie_id" name="movie_id">

                            <button class="badge bg-danger border-0" style="width: 30px;height:30px" onclick="return confirm('Are you sure ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                  </svg></button>
                        </form>
                    @endauth
                </div>
                </div>
            </div>

          @endforeach
        </div>
    </div>
@endsection
