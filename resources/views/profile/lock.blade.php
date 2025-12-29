@extends('layouts.guest')

@section('title', 'Lock Screen')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-6 col-md-8">
        <div class="card overflow-hidden mt-5 border-0 shadow-lg">
            <div class="card-body p-5 text-center">

                <!-- User Photo & Name -->
                <div class="mb-4">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                         alt="User" class="avatar-xl rounded-circle border border-3 border-primary">
                    <h5 class="mt-3 fw-semibold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted">Enter your password to unlock</p>
                </div>

                <!-- Error Message -->
                @if ($errors->has('password'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first('password') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Unlock Form -->
                <form method="POST" action="{{ route('lock.unlock') }}">
                    @csrf

                    <div class="mb-4">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter your password" required autofocus>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="ri-eye-line"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Unlock
                        </button>
                    </div>
                </form>

                <!-- Back to Login -->
                <div class="mt-4">
                    <a href="{{ route('logout') }}" class="text-muted small"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Sign in with different account
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Toggle Script -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const password = document.querySelector('input[name="password"]');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('ri-eye-line');
        this.querySelector('i').classList.toggle('ri-eye-off-line');
    });
</script>
@endsection