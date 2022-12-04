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

    {{-- sorting + searching --}}
    <div class="d-flex justify-content-between">
        <div class="col-2 d-flex">
            {{-- <label for="sorting"> <i class="bi bi-funnel-fill text-white my-auto me-3" style="font-size: 2rem;"></i>
            Sort</label>
            {{-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Sort by watchlist
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/watchlist?status=all">All</a></li>
                  <li><a class="dropdown-item" href="/watchlist?status=planned">Planned</a></li>
                  <li><a class="dropdown-item" href="/watchlist?status=watching">Watching</a></li>
                  <li><a class="dropdown-item" href="/watchlist?status=finished">Finished</a></li>
                </ul>
            </div> --}}

            <label for="sorting"> <i class="bi bi-funnel-fill text-white my-auto me-3" style="font-size: 2rem;"></i></label>
            <form action="/watchlist" method="get" class="my-auto">
                <select name="status" id="sorting" class="form-select" onchange="this.form.submit()">
                    @if ($status == 'Planned')
                        <option value="All">All</option>
                        <option value="Planned" selected>Planned</option>
                        <option value="Watching">Watching</option>
                        <option value="Finished">Finished</option>

                    @elseif ($status == 'Watching')
                        <option value="All">All</option>
                        <option value="Planned" >Planned</option>
                        <option value="Watching" selected>Watching</option>
                        <option value="Finished">Finished</option>

                    @elseif ($status == 'Finished')
                        <option value="All">All</option>
                        <option value="Planned" >Planned</option>
                        <option value="Watching">Watching</option>
                        <option value="Finished" selected>Finished</option>

                    @else
                        <option value="All" selected>All</option>
                        <option value="Planned" >Planned</option>
                        <option value="Watching">Watching</option>
                        <option value="Finished">Finished</option>
                    @endif
                </select>
            </form>
        </div>

        <div class="col-md-4">
          <form action="/watchlist">

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search by title.." name="search" value="{{ request('search') }}">
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </form>
        </div>
    </div>

    <div class="table-responsive">

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
                @if ($lists->count())
                @foreach ($lists as $list)
                    <tr class="text-white">
                        <td>
                            <div style="">
                                <img src="{{ asset('storage/' . $list->movie->thumb_img) }}" alt="{{ $list->movie->title }}" class="img-fluid">
                            </div>
                        </td>
                        <td>{{ $list->movie->title }}</td>

                        @if ($list->status == 'Planned')
                            <td style="color: red !important;">{{ $list->status }}</td>
                        @elseif ($list->status == 'Watching')
                            <td style="color: lightblue !important;">{{ $list->status }}</td>
                        @elseif ($list->status == 'Finished')
                            <td style="color: lightgreen !important;">{{ $list->status }}</td>
                        @endif

                        <td>
                            {{-- tombol edit --}}
                            <button type="button" class="btn btn-warning py-0 px-1 editStatus" data-bs-toggle="modal" data-bs-target="#changeStatus"
                            data-id="{{ $list->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form action="/watchlist/{{ $list->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure ?')">
                                    <i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr class="text-white text-center fs-4">
                        <td colspan="4">
                            No Movie Found
                        </td>
                    </tr>
                    @endif

                </tbody>


            </table>
        </div>

        <div class="modal" tabindex="-1" id="changeStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Change Status</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <select name="status" class="form-select">
                            <option value="default">-------Open This Select Menu----------</option>
                            <option value="Planned">Planned</option>
                            <option value="Watching">Watching</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
              </div>
            </div>
        </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

@endsection
