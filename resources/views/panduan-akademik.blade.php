<x-app-layout>
    <div class="panduan-container">
        <!-- Header Section -->
        <div class="panduan-header">
            <h1>Panduan Akademik</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in hendrerit urna. Pellentesque sit amet sapien.</p>
        </div>

        <!-- Content Grid -->
        <div class="panduan-content-grid">
            <!-- First Container: Prosedur Tugas Akhir -->
            <div class="panduan-content-item">
                <h2>Prosedur Tugas Akhir</h2>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Mulai dari mana?</button>
                    <div class="panduan-dropdown-content">Content for "Mulai dari mana?"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Persyaratan</button>
                    <div class="panduan-dropdown-content">Content for "Persyaratan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Tanggal Kegiatan</button>
                    <div class="panduan-dropdown-content">Content for "Tanggal Kegiatan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Buku Prosedur</button>
                    <div class="panduan-dropdown-content">Content for "Buku Prosedur"</div>
                </div>
            </div>
            
            <div class="panduan-content-item">
                <h2>Prosedur Tugas Akhir</h2>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Mulai dari mana?</button>
                    <div class="panduan-dropdown-content">Content for "Mulai dari mana?"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Persyaratan</button>
                    <div class="panduan-dropdown-content">Content for "Persyaratan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Tanggal Kegiatan</button>
                    <div class="panduan-dropdown-content">Content for "Tanggal Kegiatan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Buku Prosedur</button>
                    <div class="panduan-dropdown-content">Content for "Buku Prosedur"</div>
                </div>
            </div>

            <div class="panduan-content-item">
                <h2>Prosedur Tugas Akhir</h2>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Mulai dari mana?</button>
                    <div class="panduan-dropdown-content">Content for "Mulai dari mana?"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Persyaratan</button>
                    <div class="panduan-dropdown-content">Content for "Persyaratan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Tanggal Kegiatan</button>
                    <div class="panduan-dropdown-content">Content for "Tanggal Kegiatan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Buku Prosedur</button>
                    <div class="panduan-dropdown-content">Content for "Buku Prosedur"</div>
                </div>
            </div>

            <div class="panduan-content-item">
                <h2>Prosedur Tugas Akhir</h2>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Mulai dari mana?</button>
                    <div class="panduan-dropdown-content">Content for "Mulai dari mana?"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Persyaratan</button>
                    <div class="panduan-dropdown-content">Content for "Persyaratan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Tanggal Kegiatan</button>
                    <div class="panduan-dropdown-content">Content for "Tanggal Kegiatan"</div>
                </div>
                <div class="panduan-dropdown">
                    <button class="panduan-dropdown-toggle">Buku Prosedur</button>
                    <div class="panduan-dropdown-content">Content for "Buku Prosedur"</div>
                </div>
            </div>  
            <!-- Additional sections as required... -->
            <!-- Repeat the structure below for each content item as necessary -->

        </div>
    </div>
</x-app-layout>

<script>
    document.querySelectorAll('.panduan-dropdown-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            button.classList.toggle('active');
            content.style.display = content.style.display === "block" ? "none" : "block";
        });
    });
</script>