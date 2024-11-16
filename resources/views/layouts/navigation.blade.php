<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=person" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="{{ asset('img/logo_unsri.svg') }}" alt="Logo">
            </div>
            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <div class="dropdown">
                    <a href="#">Akademik</a>
                    <div class="submenu">
                        <a href="{{ route('galeri-akademik') }}">Galeri Kegiatan</a>
                        <a href="{{ route('panduan-akademik') }}">Panduan Akademik</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">Jadwal</a>
                    <div class="submenu">
                        <a href="{{ route('jadwal-kegiatan.index') }}">Jadwal Kegiatan</a>
                        <a href="{{ route('jadwal-kelas.index') }}">Jadwal Kelas</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#">Forum</a>
                    <div class="submenu">
                        <a href="{{ route('discussions.index') }}">Forum Diskusi</a>
                        <a href="{{ route('chat') }}">Forum Percakapan Umum</a>
                    </div>
                </div>
                <a href="{{ route('blog.index') }}">Sosial Media</a>
            </nav>
            <div class="icon-menu">
                <div class="account-dropdown">
                    <button class="account-icon"><span class="material-symbols-outlined">
                        person
                        </span></button>
                    <div class="account-submenu">
                        <a href="{{ route('profile.edit') }}">Edit Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>

