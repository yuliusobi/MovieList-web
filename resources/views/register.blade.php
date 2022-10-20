@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
  <div class="col-lg-5">
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center text-white">Hello, Welcome back to MovieList</h1>

      <form action="/register" method="post">
        {{-- untuk prevent attack pake @csrf--}}
        @csrf

        <div class="form-floating">
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}" autofocus>
          <label for="username">Username</label>
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
          <label for="password">Password</label>
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div class="form-floating">
            <input type="password" name="password_confirmation" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Enter Your Confirm Password" required>
            <label for="password">Confirm Password</label>
            @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Register</button>

        </form>
      <small class="d-block text-center mt-3 text-white">Already have an account? <a href="/login">Login Now!</a></small>
    </main>
  </div>
</div>

@endsection
