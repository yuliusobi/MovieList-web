@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Movie Detail</h1>

    {{-- card buat movie --}}

    <div class="container">
        <img src="{{ $movie->thumb_img }}" class="img-fluid" alt="{{ $movie->title }}">
        <img src="{{ $movie->bg_img }}" class="img-fluid" alt="{{ $movie->title }}">

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
                {{ $actor->name }} sebagai {{ $actor->char_name }}
             @endforeach
        </p>

        <a href="/movie/{{ $movie->title }}" class="text-decoration-none btn btn-primary">Detail</a>
    </div>

    <div style="height: 1000px"></div>
@endsection
