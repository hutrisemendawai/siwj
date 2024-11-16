<link rel="stylesheet" href="css/style.css">

<x-app-layout>
    <div class="discussion-details-container">
        <!-- Discussion Details -->
        <div class="discussion-details-card">
            <div class="discussion-details-header">
                <img src="{{ $discussion->user->profile_photo ? asset('storage/profile_photos/' . $discussion->user->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                     alt="{{ $discussion->user->name }}" 
                     class="discussion-details-user-image">
                <div>
                    <h4 class="discussion-details-username">{{ $discussion->user->name }}</h4>
                    <small class="discussion-details-meta">Posted on {{ $discussion->created_at->format('d M Y, h:i A') }}</small>
                </div>
                
                <!-- Delete Post Button (if user is owner or admin) -->
                @if(auth()->id() == $discussion->user_id || auth()->user()->role === 'admin')
                    <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" class="discussion-delete-post-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="discussion-delete-post-button">Delete Post</button>
                    </form>
                @endif
            </div>
            <h1 class="discussion-details-title">{{ $discussion->title }}</h1>
            <p class="discussion-details-content">{{ $discussion->content }}</p>
        </div>

        <!-- Comments Section -->
        <h2 class="discussion-comments-title">Comments</h2>
        @forelse($discussion->comments as $comment)
            <div class="discussion-comment-card">
                <div class="discussion-comment-header">
                    <img src="{{ $comment->user->profile_photo ? asset('storage/profile_photos/' . $comment->user->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                         alt="{{ $comment->user->name }}" 
                         class="discussion-comment-user-image">
                    <div>
                        <h5 class="discussion-comment-username">{{ $comment->user->name }}</h5>
                        <small class="discussion-comment-meta">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <p class="discussion-comment-content">{{ $comment->content }}</p>

                <!-- Delete Comment (if authorized) -->
                @if(auth()->id() == $comment->user_id || auth()->user()->role === 'admin')
                    <form action="{{ route('comments.destroy', [$discussion->id, $comment->id]) }}" method="POST" class="discussion-comment-delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="discussion-comment-delete-button">Delete Comment</button>
                    </form>
                @endif
            </div>
        @empty
            <p class="discussion-no-comments">No comments yet. Be the first to comment!</p>
        @endforelse

        <!-- Add Comment Form -->
        <h3 class="discussion-add-comment-title">Add a Comment</h3>
        <form action="{{ route('comments.store', $discussion->id) }}" method="POST" class="discussion-add-comment-form">
            @csrf
            <textarea name="content" placeholder="Add a comment..." required class="discussion-add-comment-textarea"></textarea>
            <button type="submit" class="discussion-add-comment-button">Post Comment</button>
        </form>
    </div>
</x-app-layout>
