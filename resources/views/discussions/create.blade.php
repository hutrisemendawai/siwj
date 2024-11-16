<x-app-layout>
    <div class="discussion-create-container">
        <h1>Create New Discussion</h1>

        <form action="{{ route('discussions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Post Discussion</button>
        </form>
    </div>
</x-app-layout>
