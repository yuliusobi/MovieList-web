@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Edit Movie | {{ $movie->title }}</h1>

    <div class="mb-5">
        <form action="/admin/movie/{{ $movie->id }}" method="POST" class="mb-3" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-white">Title</label>
                <input type="input" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    autofocus value="{{ old('title',$movie->title) }}" autocomplete="off" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label text-white">Description</label>
                <textarea type="textarea" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"
                    value="{{ old('desc') }}" required autocomplete="off" rows="3">{{ $movie->desc }}</textarea>

                @error('desc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label text-white">Genre</label>
                <br>
                @foreach ($genres as $genre)
                    <span hidden>{{ $idx = 0 }}</span>

                    @foreach ($genres_data as $check)
                        @if ($genre->id == $check->id)
                            <input type="checkbox" name="genres[]" id="genre_id" value="{{ $genre->id }}" checked> <span class="text-white"> {{ $genre->name }} </span> <br>
                            <span hidden>{{ $idx = 1 }}</span>
                        @endif
                    @endforeach

                    @if ($idx == 0)
                        <input type="checkbox" name="genres[]" id="genre_id" value="{{ $genre->id }}"> <span class="text-white"> {{ $genre->name }} </span> <br>
                    @endif

                @endforeach

            </div>

            <div class="mb-3"> --}}
                <label for="actor_list" class="form-label text-white">Actors</label>

                <div class="border border-white p-3" id="dynamicRow">

                    @foreach ($actors_data as $data)
                        <span>
                        <div class="d-flex justify-content-between row m-2">
                            {{-- pilih actor --}}
                            <div class="col">
                                <label for="actor" class="form-label text-white">Actor</label>
                                <select name="actors[]" class="form-select">
                                    @foreach ($actors as $actor)
                                        @if ($data->id == $actor->id)
                                            <option value="{{ $actor->id }}" selected>{{ $actor->name }}</option>
                                        @else
                                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- input char name --}}
                            <div class="col">
                                <label for="char_name" class="form-label text-white">Character Name</label>
                                <input type="input" class="form-control" name="char_names[]"
                                    value="{{ old('char_names[]',$data->char_name) }}" required autocomplete="off">

                                    @error('char_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                        </div>

                        <div class="mt-2 d-flex justify-content-end">
                            <button type="button" class="btn btn-danger remove-input">Remove</button>
                        </div>
                        </span>
                    @endforeach

                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" onclick="addMore()" class="btn btn-primary">Add More</button>
                </div>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label text-white">Director</label>
                <input type="input" class="form-control @error('director') is-invalid @enderror" id="director" name="director"
                    value="{{ old('director',$movie->director) }}" required autocomplete="off">
                @error('director')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="released_date" class="form-label text-white">Released Date</label>
                <input type="date" class="form-control @error('released_date') is-invalid @enderror" id="released_date" name="released_date"
                    value="{{ old('released_date',$movie->released_date) }}" required autocomplete="off">
                @error('released_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumb_img" class="form-label text-white">Thumb Image</label>

                @if ($movie->thumb_img)
                    <img src= "{{ asset('storage/' . $movie->thumb_img) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif

                <input id="thumb_img" class="form-control @error('thumb_img') is-invalid @enderror" type="file" name="thumb_img" onchange="previewImage1()">

                @error('thumb_img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bg_img" class="form-label text-white">Background Image</label>

                @if ($movie->bg_img)
                    <img src= "{{ asset('storage/' . $movie->bg_img) }}" class="img-preview1 img-fluid mb-3 col-sm-5" style="display: block;">
                @endif

                <img class="img-preview2 img-fluid mb-3 col-sm-5">

                <input id="bg_img" class="form-control @error('bg_img') is-invalid @enderror" type="file" name="bg_img" onchange="previewImage2()">

                @error('bg_img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Update Movie</button>
            <a href="/movie/{{ $movie->title }}" class="text-decoration-none mx-3 text-white">Cancel</a>
        </form>
    </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        var divRow = document.getElementById('dynamicRow');
        function addMore(){
            divRow.innerHTML += `<span><div class="d-flex justify-content-between row m-2">
                {{-- pilih actor --}}
                <div class="col">
                    <label for="actor" class="form-label text-white">Actor</label>
                    <select name="actors[]" class="form-select">
                         @foreach ($actors as $actor)
                            <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- input char name --}}
                <div class="col">
                <label for="char_name" class="form-label text-white">Character Name</label>
                <input type="input" class="form-control "  name="char_names[]"
                    value="{{ old('char_name') }}" required autocomplete="off">
                     @error('char_name')
                        <div class="invalid-feedback">
                        {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-2 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger remove-input">Remove</button>
                </div>

            </div></span>`;
        }

        $(document).on('click', '.remove-input', function () {
            $(this).parents('span').remove();
        });

        function previewImage1(){
            const image = document.querySelector('#thumb_img');
            const imgPreview = document.querySelector('.img-preview1');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImage2(){
            const image = document.querySelector('#bg_img');
            const imgPreview1 = document.querySelector('.img-preview1');
            const imgPreview2 = document.querySelector('.img-preview2');

            imgPreview1.style.display = 'none';
            imgPreview2.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview2.src = oFREvent.target.result;
            }
        }

    </script>
@endsection
