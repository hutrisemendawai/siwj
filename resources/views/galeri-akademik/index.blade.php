<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<x-app-layout>
    <div class="galeri-container">
        <h1>Galeri Akademik</h1>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('gaposts.create') }}" class="btn btn-primary galeri-create-button">Create Gapost</a>
        @endif

        @foreach($gaposts as $gapost)
            <div class="galeri-post-card">
                <div class="galeri-post-header">
                    <h2>Galeri Akademik</h2>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('gaposts.edit', $gapost) }}" class="galeri-edit-btn">
                            <img src="{{ asset('img/edit-icon.svg') }}" alt="Edit">
                        </a>
                    @endif
                </div>
                
                <div class="galeri-post-image">
                    <img src="{{ asset('storage/' . $gapost->image) }}" alt="{{ $gapost->title }}">
                </div>
                
                <div class="galeri-post-content">
                    <h3>{{ $gapost->title }}</h3>
                    <p>{{ Str::limit($gapost->content, 100) }}</p>
                    <p class="galeri-author-info">Ditulis oleh: {{ $gapost->user->name }} pada {{ $gapost->created_at->format('d M Y') }}</p>
                    <a href="{{ route('gaposts.show', $gapost) }}" class="galeri-read-more-btn">Baca selengkapnya</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
