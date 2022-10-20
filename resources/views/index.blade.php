@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Home</h1>

    {{-- card buat movie --}}

    <div class="container">
        <div class="row">
          @foreach ($movies as $movie)
            <div class="col-md-4 mb-3">
                <div class="card">


                <img src="{{ $movie->thumb_img }}" class="card-img-top" alt="{{ $movie->title }}">

                <div class="card-body">
                    <h5><a href="/" class="text-decoration-none">{{ $movie->title }}</a></h5>

                    <p class="card-text">{{ $movie->released_date }}</p>

                    <a href="/movie/{{ $movie->title }}" class="text-decoration-none btn btn-primary">Detail</a>

                </div>
                </div>
            </div>

          @endforeach
        </div>
    </div>

    <div style="height: 1000px"></div>
@endsection
