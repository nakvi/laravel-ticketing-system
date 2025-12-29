@extends('layouts.master')

@section('title', 'My Tickets')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">My Tickets</h4>
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                    <i class="ri-add-line align-bottom me-1"></i> New Ticket
                </a>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Rating</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket) }}" class="fw-medium">
                                                {{ Str::limit($ticket->title, 50) }}
                                            </a>
                                        </td>
                                        <td>{{ $ticket->category->name }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'success') }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $ticket->status == 'open' || $ticket->status == 'in-progress' ? 'info' : ($ticket->status == 'resolved' ? 'primary' : 'secondary') }}">
                                                {{ ucfirst(str_replace('-', ' ', $ticket->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($ticket->rating)
                                                <span
                                                    class="badge bg-{{ $ticket->rating == 'excellent' ? 'success' : ($ticket->rating == 'good' ? 'info' : ($ticket->rating == 'average' ? 'warning' : 'danger')) }}">
                                                    {{ ucfirst($ticket->rating) }}
                                                </span>
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('tickets.show', $ticket) }}"
                                                class="btn btn-sm btn-soft-info me-1">
                                                <i class="ri-eye-line"></i> View
                                            </a>

                                            @if($ticket->status == 'open' )
                                                <!-- Edit Button - Only if active -->
                                                <a href="{{ route('tickets.edit', $ticket) }}"
                                                    class="btn btn-sm btn-soft-warning me-1">
                                                    <i class="ri-edit-line"></i> Edit
                                                </a>

                                                <!-- Delete Button (Soft Delete) with Modal - Only if active -->
                                                <button type="button" class="btn btn-sm btn-soft-danger" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal" data-action="delete" data-title="Delete Ticket?"
                                                    data-message="This ticket will be moved to trash. You can restore it later."
                                                    data-form-action="{{ route('tickets.destroy', $ticket) }}" data-method="DELETE">
                                                    <i class="ri-delete-bin-line"></i> Delete
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <i class="ri-inbox-archive-line fs-1 text-muted d-block mb-3"></i>
                                            <h5>No tickets yet</h5>
                                            <p class="text-muted">Create your first support ticket.</p>
                                            <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create Ticket</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection