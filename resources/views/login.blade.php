@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="col-md-4">
        {{-- pesan register success --}}
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- pesan login salah --}}
        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

      <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal text-center text-white">Hello, Welcome back to MovieList</h1>

        <form action="/login" method="post">
          @csrf
          <div class="form-floating">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="form-floating">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
          </div>

          <div class="form-check my-3">
            <input class="form-check-input" type="checkbox" id="remember" name="remember">
            <label class="form-check-label text-white" for="remember">
              Remember Me
            </label>
          </div>

          <button class="w-100 btn btn-lg btn-danger" type="submit">
            Login <i class="bi bi-box-arrow-in-right"></i> </button>

        </form>

        <small class="d-block text-center mt-3 text-white">Don't have an account? <a href="/register">Register Now!</a></small>
      </main>

    </div>
</div>
@endsection
