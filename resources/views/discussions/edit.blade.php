<x-app-layout>
    <div class="discussion-edit-container">
        <h1>Edit Discussion</h1>

        <form action="{{ route('discussions.update', $discussion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $discussion->title }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" required>{{ $discussion->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</x-app-layout>
