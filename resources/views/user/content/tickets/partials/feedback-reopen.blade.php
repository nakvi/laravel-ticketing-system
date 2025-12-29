<!-- Feedback & Reopen Section -->
@if(in_array($ticket->status, ['resolved', 'closed']))
    <div class="card border-primary mb-4">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0">
                @if($ticket->rating)
                    Your Previous Feedback
                @else
                    Rate Your Experience
                @endif
            </h6>
        </div>
        <div class="card-body">

            <!-- Show Previous Feedback -->
            @if($ticket->rating)
                <div class="text-center py-4">
                    <h5>Thank you for your feedback!</h5>
                    <span class="badge bg-{{ 
                                $ticket->rating == 'excellent' ? 'success' :
                    ($ticket->rating == 'good' ? 'info' :
                        ($ticket->rating == 'average' ? 'warning' : 'danger'))
                            }} fs-4 px-4 py-2">
                        {{ ucfirst($ticket->rating) }}
                    </span>

                    @if($ticket->feedback_comment)
                        <div class="mt-3 p-3 bg-light rounded">
                            <strong>Comment:</strong>
                            <p class="mb-0 mt-2">{{ $ticket->feedback_comment }}</p>
                        </div>
                    @endif

                    <!-- Show Reopen Button Again -->
                    <div class="mt-4">
                        <form action="{{ route('tickets.reopen', $ticket) }}" method="POST" class="d-inline">
                            @csrf
                            <!-- Reopen Button with Modal -->
                            <button type="button" class="btn btn-warning btn-lg px-5" data-bs-toggle="modal"
                                data-bs-target="#confirmModal" data-action="reopen" data-title="Reopen Ticket?"
                                data-message="Are you sure you want to reopen this ticket? It will be moved back to Open status."
                                data-form-action="{{ route('tickets.reopen', $ticket) }}" data-method="POST">
                                <i class="ri-refresh-line align-bottom me-2"></i>
                                Not Satisfied – Reopen Ticket Again
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Fresh Feedback Form -->
                <form action="{{ route('tickets.feedback', $ticket) }}" method="POST">
                    @csrf

                    <div class="text-center mb-4">
                        <label class="form-label fs-5 fw-bold">How satisfied are you with the resolution?</label>
                        <div class="d-flex justify-content-center gap-4 flex-wrap mt-4">
                            <div>
                                <input type="radio" class="btn-check" name="rating" value="excellent" id="exc" required>
                                <label class="btn btn-outline-success btn-lg px-4" for="exc">Excellent 😊</label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="rating" value="good" id="good">
                                <label class="btn btn-outline-primary btn-lg px-4" for="good">Good 🙂</label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="rating" value="average" id="avg">
                                <label class="btn btn-outline-warning btn-lg px-4" for="avg">Average 😐</label>
                            </div>
                            <div>
                                <input type="radio" class="btn-check" name="rating" value="poor" id="poor">
                                <label class="btn btn-outline-danger btn-lg px-4" for="poor">Poor 😞</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="feedback_comment" class="form-label">Additional Comments (optional)</label>
                        <textarea name="feedback_comment" id="feedback_comment" rows="4" class="form-control"
                            placeholder="Tell us more so we can improve..."></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endif