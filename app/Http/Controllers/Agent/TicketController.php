<?php

namespace App\Http\Controllers\Agent;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'category'])
                       ->where('assigned_to', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tickets = $query->latest()->paginate(15);

        return view('agent.content.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        // Agent can only view assigned tickets
        if ($ticket->assigned_to !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['user', 'category', 'comments.user', 'comments.replies.user']);

        return view('agent.content.tickets.show', compact('ticket'));
    }
}