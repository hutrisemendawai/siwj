

<x-app-layout>
    <div class="blog-container">
        <h1 class="blog-title">All Blog Posts</h1>

        <!-- Create New Blog Post Button -->
        <a href="{{ route('blog.create') }}" class="blog-create-button">Create New Blog Post</a>

        @foreach ($blogs as $blog)
            <div class="blog-post">
                <p class="blog-post-date">{{ $blog->created_at->format('d M Y') }}</p>
                <h3 class="blog-post-title">{{ $blog->title }}</h3>
                @if ($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Post Image" class="blog-post-image">
                @endif
                <p class="blog-post-content">{{ $blog->content }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
