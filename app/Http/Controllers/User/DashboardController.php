<?php

namespace App\Http\Controllers\User;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();

        $statusCounts = Ticket::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $open = $statusCounts['open'] ?? 0;
        $inProgress = $statusCounts['in-progress'] ?? 0;
        $resolved = $statusCounts['resolved'] ?? 0;
        $closed = $statusCounts['closed'] ?? 0;

        $pending = $open + $inProgress;

        return view('user.dashboard', compact(
            'totalTickets',
            'open',
            'inProgress',
            'resolved',
            'closed',
            'pending'
        ));
    }
}