@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman List Movies</h1>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif

        <div class="d-flex justify-content-end">
            {{-- searching --}}
            <div class="my-auto mx-2">
                <form action="/movies">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Movie Name.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                  </div>
                </form>
            </div>
            @can('admin')
            <div class="my-auto">
                <a href="/admin/movie" class="text-decoration-none btn btn-danger my-4 mx-2">Add Movie</a>
            </div>
            @endcan

        </div>

        {{-- card buat movie --}}
        <div class="container">
            <div class="row">
            @if ($movies->count())
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

                    </div>
                    </div>
                </div>

                @endforeach
            @else
                <p class="text-center fs-4 text-white">No movie found.</p>
            @endif
            </div>

            {{ $movies->links() }}
        </div>

@endsection
