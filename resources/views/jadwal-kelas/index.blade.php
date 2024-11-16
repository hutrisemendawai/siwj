<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="class-schedule-container">
        <h1 class="class-schedule-title">Jadwal Kelas Perkuliahan</h1>
        <p class="class-schedule-subtitle">Jadwal Perkuliahan Hari <strong>{{ $hari ?? 'Semua Hari' }}</strong></p>

        <!-- Search and Filter -->
        <form action="{{ route('jadwal-kelas.index') }}" method="GET" class="class-schedule-search-form">
            <input type="text" name="search" class="class-schedule-search-input" placeholder="Cari Mata Kuliah atau Dosen" value="{{ request('search') }}">
            <button type="submit" class="class-schedule-search-button">Search</button>
        </form>

        <!-- Tabs for Days -->
        <div class="class-schedule-days">
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $day)
                <a href="{{ route('jadwal-kelas.showByDay', $day) }}" class="class-schedule-day-link {{ isset($hari) && $hari == $day ? 'active' : '' }}">{{ $day }}</a>
            @endforeach
        </div>

        <!-- Create Button for Admin -->
        @if(auth()->user()->role === 'admin')
            <div class="class-schedule-create">
                <a href="{{ route('jadwal-kelas.create') }}" class="class-schedule-add-button">+</a>
            </div>
        @endif

        <!-- Schedule Table -->
        <table class="class-schedule-table">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Dosen Pengajar</th>
                    <th>SKS</th>
                    <th>Ruangan</th>
                    <th>Jam</th>
                    @if(auth()->user()->role === 'admin')
                        <th>Ubah</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwalKelas as $jadwal)
                    <tr>
                        <td class="class-schedule-course">
                            <span class="class-schedule-color" style="background-color: {{ $jadwal->color }};"></span>
                            {{ $jadwal->nama_mata_kuliah }}
                            <p class="class-schedule-description">{{ $jadwal->deskripsi }}</p>
                        </td>
                        <td class="class-schedule-lecturer">{{ $jadwal->dosen_pengajar_1 }} {{ $jadwal->dosen_pengajar_2 ? ' & ' . $jadwal->dosen_pengajar_2 : '' }}</td>
                        <td class="class-schedule-sks">{{ $jadwal->jumlah_sks }} SKS</td>
                        <td class="class-schedule-room">{{ $jadwal->ruangan }}</td>
                        <td class="class-schedule-time">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                        
                        <!-- Edit Button for Admin -->
                        @if(auth()->user()->role === 'admin')
                            <td class="class-schedule-edit">
                                <a href="{{ route('jadwal-kelas.edit', $jadwal->id) }}" class="class-schedule-edit-button">Edit</a>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? '6' : '5' }}" class="class-schedule-no-data">Tidak ada jadwal untuk hari ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
