<?php

namespace App\Http\Controllers\Agent;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        $agentId = Auth::id();

        $totalAssigned = Ticket::where('assigned_to', $agentId)->count();
        $openAssigned = Ticket::where('assigned_to', $agentId)
                              ->whereIn('status', ['open', 'in-progress'])
                              ->count();
        $resolvedByAgent = Ticket::where('assigned_to', $agentId)
                                 ->where('status', 'resolved')
                                 ->count();

        $assignedTickets = Ticket::with(['user', 'category'])
                                 ->where('assigned_to', $agentId)
                                 ->latest()
                                 ->paginate(15);

        return view('agent.dashboard', compact(
            'totalAssigned',
            'openAssigned',
            'resolvedByAgent',
            'assignedTickets'
        ));
    }
}