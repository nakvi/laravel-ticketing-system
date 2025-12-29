<?php

namespace App\Http\Controllers\User;

use App\Models\Ticket;
use App\Models\Category;
use App\Http\Requests\{StoreTicketRequest, UpdateTicketRequest};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the user's own tickets.
     */
    public function index()
    {
        // Only show tickets belonging to the logged-in user
        $tickets = Ticket::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.content.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('user.content.tickets.create', compact('categories'));
    }

    /**
     * Store a newly created ticket.
     */

    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'open';
        $validated['is_active'] = true;

        $imagePaths = [];

        if ($request->hasFile('images')) {
            // Create directory if not exists
            Storage::disk('public')->makeDirectory('tickets/images');

            foreach ($request->file('images') as $image) {
                $path = $image->store('tickets/images', 'public');
                $imagePaths[] = $path;
            }

            $validated['images'] = $imagePaths;
        }

        Ticket::create($validated);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully with images!');
    }
    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load(['category', 'comments.user', 'comments.replies.user']);

        return view('user.content.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the ticket (optional for user - e.g., edit title/description).
     */
    public function edit(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('user.content.tickets.edit', compact('ticket', 'categories'));
    }

    /**
     * Update the ticket.
     */

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();

        $imagePaths = $ticket->images ?? [];

        // Handle image deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $deletePath) {
                if ($deletePath && in_array($deletePath, $imagePaths)) {
                    // Delete from storage
                    Storage::disk('public')->delete($deletePath);
                    // Remove from array
                    $imagePaths = array_diff($imagePaths, [$deletePath]);
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            Storage::disk('public')->makeDirectory('tickets/images');

            foreach ($request->file('images') as $image) {
                $path = $image->store('tickets/images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Update images array (only if changed)
        if ($imagePaths !== ($ticket->images ?? [])) {
            $validated['images'] = array_values($imagePaths); // re-index
        }

        $ticket->update($validated);

        return redirect()->route('tickets.index', $ticket)
            ->with('success', 'Ticket updated successfully!');
    }

    /**
     * Remove the ticket.
     */
    public function destroy(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully!');
    }

    /**
     * Reopen a resolved/closed ticket.
     */
    public function reopen(Ticket $ticket)
    {
        // Only the ticket creator can reopen
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow reopen if status is resolved or closed
        if (!in_array($ticket->status, ['resolved', 'closed'])) {
            return back()->with('error', 'Only resolved or closed tickets can be reopened.');
        }

        // Update ticket
        $ticket->update([
            'status' => 'open',
            'is_reopened' => true,                    // Mark as reopened (can stay true forever)
            'reopened_at' => now(),
            'rating' => null,                         // Clear previous rating
            'feedback_comment' => null,               // Clear previous feedback
        ]);

        // Add a system comment for history
        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => 'Ticket has been reopened by the customer.' .
                ($ticket->rating ? ' Previous feedback cleared.' : ''),
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket has been successfully reopened. We\'ll review it again.');
    }

    /**
     * Submit feedback/rating.
     */
    public function feedback(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($ticket->status, ['resolved', 'closed'])) {
            return back()->with('error', 'You can only give feedback on resolved or closed tickets.');
        }

        if ($ticket->rating) {
            return back()->with('error', 'You have already submitted feedback.');
        }

        $request->validate([
            'rating' => 'required|in:excellent,good,average,poor',
            'feedback_comment' => 'nullable|string|max:1000',
        ]);

        $ticket->update([
            'rating' => $request->rating,
            'feedback_comment' => $request->feedback_comment,
        ]);

        // Add system comment
        $ticket->comments()->create([
            'user_id' => Auth::id(),
            'content' => 'Customer gave feedback: ' . ucfirst($request->rating) .
                ($request->feedback_comment ? "\n\nComment: " . $request->feedback_comment : ''),
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Thank you for your feedback!');
    }
}
