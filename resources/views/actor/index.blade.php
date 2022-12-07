@extends('layouts.main')

@section('container')
    <h1 class="text-white">Actor List</h1>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        {{-- card buat actor --}}
        <div class="container">
            {{-- searching --}}
            <div class="d-flex justify-content-center">
                <form action="/actors">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search Actor.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                  </div>
                </form>
            </div>

            @can('admin')
            <div class="d-flex justify-content-end m-3">
                <a href="/detail/actors" class="text-decoration-none btn btn-danger">Add Actor</a>
            </div>
            @endcan

            @if ($actors->count())
                <div class="row">
                @foreach ($actors as $actor)
                    <div class="col-3 mb-3">

                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $actor->img) }}" alt="{{ $actor->name }}" class="card-img-top" style="max-height: 450px; width:100%;">
                            <div class="card-body">
                                <h4><a href="/" class="text-decoration-none">{{ $actor->name }}</a></h4>

                                <h5>{{ DB::table('movie_actors')
                                    ->join('movies','movies.id','=','movie_actors.movie_id')
                                    ->join('actors','actors.id','=','movie_actors.actor_id')
                                    ->where(['actor_id' => $actor->id])
                                    ->pluck('movies.title')->implode(' | '); }}</h5>


                            </div>
                            <div class="card-footer">
                                <a href="/detail/actors/{{ $actor->name }}" class="text-decoration-none btn btn-danger">Detail</a>
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>

            @else
                <p class="text-center fs-4 text-white">No actor found.</p>
            @endif
        </div>

    {{-- paginator --}}
    <div class="d-flex justify-content-center">
        {{ $actors->links() }}
    </div>

@endsection
