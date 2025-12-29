<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        // Allow comment if:
        // 1. User is the ticket creator (customer)
        // 2. OR user is admin
        // 3. OR user is agent
        $canComment = $ticket->user_id === Auth::id() 
                      || in_array(Auth::user()->role, ['admin', 'agent']);

        if (!$canComment) {
            abort(403, 'You are not authorized to comment on this ticket.');
        }

        $request->validate([
            'content' => 'required|string|min:5',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        // Optional: Ensure parent comment belongs to this ticket
        if ($request->filled('parent_id')) {
            $parentComment = Comment::findOrFail($request->parent_id);
            if ($parentComment->ticket_id !== $ticket->id) {
                abort(400, 'Invalid reply target.');
            }
        }

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }
}