@extends('layouts.master')

@section('title', 'Agent Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h4 class="mb-4">Welcome back, {{ Auth::user()->name }}! Your Assigned Tickets</h4>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Assigned</h5>
                <h3>{{ $totalAssigned }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Open / In Progress</h5>
                <h3>{{ $openAssigned }}</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Resolved by You</h5>
                <h3>{{ $resolvedByAgent }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Your Assigned Tickets</h5>
                <a href="{{ route('agent.tickets.index') }}" class="btn btn-primary btn-sm">View All</a>
            </div>
            <div class="card-body">
                @if($assignedTickets->isEmpty())
                    <p class="text-center py-4 text-muted">No tickets assigned to you yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Customer</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignedTickets as $ticket)
                                    <tr>
                                        <td>#{{ $ticket->id }}</td>
                                        <td>{{ Str::limit($ticket->title, 40) }}</td>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $ticket->priority == 'high' ? 'danger' : 'warning' }}">
                                                {{ ucfirst($ticket->priority) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ ucfirst(str_replace('-', ' ', $ticket->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('agent.tickets.show', $ticket) }}" class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $assignedTickets->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection