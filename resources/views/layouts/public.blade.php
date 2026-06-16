<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Prestasi Fakultas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            color: #0d6efd;
        }
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
            color: white;
            padding: 80px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
        }
        .main-content {
            flex: 1;
        }
        .footer {
            background-color: #212529;
            color: #adb5bd;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        .footer-heading {
            color: white;
            font-weight: 600;
            margin-bottom: 20px;
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
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="fa-solid fa-trophy text-warning me-2 fs-3"></i>
                <div>
                    SIPRES<br>
                    <span class="fs-6 text-secondary fw-normal">Sistem Peningkatan Prestasi</span>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.berita.*') ? 'active' : '' }}" href="{{ route('public.berita.index') }}">Berita Prestasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.lomba.*') ? 'active' : '' }}" href="{{ route('public.lomba.index') }}">Info Lomba</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.tentang') ? 'active' : '' }}" href="{{ route('public.tentang') }}">Tentang</a>
                    </li>
                </ul>
                <div class="d-flex gap-2 mt-3 mt-lg-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 rounded-pill">
                            <i class="fa-solid fa-gauge me-1"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 rounded-pill">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-primary px-4 rounded-pill">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="footer-heading d-flex align-items-center">
                        <i class="fa-solid fa-trophy text-warning me-2"></i> SIPRES Fakultas
                    </h5>
                    <p class="mb-3">Sistem Informasi Peningkatan Prestasi Mahasiswa Fakultas. Platform terpadu untuk pengajuan, bimbingan, dan pendataan prestasi lomba mahasiswa.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-secondary text-decoration-none fs-5 hover-white"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-secondary text-decoration-none fs-5 hover-white"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="text-secondary text-decoration-none fs-5 hover-white"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4">
                    <h6 class="footer-heading">Menu Pintas</h6>
                    <ul class="list-unstyled space-y-2">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none text-secondary hover-white">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('public.berita.index') }}" class="text-decoration-none text-secondary hover-white">Berita Prestasi</a></li>
                        <li class="mb-2"><a href="{{ route('public.lomba.index') }}" class="text-decoration-none text-secondary hover-white">Info Lomba</a></li>
                        <li class="mb-2"><a href="{{ route('public.tentang') }}" class="text-decoration-none text-secondary hover-white">Tentang</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-8">
                    <h6 class="footer-heading">Hubungi Kami</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex align-items-start">
                            <i class="fa-solid fa-location-dot mt-1 me-3 text-secondary"></i>
                            <span>Gedung Fakultas, Kampus Universitas<br>Jl. Pendidikan No. 123, Kota Pelajar</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="fa-solid fa-envelope me-3 text-secondary"></i>
                            <span>akademik@fakultas.ac.id</span>
                        </li>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="fa-solid fa-phone me-3 text-secondary"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="mt-5 mb-4 border-secondary">
            <div class="text-center small">
                &copy; {{ date('Y') }} Sistem Peningkatan Prestasi Fakultas. All rights reserved.
            </div>
        </div>
    </footer>

    <style>
        .hover-white:hover { color: white !important; }
    </style>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
