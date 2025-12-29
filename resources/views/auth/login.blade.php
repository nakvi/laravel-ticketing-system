<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')   <!-- ← YOUR nice template -->

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card mt-5">
            <div class="card-header text-center">
                <a href="{{ url('/') }}">
                        <img src="{{ asset('build/images/iconn.png') }}" alt="Logo" height="100" width="50%">
                    </a>
                <h4>Sign In</h4>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary ">Sign In</button>
                    </div>
                </form>

                {{-- <div class="mt-4 text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-muted">Forgot your password?</a>
                    @endif
                </div> --}}

                <div class="mt-3 text-center">
                    Don't have an account? <a href="{{ route('register') }}" class="fw-semibold text-primary">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection