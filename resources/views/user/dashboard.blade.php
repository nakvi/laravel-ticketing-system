@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>
            <div>
                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm">Create New Ticket</a>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <!-- Total Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-primary-subtle text-primary rounded-3 fs-3">
                            <i class="ri-ticket-2-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">Total Tickets</p>
                        <h4 class="mb-0">{{ $totalTickets }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-warning-subtle text-warning rounded-3 fs-3">
                            <i class="ri-time-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">Pending Tickets</p>
                        <h4 class="mb-0">{{ $pending }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-info-subtle text-info rounded-3 fs-3">
                            <i class="ri-checkbox-circle-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">Open</p>
                        <h4 class="mb-0">{{ $open }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- In Progress Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-primary-subtle text-primary rounded-3 fs-3">
                            <i class="ri-loader-2-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">In Progress</p>
                        <h4 class="mb-0">{{ $inProgress }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Resolved Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-success-subtle text-success rounded-3 fs-3">
                            <i class="ri-check-double-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">Resolved</p>
                        <h4 class="mb-0">{{ $resolved }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Closed Tickets Card -->
    <div class="col-xxl-3 col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 avatar-sm">
                        <span class="avatar-title bg-danger-subtle text-danger rounded-3 fs-3">
                            <i class="ri-close-circle-line"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-uppercase fw-medium text-muted mb-1">Closed</p>
                        <h4 class="mb-0">{{ $closed }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Optional: Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary">New Ticket</a>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">View All Tickets</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-animate {
        transition: all 0.3s ease;
    }
    .card-animate:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
</style>
@endsection