@extends('layouts.master')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ticket #{{ $ticket->id }}: {{ $ticket->title }}</h5>
                    <a href="{{ route('tickets.index') }}" class="btn btn-light btn-sm">
                        <i class="ri-arrow-left-line"></i> Back
                    </a>
                </div>
                <div class="card-body">

                    <!-- Ticket Info -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <strong>Category:</strong> {{ $ticket->category->name }}
                        </div>
                        <div class="col-md-3">
                            <strong>Priority:</strong>
                            <span
                                class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : ($ticket->priority == 'medium' ? 'warning' : 'success') }} ms-2">
                                {{ ucfirst($ticket->priority) }}
                            </span>
                        </div>
                        <div class="col-md-3">
                            <strong>Status:</strong>
                            <span class="badge bg-info ms-2">{{ ucfirst(str_replace('-', ' ', $ticket->status)) }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Created:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <hr>

                    <!-- Description -->
                    <div class="mb-5">
                        <h6>Description</h6>
                        <div class="p-4 bg-light rounded">
                            {!! nl2br(e($ticket->description)) !!}
                        </div>
                    </div>
                    <!-- Attached Images -->
                    @if($ticket->images && count($ticket->images) > 0)
                        <div class="mb-5">
                            <h6>Attached Images ({{ count($ticket->images) }})</h6>
                            <div class="row g-3">
                                @foreach($ticket->images as $image)
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded shadow-sm"
                                            alt="Ticket image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Comments Section -->
                    <h5>Conversation</h5>
                    <div class="border rounded p-4 bg-light mb-4">
                        @include('user.content.tickets.partials.comments')
                    </div>

                    <!-- Add Reply -->
                    <div class="card border-primary mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Add Reply</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('comments.store', $ticket) }}" method="POST">
                                @csrf
                                <textarea name="content" rows="4" class="form-control" placeholder="Write your reply..."
                                    required></textarea>
                                <button type="submit" class="btn btn-primary mt-3">Send Reply</button>
                            </form>
                        </div>
                    </div>

                    <!-- Feedback & Reopen Section -->
                    @include('user.content.tickets.partials.feedback-reopen')
                </div>
            </div>
        </div>
    </div>
@endsection