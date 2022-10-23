@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Movie Detail</h1>

    {{-- card buat movie --}}

    <div class="container">

        @if ($movie->thumb_img)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $movie->thumb_img) }}" alt="{{ $movie->title }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/400x350?movie" alt="{{ $movie->title }}" class="img-fluid">
        @endif

        @if ($movie->bg_img)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $movie->bg_img) }}" alt="{{ $movie->title }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/400x350?background" alt="{{ $movie->title }}" class="img-fluid">
        @endif

        <h5><a href="/" class="text-decoration-none">{{ $movie->title }}</a></h5>

        <p class="card-text">{{ $movie->released_date }}</p>
        <p class="card-text text-white">
            @foreach ($genres as $genre)
            {{ $genre->name }} |
             @endforeach
        </p>

        <p class="card-text text-white">
            @foreach ($actors as $actor)
                <img src="https://source.unsplash.com/100x200?person" class="img-fluid" alt="{{ $actor->name  }}">
                <a href="/">{{ $actor->name }} </a>
                <a href="/"> {{ $actor->char_name }} </a>
                <br><br>
             @endforeach
        </p>

        <a href="/movie/{{ $movie->title }}" class="text-decoration-none btn btn-primary">Detail</a>

        <a href="/" class="text-decoration-none btn btn-danger">Edit Movie</a>
        <a href="/" class="text-decoration-none btn btn-danger">Delete Movie</a>
    </div>

    <div style="height: 1000px"></div>
@endsection
