@extends('layouts.master')

@section('title', 'My Assigned Tickets')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">My Assigned Tickets ({{ $tickets->total() }})</h4>
            <a href="{{ route('agent.dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="ri-arrow-left-line"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Customer</th>
                        <th>Category</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Images</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="table-secondary opacity-75">
                            <td>#{{ $ticket->id }}</td>
                            <td>
                                <a href="{{ route('agent.tickets.show', $ticket) }}" class="fw-medium">
                                    {{ Str::limit($ticket->title, 50) }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $ticket->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                         class="avatar-xs rounded-circle me-2">
                                    {{ $ticket->user->name }}
                                </div>
                            </td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>
                                <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'success') }}">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ 
                                    $ticket->status == 'open' || $ticket->status == 'in-progress' ? 'info' :
                                    ($ticket->status == 'resolved' ? 'primary' : 'secondary')
                                }}">
                                    {{ ucfirst(str_replace('-', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td>
                                @if($ticket->images)
                                    <span class="badge bg-primary">{{ count($ticket->images) }}</span>
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $ticket->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('agent.tickets.show', $ticket) }}" class="btn btn-sm btn-primary">
                                    <i class="ri-eye-line"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="ri-inbox-line fs-1 text-muted d-block mb-3"></i>
                                <h5>No tickets assigned to you yet</h5>
                                <p class="text-muted">Tickets will appear here when admin assigns them to you.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $tickets->links() }}
    </div>
</div>
@endsection