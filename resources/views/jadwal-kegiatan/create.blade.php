<x-app-layout>
    <div class="activity-schedule-container">
        <h2 class="activity-schedule-title">Jadwal Kegiatan</h2>
        <p class="activity-schedule-subtitle">Tambah Jadwal Kegiatan</p>

        <form action="{{ route('jadwal-kegiatan.store') }}" method="POST" class="activity-schedule-form">
            @csrf
            <div class="activity-schedule-form-group">
                <label class="activity-schedule-label">Nama Kegiatan</label>
                <input type="text" name="title" class="activity-schedule-input" required>
            </div>
            <div class="activity-schedule-form-group">
                <label class="activity-schedule-label">Deskripsi</label>
                <textarea name="description" class="activity-schedule-textarea" required></textarea>
            </div>
            <div class="activity-schedule-form-group">
                <label class="activity-schedule-label">Tanggal</label>
                <input type="date" name="date" class="activity-schedule-input" required>
            </div>
            <div class="activity-schedule-form-group">
                <label class="activity-schedule-label">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" class="activity-schedule-input" required placeholder="Contoh: 2024/2025">
            </div>
            <button type="submit" class="activity-schedule-submit-btn">Tambah</button>
        </form>
    </div>
</x-app-layout>
