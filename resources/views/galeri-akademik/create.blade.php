<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="academic-gallery-container">
        <h1 class="gallery-title">Buat Galeri</h1>
        <p class="gallery-subtitle">Your social campaigns</p>

        <form action="{{ route('gaposts.store') }}" method="POST" enctype="multipart/form-data" class="academic-gallery-form">
            @csrf
            <input type="text" name="title" placeholder="Judul" required class="gallery-input">
            <textarea name="content" placeholder="Konten" required class="gallery-textarea"></textarea>
            <div class="gallery-file-upload">
                <label class="gallery-upload-label" for="image">Unggah</label>
                <input type="file" name="image" id="image" class="gallery-input-file">
            </div>
            <button type="submit" class="gallery-submit-button">Kirim</button>
        </form>
    </div>
</x-app-layout>
