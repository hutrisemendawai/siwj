<x-app-layout>
    <div class="gallery-detail-container">
        <h1 class="gallery-detail-title">{{ $gapost->title }}</h1>
        
        <div class="gallery-detail-image-container">
            <img src="{{ asset('storage/' . $gapost->image) }}" alt="{{ $gapost->title }}" class="gallery-detail-image">
        </div>

        <div class="gallery-detail-content">
            <p class="gallery-detail-text">{{ $gapost->content }}</p>
        </div>
        
        <div class="gallery-detail-footer">
            <p class="gallery-detail-author">
                Ditulis oleh: {{ $gapost->user->name }} pada {{ $gapost->created_at->format('d M Y') }}
            </p>
        </div>
    </div>
</x-app-layout>
