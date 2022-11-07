@extends('layouts.main')

@section('container')
    <h1 class="text-white">Halaman Edit Actor | {{ $actor->name }}</h1>

    <div class="mb-5">
        <form action="/detail/actors/{{ $actor->id }}" method="POST" class="mb-3" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="input" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus value="{{ old('name',$actor->name) }}" autocomplete="off" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label text-white">Gender</label>
                <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                    <option>-------Open This Select Menu----------</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="bio" class="form-label text-white">Biography</label>
                <textarea type="textarea" class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio"
                    value="{{ old('bio',$actor->bio) }}" required autocomplete="off" rows="4"></textarea>
                @error('bio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="dob" class="form-label text-white">Date of Birth</label>
                <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob"
                value="{{ old('dob',$actor->dob) }}" required autocomplete="off">
                @error('dob')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="place_of_birth" class="form-label text-white">Place of Birth</label>
                <input type="input" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" name="place_of_birth"
                    value="{{ old('place_of_birth',$actor->place_of_birth) }}" required autocomplete="off">
                @error('place_of_birth')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="popularity" class="form-label text-white">Populatiry</label>
                <input type="number" class="form-control @error('popularity') is-invalid @enderror" id="popularity" name="popularity"
                    value="{{ old('popularity',$actor->popularity) }}" required autocomplete="off">
                @error('popularity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="img" class="form-label text-white">Image</label>

                @if ($actor->img)
                    <img src= "{{ asset('storage/' . $actor->img) }}" class="img-preview1 img-fluid mb-3 col-sm-5" style="display: block;">
                @endif

                <img class="img-preview2 img-fluid mb-3 col-sm-5">

                <input id="img" class="form-control @error('img') is-invalid @enderror" type="file" name="img" onchange="previewImage()">

                @error('img')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit Actor</button>
            <a href="/detail/actors/{{ $actor->id }}" class="text-decoration-none mx-3 text-white">Cancel</a>
        </form>
    </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        function previewImage(){
            const image = document.querySelector('#img');
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
