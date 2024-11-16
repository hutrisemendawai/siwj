<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="class-schedule-add-container">
        <h1 class="class-schedule-add-title">Tambah Jadwal Kelas</h1>
        
        <form action="{{ route('jadwal-kelas.store') }}" method="POST" class="class-schedule-add-form">
            @csrf
            
            <div class="class-schedule-form-group">
                <label for="nama_mata_kuliah" class="class-schedule-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_mata_kuliah" id="nama_mata_kuliah" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="deskripsi" class="class-schedule-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="class-schedule-textarea" rows="3"></textarea>
            </div>

            <div class="class-schedule-form-group">
                <label for="dosen_pengajar_1" class="class-schedule-label">Dosen Pengajar Pertama</label>
                <input type="text" name="dosen_pengajar_1" id="dosen_pengajar_1" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="dosen_pengajar_2" class="class-schedule-label">Dosen Pengajar Kedua (Opsional)</label>
                <input type="text" name="dosen_pengajar_2" id="dosen_pengajar_2" class="class-schedule-input">
            </div>

            <div class="class-schedule-form-group">
                <label for="jumlah_sks" class="class-schedule-label">Jumlah SKS</label>
                <input type="number" name="jumlah_sks" id="jumlah_sks" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="ruangan" class="class-schedule-label">Ruangan</label>
                <input type="text" name="ruangan" id="ruangan" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="jam_mulai" class="class-schedule-label">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="jam_selesai" class="class-schedule-label">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="class-schedule-input" required>
            </div>

            <div class="class-schedule-form-group">
                <label for="hari" class="class-schedule-label">Hari</label>
                <select name="hari" id="hari" class="class-schedule-select" required>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <button type="submit" class="class-schedule-submit-button">Tambah Jadwal</button>
        </form>
    </div>
</x-app-layout>
