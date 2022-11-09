@extends('layouts.main')

@section('container')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="text-white text-center mb-4">Update Profile</h1>

    <div class="container text-white mx-auto px-5">
        <div class="row px-5">
            <div class="col-4">
                <h2>My Profile</h2>
                @if ($user->profile_img)
                    <img src="{{ asset('storage/' . $user->profile_img) }}" alt="{{ $user->username }}" width="250px" height="250px" class="rounded-circle">
                @else
                    <i class="bi bi-person-circle" style="font-size: 4rem; color: cornflowerblue;"></i>
                @endif
                <h4>{{ $user->username }}</h4>
                <h4>{{ $user->email }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('profile.update') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-2">
                            <label for="username" class="col-form-label">Username</label>
                        </div>
                        <div class="col-8">
                        <input type="input" id="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        autofocus value="{{ old('username',$user->username) }}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-2">
                        <label for="email" class="col-form-label">Email</label>
                        </div>
                        <div class="col-8">
                        <input type="input" id="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        autofocus value="{{ old('email',$user->email) }}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-2">
                        <label for="dob" class="col-form-label">DOB</label>
                        </div>
                        <div class="col-8">
                        <input type="date" id="dob" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob"
                        autofocus value="{{ old('dob',$user->dob) }}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            @error('dob')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-2">
                        <label for="phone" class="col-form-label">Phone</label>
                        </div>
                        <div class="col-8">
                        <input type="input" id="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                        autofocus value="{{ old('phone',$user->phone) }}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="profile_img" class="form-label text-white">Image</label>

                        <img class="img-preview img-fluid mb-3 col-sm-5 rounded">

                        <input id="profile_img" class="form-control @error('profile_img') is-invalid @enderror" type="file" name="profile_img" onchange="previewImage()">

                        @error('profile_img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger">Save Changes</button>

                </form>

            </div>
        </div>
    </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        function previewImage(){
            const image = document.querySelector('#profile_img');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endsection
