<link rel="stylesheet" href="css/style.css">

<x-app-layout>
    <div class="discussion-container">
        <!-- Profile Sidebar -->
        <aside class="discussion-profile-sidebar">
            <div class="discussion-profile-card">
                <img src="{{ auth()->user()->profile_photo ? asset('storage/profile_photos/' . auth()->user()->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                     alt="{{ auth()->user()->name }}" 
                     class="discussion-profile-image">
                <h3 class="discussion-profile-name">{{ auth()->user()->name }}</h3>
                <div class="discussion-profile-posts-count">
                    <strong>{{ $discussions->count() }}</strong> Posts
                </div>
            </div>
        </aside>

        <!-- Discussion Feed -->
        <div class="discussion-feed">
            <!-- New Post Form -->
            <div class="discussion-new-post">
                <form action="{{ route('discussions.store') }}" method="POST">
                    @csrf
                    <div class="discussion-new-post-input">
                        <input type="text" name="title" placeholder="Title" required class="discussion-new-post-title">
                        <textarea name="content" placeholder="What's on your mind, {{ auth()->user()->name }}?" required></textarea>
                    </div>
                    <button type="submit" class="discussion-new-post-button">Post</button>
                </form>
            </div>

            <!-- Discussion Posts -->
            @foreach($discussions as $discussion)
                <div class="discussion-post-card">
                    <div class="discussion-post-header">
                        <img src="{{ $discussion->user->profile_photo ? asset('storage/profile_photos/' . $discussion->user->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                             alt="{{ $discussion->user->name }}" 
                             class="discussion-post-user-image">
                        <div>
                            <h4 class="discussion-post-username">{{ $discussion->user->name }}</h4>
                            <span class="discussion-post-date">{{ $discussion->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                    </div>
                    <h3 class="discussion-post-title">
                        <a href="{{ route('discussions.show', $discussion->id) }}" class="discussion-post-title-link">
                            {{ $discussion->title }}
                        </a>
                    </h3>
                    <p class="discussion-post-content">{{ $discussion->content }}</p>

                    <!-- Comments Section -->
                    <div class="discussion-comments">
                        <span class="discussion-comments-count">{{ $discussion->comments->count() }} Comments</span>
                        @foreach($discussion->comments as $comment)
                            <div class="discussion-comment">
                                <img src="{{ $comment->user->profile_photo ? asset('storage/profile_photos/' . $comment->user->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
                                     alt="{{ $comment->user->name }}" 
                                     class="discussion-comment-user-image">
                                <div>
                                    <h5 class="discussion-comment-username">{{ $comment->user->name }}</h5>
                                    <span class="discussion-comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                    <p class="discussion-comment-content">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Add New Comment via AJAX -->
                        <form action="{{ route('comments.store', $discussion) }}" method="POST" class="discussion-new-comment-form ajax-comment-form" data-discussion-id="{{ $discussion->id }}">
                            @csrf
                            <div class="discussion-new-comment-input">
                                <textarea name="content" placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit" class="discussion-new-comment-button">Comment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript for AJAX Comment Submission -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const commentForms = document.querySelectorAll('.ajax-comment-form');

            commentForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const discussionId = form.getAttribute('data-discussion-id');
                    const formData = new FormData(form);

                    fetch(`/discussions/${discussionId}/comments`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const commentSection = form.closest('.discussion-comments');
                            const newComment = document.createElement('div');
                            newComment.classList.add('discussion-comment');
                            
                            newComment.innerHTML = `
                                <img src="${data.user_photo}" alt="${data.user_name}" class="discussion-comment-user-image">
                                <div>
                                    <h5 class="discussion-comment-username">${data.user_name}</h5>
                                    <span class="discussion-comment-date">Just now</span>
                                    <p class="discussion-comment-content">${data.content}</p>
                                </div>
                            `;
                            commentSection.insertBefore(newComment, form);

                            form.querySelector('textarea[name="content"]').value = '';
                        } else {
                            alert('Failed to post comment. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error posting comment:', error);
                    });
                });
            });
        });
    </script>
</x-app-layout>
