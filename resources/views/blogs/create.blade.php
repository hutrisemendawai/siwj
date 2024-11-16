<link rel="stylesheet" href="css/blog-style.css">

<x-app-layout>
    <div class="blog-container">
        <h1 class="blog-title">Create New Blog Post</h1>

        <!-- Blog Post Form -->
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" class="blog-form">
            @csrf
            <div class="blog-form-group">
                <label for="title" class="blog-label">Title</label>
                <input type="text" id="title" name="title" class="blog-input" required>
            </div>

            <div class="blog-form-group">
                <label for="content" class="blog-label">Content</label>
                <textarea id="content" name="content" class="blog-textarea" rows="5" required></textarea>
            </div>

            <div class="blog-form-group">
                <label for="image" class="blog-label">Upload Image</label>
                <input type="file" id="image" name="image" class="blog-input-file">
            </div>

            <button type="submit" class="blog-submit-button">Publish to Blog and Facebook</button>
        </form>
    </div>
</x-app-layout>
