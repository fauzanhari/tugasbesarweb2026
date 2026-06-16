<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Prestasi Fakultas')</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
        }
        .nav-link {
            font-weight: 500;
            color: #495057;
            transition: color 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important;
        }
        .card-hover {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar / Menu Atas -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="fa-solid fa-trophy text-warning me-2 fs-3"></i>
                <div>
                    SIPRES<br>
                    <span class="fs-6 text-secondary fw-normal">Sistem Peningkatan Prestasi</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Menu Kiri -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    @if(Auth::user()->role === 'mahasiswa')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.dosen.*') ? 'active' : '' }}" href="{{ route('mahasiswa.dosen.index') }}">
                            <i class="fa-solid fa-chalkboard-user me-1"></i> Cari Dosen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.pengajuan.*') ? 'active' : '' }}" href="{{ route('mahasiswa.pengajuan.index') }}">
                            <i class="fa-solid fa-list-check me-1"></i> Pengajuan Lomba
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->role === 'dosen')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.pengajuan.*') ? 'active' : '' }}" href="{{ route('dosen.pengajuan.index') }}">
                            <i class="fa-solid fa-inbox me-1"></i> Pengajuan Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dosen.bimbingan.*') ? 'active' : '' }}" href="{{ route('dosen.bimbingan.index') }}">
                            <i class="fa-solid fa-users me-1"></i> Mahasiswa Bimbingan
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-users me-1"></i> Manajemen User
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">
                            <i class="fa-solid fa-newspaper me-1"></i> Manajemen Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.infolomba.*') ? 'active' : '' }}" href="{{ route('admin.infolomba.index') }}">
                            <i class="fa-solid fa-bullhorn me-1"></i> Info Lomba
                        </a>
                    </li>
                    @endif
                </ul>

                <!-- Menu Kanan (Profil & Logout) -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fa-solid fa-id-badge me-2 text-primary"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa-solid fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama Halaman -->
    <main class="container my-5">
        @yield('content')
    </main>

    <!-- Bootstrap JS (untuk dropdown, modal, dll) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
