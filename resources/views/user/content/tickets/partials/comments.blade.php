<!-- Comments Display -->
@if($ticket->comments->isEmpty())
    <div class="text-center py-5">
        <i class="ri-chat-3-line fs-1 text-muted mb-3 d-block"></i>
        <p class="text-muted">No comments yet. Start the conversation!</p>
    </div>
@else
    <div class="comments-thread">
        @foreach($ticket->comments as $comment)
            <div class="comment-item mb-4 pb-4 border-bottom">
                <div class="d-flex">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0 me-3">
                        <img src="{{ $comment->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                            alt="{{ $comment->user->name }}" class="avatar-md rounded-circle border border-light">
                    </div>

                    <!-- Comment Content -->
                    <div class="flex-grow-1">
                        <div class="bg-white p-4 rounded shadow-sm border">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $comment->user->name }}</h6>
                                    <small class="text-muted">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <p class="mb-0 text-dark">
                                {!! nl2br(e($comment->content)) !!}
                            </p>
                        </div>

                        <!-- Reply Button -->
                        <button class="btn btn-sm btn-link text-primary mt-2 reply-toggle" data-comment-id="{{ $comment->id }}">
                            <i class="ri-reply-line align-bottom"></i> Reply
                        </button>

                        <!-- Threaded Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="replies mt-4 ms-5">
                                @foreach($comment->replies as $reply)
                                    <div class="d-flex mb-3">
                                        <img src="{{ $reply->user->profile_photo_url ?? asset('build/images/users/avatar-1.jpg') }}"
                                            alt="" class="avatar-sm rounded-circle me-3 flex-shrink-0">
                                        <div class="bg-light p-3 rounded flex-grow-1 border">
                                            <div class="d-flex justify-content-between">
                                                <strong>{{ $reply->user->name }}</strong>
                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 mt-2">{{ nl2br(e($reply->content)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Reply Form (Hidden by default) -->
                        <div class="reply-form mt-3 d-none" id="reply-form-{{ $comment->id }}">
                            <form action="{{ route('comments.store', $ticket) }}" method="POST">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <div class="mb-3">
                                    <textarea name="content" class="form-control" rows="3" placeholder="Write your reply..."
                                        required></textarea>
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- JavaScript to Toggle Reply Forms -->
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