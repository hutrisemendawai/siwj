<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="activity-edit-container">
        <h2 class="activity-edit-title">Jadwal Kegiatan</h2>
        <p class="activity-edit-subtitle">Tambah Jadwal Kegiatan</p>

        <form action="{{ route('jadwal-kegiatan.update', $jadwalKegiatan->id) }}" method="POST" class="activity-edit-form">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="activity-edit-form-group">
                <label for="title" class="activity-edit-label">Nama Kegiatan</label>
                <input type="text" name="title" id="title" class="activity-edit-input" value="{{ $jadwalKegiatan->title }}" required>
            </div>

            <!-- Description -->
            <div class="activity-edit-form-group">
                <label for="description" class="activity-edit-label">Deskripsi</label>
                <textarea name="description" id="description" class="activity-edit-textarea" required>{{ $jadwalKegiatan->description }}</textarea>
            </div>

            <!-- Date -->
            <div class="activity-edit-form-group">
                <label for="date" class="activity-edit-label">Tanggal</label>
                <input type="date" name="date" id="date" class="activity-edit-input" value="{{ \Carbon\Carbon::parse($jadwalKegiatan->date)->format('Y-m-d') }}" required>
            </div>

            <!-- Academic Year -->
            <div class="activity-edit-form-group">
                <label for="tahun_ajaran" class="activity-edit-label">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="activity-edit-input" value="{{ $jadwalKegiatan->tahun_ajaran }}" required>
            </div>

            <!-- Buttons -->
            <div class="activity-edit-buttons">
                <button type="submit" class="activity-edit-submit-btn">Ubah</button>
                <a href="{{ route('jadwal-kegiatan.destroy', $jadwalKegiatan->id) }}" class="activity-edit-delete-btn" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus jadwal ini?')) document.getElementById('delete-form').submit();">
                    <img src="{{ asset('images/delete-icon.png') }}" alt="Delete" class="activity-edit-delete-icon">
                </a>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('jadwal-kegiatan.destroy', $jadwalKegiatan->id) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-app-layout>
