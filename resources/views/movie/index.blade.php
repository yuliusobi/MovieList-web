@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman List Movies</h1>


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

                        @can('admin')
                            <a href="/admin/movie" class="text-decoration-none btn btn-danger">Add Movie</a>
                        @endcan

                    </div>
                    </div>
                </div>

              @endforeach
            </div>
        </div>

@endsection
