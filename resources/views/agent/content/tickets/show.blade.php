@extends('layouts.master')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Ticket #{{ $ticket->id }}: {{ $ticket->title }}
                </h5>
                <a href="{{ route('agent.tickets.index') }}" class="btn btn-light btn-sm">
                    <i class="ri-arrow-left-line"></i> Back
                </a>
            </div>

            <div class="card-body">
                <!-- Ticket Info -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <strong>Customer:</strong><br>
                        <div class="d-flex align-items-center mt-1">
                            <img src="{{ $ticket->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                 class="avatar-sm rounded-circle me-2">
                            {{ $ticket->user->name }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <strong>Category:</strong><br>
                        {{ $ticket->category->name }}
                    </div>
                    <div class="col-md-2">
                        <strong>Priority:</strong><br>
                        <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'success') }} fs-6">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>
                    <div class="col-md-2">
                        <strong>Status:</strong><br>
                        <span class="badge bg-info fs-6">
                            {{ ucfirst(str_replace('-', ' ', $ticket->status)) }}
                        </span>
                    </div>
                    <div class="col-md-2">
                        <strong>Created:</strong><br>
                        {{ $ticket->created_at->format('d M Y') }}
                    </div>
                </div>

                <hr class="my-4">

                <!-- Description -->
                <div class="mb-5">
                    <h6 class="fw-bold">Description</h6>
                    <div class="p-4 bg-light rounded border">
                        {!! nl2br(e($ticket->description)) !!}
                    </div>
                </div>

                <!-- Images -->
                @if($ticket->images && count($ticket->images) > 0)
                    <div class="mb-5">
                        <h6 class="fw-bold">Attached Images ({{ count($ticket->images) }})</h6>
                        <div class="row g-3">
                            @foreach($ticket->images as $image)
                                <div class="col-md-4">
                                    <a href="{{ asset('storage/' . $image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="img-fluid rounded shadow-sm" alt="Attachment">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Conversation -->
                <h5 class="mt-5">Conversation</h5>
                <div class="border rounded p-4 bg-light mb-4">
                    @include('agent.content.tickets.partials.comments')
                </div>

                <!-- Agent Reply Form -->
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Reply to Customer</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comments.store', $ticket) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="5" class="form-control" 
                                      placeholder="Write your response..." required></textarea>
                            <button type="submit" class="btn btn-success mt-3">
                                Send Reply
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Status Update -->
                <div class="card border-primary mt-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Update Status</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tickets.update-status', $ticket) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="in-progress" {{ $ticket->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Priority</label>
                                    <select name="priority" class="form-select" required>
                                        <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection