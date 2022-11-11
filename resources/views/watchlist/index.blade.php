@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 text-white">My Watchlist</h1>
    </div>

    @if (session()->has('success'))
        <div class="col-lg-8 alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive col-lg-8">

        <table class="table table-striped table-sm">
            <thead>
                <tr class="text-white">
                    <th scope="col">Poster</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $list)
                    <tr class="text-white">
                        <td>
                            <div style="">
                                <img src="{{ asset('storage/' . $list->thumb_img) }}" alt="{{ $list->title }}" class="img-fluid">
                            </div>
                        </td>
                        <td>{{ $list->title }}</td>

                        <td>{{ $list->status }}</td>

                        <td>
                            {{-- tombol edit --}}
                            <a href="#" class="badge bg-warning">
                                <i class="bi bi-pencil-square"></i></span></a>

                            <form action="/watchlist/{{ $list->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')">
                                    <i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
