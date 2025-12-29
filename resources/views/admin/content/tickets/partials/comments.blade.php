<!-- Admin Comments Partial -->
@if($ticket->comments->isEmpty())
    <div class="text-center py-5 bg-light rounded p-3">
        <i class="ri-chat-3-line fs-2 text-muted mb-3 d-block"></i>
        <p class="text-muted mb-0">No comments yet. Be the first to reply!</p>
    </div>
@else
    <div class="comments-thread">
        @foreach($ticket->comments as $comment)
            <div class="comment-item mb-4 pb-4 border-bottom">
                <div class="d-flex">
                    <!-- User Avatar & Role Badge -->
                    <div class="flex-shrink-0 me-3 position-relative">
                        <img src="{{ $comment->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                             alt="{{ $comment->user->name }}"
                             class="avatar-md rounded-circle border border-light">
                        
                        <!-- Role Badge -->
                        <span class="position-absolute bottom-0 end-0 bg-{{ 
                            $comment->user->role == 'admin' ? 'danger' :
                            ($comment->user->role == 'agent' ? 'warning' : 'primary')
                        }} text-white rounded-circle p-1" 
                              style="font-size: 0.7rem; width: 20px; height: 20px;">
                            {{ strtoupper(substr($comment->user->role, 0, 1)) }}
                        </span>
                    </div>

                    <!-- Comment Content -->
                    <div class="flex-grow-1">
                        <div class="bg-white p-4 rounded shadow-sm border">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">
                                        {{ $comment->user->role }} • {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <!-- Admin: Delete Comment Button -->
                                <button type="button" class="btn btn-sm btn-outline-danger ms-auto"
                                        data-bs-toggle="modal" data-bs-target="#confirmModal"
                                        data-action="delete-comment"
                                        data-title="Delete Comment?"
                                        data-message="This comment will be permanently deleted."
                                        data-form-action="{{ route('admin.tickets.delete-comment', ['ticket' => $ticket, 'comment' => $comment]) }}"
                                        data-method="DELETE">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                            <p class="mb-0 text-dark">
                                {!! nl2br(e($comment->content)) !!}
                            </p>
                        </div>

                        <!-- Reply Button (for users) -->
                        @if(auth()->user()->role === 'customer' || auth()->user()->role === 'agent')
                            <button class="btn btn-sm btn-link text-primary mt-2 reply-toggle"
                                    data-comment-id="{{ $comment->id }}">
                                <i class="ri-reply-line align-bottom"></i> Reply
                            </button>
                        @endif

                        <!-- Threaded Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="replies mt-4 ms-5">
                                @foreach($comment->replies as $reply)
                                    <div class="d-flex mb-3">
                                        <img src="{{ $reply->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                             alt="" class="avatar-sm rounded-circle me-3 flex-shrink-0">
                                        <div class="bg-light p-3 rounded flex-grow-1 border">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <strong>{{ $reply->user->name }}</strong>
                                                    <small class="text-muted ms-2">
                                                        {{ $reply->user->role }} • {{ $reply->created_at->diffForHumans() }}
                                                    </small>
                                                </div>
                                                <!-- Admin: Delete Reply -->
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal" data-bs-target="#confirmModal"
                                                        data-action="delete-comment"
                                                        data-title="Delete Reply?"
                                                        data-message="This reply will be permanently deleted."
                                                        data-form-action="{{ route('admin.tickets.delete-comment', ['ticket' => $ticket, 'comment' => $reply]) }}"
                                                        data-method="DELETE">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                            <p class="mb-0 mt-2">{{ nl2br(e($reply->content)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Reply Form (for users) -->
                        @if(auth()->user()->role === 'customer' || auth()->user()->role === 'agent')
                            <div class="reply-form mt-3 d-none" id="reply-form-{{ $comment->id }}">
                                <form action="{{ route('comments.store', $ticket) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control" rows="3"
                                                  placeholder="Write your reply..." required></textarea>
                                        @error('content')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary btn-sm">Send Reply</button>
                                        <button type="button" class="btn btn-secondary btn-sm cancel-reply">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Admin Reply Form (always visible to admin) -->
<div class="mt-5">
    <h6 class="fw-bold">Reply as Admin</h6>
    <form action="{{ route('comments.store', $ticket) }}" method="POST">
        @csrf
        <textarea name="content" rows="5" class="form-control" 
                  placeholder="Your official response as admin..." required></textarea>
        <button type="submit" class="btn btn-primary mt-3">Send Admin Reply</button>
    </form>
</div>

<!-- JavaScript for Reply Toggle -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toggle reply form
    document.querySelectorAll('.reply-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            const form = document.getElementById('reply-form-' + commentId);
            form.classList.toggle('d-none');
        });
    });

    // Cancel reply
    document.querySelectorAll('.cancel-reply').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.reply-form').classList.add('d-none');
        });
    });
});
</script>