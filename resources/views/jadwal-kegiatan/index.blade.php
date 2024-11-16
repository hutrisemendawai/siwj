<link rel="stylesheet" href="css/style.css">
<x-app-layout>
    <div class="schedule-container">
        <h2 class="schedule-title">Jadwal Kegiatan Perkuliahan</h2>
        <p class="schedule-subtitle">Jadwal Kegiatan Tahun Ajaran 2024/2025</p>

        <div class="schedule-filter">
            <select class="schedule-select">
                <option>Pilih Tahun Ajaran</option>
                @foreach($jadwalKegiatans->pluck('tahun_ajaran')->unique() as $tahunAjaran)
                    <option>{{ $tahunAjaran }}</option>
                @endforeach
            </select>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('jadwal-kegiatan.create') }}" class="schedule-add-btn">+</a>
            @endif
        </div>

        <div class="schedule-list">
            @foreach($jadwalKegiatans as $kegiatan)
                <div class="schedule-item">
                    <div class="schedule-color-indicator"></div>
                    <div class="schedule-item-content">
                        <h3 class="schedule-item-title">{{ $kegiatan->title }}</h3>
                        <p class="schedule-item-description">{{ $kegiatan->description }}</p>
                    </div>
                    <div class="schedule-item-info">
                        <p class="schedule-item-date">{{ \Carbon\Carbon::parse($kegiatan->date)->translatedFormat('d F Y') }}</p>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('jadwal-kegiatan.edit', $kegiatan) }}" class="schedule-edit-btn">Ubah</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
