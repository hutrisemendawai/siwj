<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="edit-gallery-container">
        <h1 class="edit-gallery-title">Ubah Galeri</h1>
        <p class="edit-gallery-subtitle">Your social campaigns</p>

        <!-- Delete button -->
        <form action="{{ route('gaposts.destroy', $gapost) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="edit-gallery-delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="edit-gallery-delete-button">Hapus</button>
        </form>

        <!-- Edit form -->
        <form action="{{ route('gaposts.update', $gapost) }}" method="POST" enctype="multipart/form-data" class="edit-gallery-form">
            @csrf
            @method('PUT')

            <div class="edit-gallery-form-group">
                <label for="title" class="edit-gallery-label">Judul</label>
                <input type="text" name="title" id="title" class="edit-gallery-input" value="{{ old('title', $gapost->title) }}" required>
            </div>

            <div class="edit-gallery-form-group">
                <label for="content" class="edit-gallery-label">Konten</label>
                <textarea name="content" id="content" class="edit-gallery-textarea" required>{{ old('content', $gapost->content) }}</textarea>
            </div>

            <div class="edit-gallery-form-group">
                <label for="image" class="edit-gallery-label">Gambar</label>
                <input type="file" name="image" id="image" class="edit-gallery-file-input">
                @if($gapost->image)
                    <img src="{{ asset('storage/' . $gapost->image) }}" alt="Current image" class="edit-gallery-current-image">
                @endif
            </div>

            <button type="submit" class="edit-gallery-submit-button">Kirim</button>
        </form>
    </div>
</x-app-layout>
