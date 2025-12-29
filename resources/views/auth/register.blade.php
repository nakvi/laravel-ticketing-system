@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-5 col-lg-6 col-md-8">
        <div class="card mt-2 border-0 shadow-lg">
            <div class="card-body p-5">
                <div class="text-center mb-1">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('build/images/iconn.png') }}" alt="Logo"height="100" width="50%">
                    </a>
                    <h4 class="mt-3 fw-semibold">Create your account</h4>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="ri-eye-line"></i>
                            </button>
                            @error('password')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" class="form-control" 
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Sign Up
                        </button>
                    </div>

                    <!-- Terms & Privacy -->
                    <div class="mt-4 text-center">
                        <p class="text-muted small">
                            By registering you agree to the 
                            <a href="{{ route('terms') }}" class="text-primary">Terms of Service</a> and 
                            <a href="{{ route('privacy') }}" class="text-primary">Privacy Policy</a>
                        </p>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="mt-4 text-center">
                    <p class="text-muted">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="fw-semibold text-primary">Sign in</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-4 text-center text-muted">
            © {{ date('Y') }} Nakvi. Crafted with <i class="ri-heart-fill text-danger">Codion</i>
        </div>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle eye icon
        this.querySelector('i').classList.toggle('ri-eye-line');
        this.querySelector('i').classList.toggle('ri-eye-off-line');
    });
</script>
@endsection