<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="class-schedule-edit-container">
        <h1 class="class-schedule-edit-title">Jadwal Kelas Perkuliahan</h1>
        <p class="class-schedule-edit-subtitle">Jadwal Perkuliahan Hari <strong>{{ $jadwalKelas->hari }}</strong></p>
        
        <!-- Delete Button -->
        <form action="{{ route('jadwal-kelas.destroy', $jadwalKelas->id) }}" method="POST" class="class-schedule-delete-form" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="class-schedule-delete-button">🗑️</button>
        </form>

        <!-- Edit Form -->
        <form action="{{ route('jadwal-kelas.update', $jadwalKelas->id) }}" method="POST" class="class-schedule-edit-form">
            @csrf
            @method('PUT')
            
            <div class="class-schedule-form-group">
                <label for="nama_mata_kuliah" class="class-schedule-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="class-schedule-input" value="{{ $jadwalKelas->nama_mata_kuliah }}" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="deskripsi" class="class-schedule-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="class-schedule-textarea" rows="3">{{ $jadwalKelas->deskripsi }}</textarea>
            </div>

            <div class="class-schedule-form-group">
                <label for="dosen_pengajar_1" class="class-schedule-label">Dosen Pengajar Pertama</label>
                <input type="text" name="dosen_pengajar_1" id="dosen_pengajar_1" class="class-schedule-input" value="{{ $jadwalKelas->dosen_pengajar_1 }}" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="dosen_pengajar_2" class="class-schedule-label">Dosen Pengajar Kedua (Opsional)</label>
                <input type="text" name="dosen_pengajar_2" id="dosen_pengajar_2" class="class-schedule-input" value="{{ $jadwalKelas->dosen_pengajar_2 }}">
            </div>

            <div class="class-schedule-form-group">
                <label for="jumlah_sks" class="class-schedule-label">Total SKS</label>
                <input type="number" name="jumlah_sks" id="jumlah_sks" class="class-schedule-input" value="{{ $jadwalKelas->jumlah_sks }}" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="ruangan" class="class-schedule-label">Ruangan</label>
                <input type="text" name="ruangan" id="ruangan" class="class-schedule-input" value="{{ $jadwalKelas->ruangan }}" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="jam_mulai" class="class-schedule-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="class-schedule-input" value="{{ $jadwalKelas->jam_mulai }}" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="hari" class="class-schedule-label">Hari</label>
                <select name="hari" id="hari" class="class-schedule-select" required>
                    <option value="Senin" {{ $jadwalKelas->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $jadwalKelas->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $jadwalKelas->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $jadwalKelas->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $jadwalKelas->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                </select>
            </div>

            <button type="submit" class="class-schedule-save-button">Simpan</button>
        </form>
    </div>
</x-app-layout>
