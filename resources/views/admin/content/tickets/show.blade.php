@extends('layouts.master')

@section('title', 'Ticket #' . $ticket->id . ' - Admin View')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Ticket #{{ $ticket->id }}: {{ $ticket->title }}
                    {{-- @if($ticket->trashed())
                        <span class="badge bg-danger ms-2">Trashed</span>
                    @endif --}}
                </h5>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-light btn-sm">
                    <i class="ri-arrow-left-line"></i> Back to List
                </a>
            </div>

            <div class="card-body">
                <!-- Ticket Info Grid -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <strong>Submitted By:</strong><br>
                        <a href="mailto:{{ $ticket->user->email }}">{{ $ticket->user->name }}</a>
                    </div>
                    <div class="col-md-3">
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
                        {{ $ticket->created_at->format('d M Y, H:i') }}
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

                <!-- Attached Images -->
                @if($ticket->images && count($ticket->images) > 0)
                    <div class="mb-5">
                        <h6 class="fw-bold">Attached Images ({{ count($ticket->images) }})</h6>
                        <div class="row g-3">
                            @foreach($ticket->images as $image)
                                <div class="col-md-4">
                                    <a href="{{ asset('storage/' . $image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             class="img-fluid rounded shadow-sm border" 
                                             alt="Attachment">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Assignment & Status Controls -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Ticket Management</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Assign to Agent -->
                            <div class="col-md-6">
                                <form action="{{ route('admin.tickets.assign', $ticket) }}" method="POST">
                                    @csrf
                                    <label class="form-label">Assigned To</label>
                                    <select name="assigned_to" class="form-select">
                                        <option value="">Unassigned</option>
                                        @foreach(\App\Models\User::whereIn('role', ['agent', 'admin'])->get() as $agent)
                                            <option value="{{ $agent->id }}" 
                                                    {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->name }} ({{ ucfirst($agent->role) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Assign</button>
                                </form>
                            </div>

                            <!-- Status & Priority -->
                            <div class="col-md-6">
                                <form action="{{ route('tickets.update-status', $ticket) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in-progress" {{ $ticket->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Priority</label>
                                            <select name="priority" class="form-select" required>
                                                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success mt-3 w-100">Update Status</button>
                                </form>
                            </div>
                        </div>

                        <!-- Current Assignment Display -->
                        @if($ticket->assignedAgent)
                            <div class="mt-3 alert alert-info">
                                <strong>Currently assigned to:</strong> {{ $ticket->assignedAgent->name }}
                                <span class="badge bg-warning ms-2">{{ ucfirst($ticket->assignedAgent->role) }}</span>
                            </div>
                        @else
                            <div class="mt-3 alert alert-secondary">
                                <strong>Not assigned yet</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Conversation -->
                <h5 class="mt-5">Conversation</h5>
                <div class="border rounded p-4 bg-light mb-4">
                    @include('admin.content.tickets.partials.comments')
                </div>

                <!-- Admin Reply Form -->
                <div class="card border-success mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="mb-0">Reply as Support Team</h6>
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

                <!-- Feedback (if any) -->
                @if($ticket->rating)
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">Customer Feedback</h6>
                        </div>
                        <div class="card-body text-center py-4">
                            <span class="badge bg-{{ 
                                $ticket->rating == 'excellent' ? 'success' :
                                ($ticket->rating == 'good' ? 'info' :
                                ($ticket->rating == 'average' ? 'warning' : 'danger'))
                            }} fs-3 px-4 py-2">
                                {{ ucfirst($ticket->rating) }}
                            </span>
                            @if($ticket->feedback_comment)
                                <p class="mt-3"><strong>Comment:</strong> {{ $ticket->feedback_comment }}</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection