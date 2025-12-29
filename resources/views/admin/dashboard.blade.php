@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Admin Dashboard - All Tickets Overview</h4>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Tickets</h5>
                <h3>{{ $totalTickets }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Open / In Progress</h5>
                <h3>{{ $openTickets }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Resolved</h5>
                <h3>{{ $resolvedTickets }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5>Closed</h5>
                <h3>{{ $closedTickets }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Tickets</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentTickets as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>{{ Str::limit($ticket->title, 40) }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->category->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst(str_replace('-', ' ', $ticket->status)) }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : 'warning' }}">{{ ucfirst($ticket->priority) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection