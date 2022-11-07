@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman List Actor</h1>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        {{-- card buat actor --}}
        <div class="container">
            @can('admin')
                <a href="/detail/actors" class="text-decoration-none btn btn-danger">Add Actor</a>
            @endcan

            <div class="row">
              @foreach ($actors as $actor)
                <div class="col-md-4 mb-3">
                    <div class="card">

                    @if ($actor->img)
                        <div style="max-height: 450px; overflow:hidden; max-width:300px">
                            <img src="{{ asset('storage/' . $actor->img) }}" alt="{{ $actor->name }}" class="card-img-top">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/400x400?person" style="max-height: 300px; overflow:hidden" alt="{{ $actor->name }}" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h4><a href="/" class="text-decoration-none">{{ $actor->name }}</a></h4>

                        <h5>{{ DB::table('movie_actors')
                            ->join('movies','movies.id','=','movie_actors.movie_id')
                            ->join('actors','actors.id','=','movie_actors.actor_id')
                            ->where(['actor_id' => $actor->id])
                            ->pluck('movies.title')->implode(' | '); }}</h5>

                        <a href="/detail/actors/{{ $actor->id }}" class="text-decoration-none btn btn-primary">Detail</a>

                    </div>
                    </div>
                </div>

              @endforeach
            </div>
        </div>

@endsection
