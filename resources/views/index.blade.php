@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Home</h1>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    {{-- card buat movie --}}
    <div class="container">
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

    <div style="height: 1000px"></div>
@endsection
