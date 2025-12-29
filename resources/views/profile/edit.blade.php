@extends('layouts.master')

@section('title', 'My Profile')

@section('content')
<div class="row">
    <div class="col-xxl-8 mx-auto">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">My Profile</h5>
            </div>
            <div class="card-body p-5">

                <!-- Success Message -->
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Profile updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="row g-4">

                        <!-- Profile Photo -->
                        <div class="col-12 text-center mb-4">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                 alt="Profile Photo" class="avatar-lg rounded-circle border border-3 border-primary">
                            <p class="mt-2 text-muted">Profile Photo</p>
                            <!-- You can add photo upload later -->
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Password (for security when changing email/password) -->
                        <div class="col-12">
                            <label for="current_password" class="form-label">Current Password (required for changes)</label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- New Password (optional) -->
                        <div class="col-md-6">
                            <label for="password" class="form-label">New Password (leave blank if not changing)</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control">
                        </div>

                    </div>

                    <div class="mt-5 d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Update Profile
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-lg px-5">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection