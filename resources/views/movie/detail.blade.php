@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Movie Detail</h1>


    <a href="/admin/movie/{{ $movie->id }}/edit" class="text-decoration-none btn btn-danger">Edit Movie</a>

    <form action="/admin/movie/{{ $movie->id }}" method="POST" class="d-inline">
        @method('delete')
        @csrf
        <button class="badge bg-danger border-0" style="width: 30px;height:30px" onclick="return confirm('Are you sure ?')">
            <i class="bi bi-trash"></i></button>
    </form>

    {{-- card buat movie --}}
    <div class="container">
        <h4 class="text-white">Thumb image</h4>
        @if ($movie->thumb_img)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $movie->thumb_img) }}" alt="{{ $movie->title }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/400x350?movie" alt="{{ $movie->title }}" class="img-fluid">
        @endif

        <h4 class="text-white">Background image</h4>
        @if ($movie->bg_img)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $movie->bg_img) }}" alt="{{ $movie->title }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/400x350?background" alt="{{ $movie->title }}" class="img-fluid">
        @endif

        <h5><a href="/" class="text-decoration-none">{{ $movie->title }}</a></h5>

        <p class="card-text text-white">{{ $movie->released_date }}</p>

        <h4 class="text-white">Genre Movie</h4>
        <p class="card-text text-white">
            @foreach ($genres as $genre)
            {{ $genre->name }} |
             @endforeach
        </p>

        <h4 class="text-white">Actors</h4>
        <p class="card-text text-white">
            @foreach ($actors as $actor)
                <img src="https://source.unsplash.com/100x200?person" class="img-fluid" alt="{{ $actor->name  }}">
                <a href="/">{{ $actor->name }} </a>
                <a href="/"> {{ $actor->char_name }} </a>
                <br><br>
             @endforeach
        </p>
    </div>

    <div style="height: 1000px"></div>
@endsection
