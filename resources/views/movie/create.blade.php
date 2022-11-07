@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Create/Add Movie</h1>

    <div class="mb-5">
        <form action="/admin/movie" method="POST" class="mb-3" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-white">Title</label>
                <input type="input" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    autofocus value="{{ old('title') }}" autocomplete="off" required>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label text-white">Description</label>
                <textarea type="textarea" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc"
                    value="{{ old('desc') }}" required autocomplete="off" rows="3"></textarea>
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
                    <input type="checkbox" name="genres[]" id="genre_id" value="{{ $genre->id }}"> <span class="text-white"> {{ $genre->name }} </span> <br>
                @endforeach

            </div>


            <div class="mb-3">
                <label for="actor_list" class="form-label text-white">Actors</label>

                <div class="border border-white p-3" id="dynamicRow">
                    {{-- row actor 1 --}}
                    <div class="d-flex justify-content-between row m-2">
                        {{-- pilih actor --}}
                        <div class="col">
                            <label for="actor" class="form-label text-white">Actor</label>
                            <select name="actors[]" class="form-select">
                                <option>-------Open This Select Menu----------</option>
                                @foreach ($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- input char name --}}
                        <div class="col">
                            <label for="char_name" class="form-label text-white">Character Name</label>
                            <input type="input" class="form-control" name="char_names[]"
                                value="{{ old('char_names[]') }}" required autocomplete="off">
                                @error('char_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" onclick="addMore()" class="btn btn-primary">Add More</button>
                </div>
            </div>

            <div class="mb-3">
                <label for="director" class="form-label text-white">Director</label>
                <input type="input" class="form-control @error('director') is-invalid @enderror" id="director" name="director"
                    value="{{ old('director') }}" required autocomplete="off">
                @error('director')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="released_date" class="form-label text-white">Released Date</label>
                <input type="date" class="form-control @error('released_date') is-invalid @enderror" id="released_date" name="released_date"
                    value="{{ old('released_date') }}" required autocomplete="off">
                @error('released_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="thumb_img" class="form-label text-white">Thumb Image</label>
                <img class="img-preview1 img-fluid mb-3 col-sm-5">
                <input id="thumb_img" class="form-control @error('thumb_img') is-invalid @enderror" type="file" name="thumb_img" onchange="previewImage1()">

                @error('thumb_img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bg_img" class="form-label text-white">Background Image</label>
                <img class="img-preview2 img-fluid mb-3 col-sm-5">
                <input id="bg_img" class="form-control @error('bg_img') is-invalid @enderror" type="file" name="bg_img" onchange="previewImage2()">

                @error('bg_img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Create Movie</button>
            <a href="/movies" class="text-decoration-none mx-3 text-white">Cancel</a>
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
            const imgPreview = document.querySelector('.img-preview2');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endsection
