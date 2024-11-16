<x-app-layout>
    <div class="jadwal-kelas-container">
        <h1>Jadwal Kelas Hari {{ $hari }}</h1>

        <!-- Back to All Days -->
        <a href="{{ route('jadwal-kelas.index') }}">Kembali ke Semua Jadwal</a>

        <!-- Schedule Table -->
        <table class="jadwal-kelas-table">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Dosen Pengajar</th>
                    <th>SKS</th>
                    <th>Ruangan</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalKelas as $jadwal)
                    <tr>
                        <td>
                            <span class="jadwal-kelas-color" style="background-color: {{ $jadwal->color }};"></span>
                            {{ $jadwal->nama_mata_kuliah }}
                            <p>{{ $jadwal->deskripsi }}</p>
                        </td>
                        <td>{{ $jadwal->dosen_pengajar_1 }}{{ $jadwal->dosen_pengajar_2 ? ' & ' . $jadwal->dosen_pengajar_2 : '' }}</td>
                        <td>{{ $jadwal->jumlah_sks }} SKS</td>
                        <td>{{ $jadwal->ruangan }}</td>
                        <td>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada jadwal untuk hari {{ $hari }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
