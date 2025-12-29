<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'open')->orWhere('status', 'in-progress')->count();
        $resolvedTickets = Ticket::where('status', 'resolved')->count();
        $closedTickets = Ticket::where('status', 'closed')->count();

        $recentTickets = Ticket::with(['user', 'category'])
                              ->latest()
                              ->take(10)
                              ->get();

        return view('admin.dashboard', compact(
            'totalTickets', 'openTickets', 'resolvedTickets', 'closedTickets', 'recentTickets'
        ));
    }
}
