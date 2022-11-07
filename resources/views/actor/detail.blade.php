@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Actor Detail</h1>

    @can('admin')
    <a href="/detail/actors/{{ $actor->id }}/edit" class="text-decoration-none btn btn-danger">
        <i class="bi bi-pencil-square"></i></a>

    <form action="/detail/actors/{{ $actor->id }}" method="POST" class="d-inline">
        @method('delete')
        @csrf
        <button class="badge bg-danger border-0" style="width: 30px;height:30px" onclick="return confirm('Are you sure ?')">
            <i class="bi bi-trash"></i></button>
    </form>
    @endcan

    {{-- card buat actor --}}
    <div class="container">
        <h4 class="text-white">Actor image</h4>
        @if ($actor->img)
            <div style="max-height: 350px; overflow:hidden">
                <img src="{{ asset('storage/' . $actor->img) }}" alt="{{ $actor->name }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/400x350?movie" alt="{{ $actor->name }}" class="img-fluid">
        @endif

        <h2 class="text-white">Personal Info</h2>

        <h2 class="text-white">Name</h2>
        <h5 class="text-white">{{ $actor->name }}</h5>

        <h2 class="text-white">gender</h2>
        <h5 class="text-white">{{ $actor->gender }}</h5>

        <h2 class="text-white">popularity</h2>
        <h5 class="text-white">{{ $actor->popularity }}</h5>

        <h2 class="text-white">Biography</h2>
        <h5 class="text-white">{{ $actor->bio }}</h5>

        <h2 class="text-white">Birthday</h2>
        <h5 class="text-white">{{ $actor->dob }}</h5>

        <h2 class="text-white">Known For</h2>
        {{-- card buat movie --}}
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
                    </div>
                    </div>
                </div>

            @endforeach

    </div>

@endsection
