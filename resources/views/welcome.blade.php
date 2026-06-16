<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peningkatan Prestasi Fakultas</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icon CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Sedikit penyesuaian custom agar tampilan tidak terlalu kaku */
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        }
    </style>
</head>
<body>

    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="/">PRESTASI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="btn btn-primary text-white px-4 ms-2 mt-1" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="{{ route('login') }}">Masuk</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary text-white px-4 ms-2 mt-1" href="{{ route('register') }}">Daftar</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold text-dark mb-4">Matchmaking<br>Kompetisi & Dosen</h1>
            <p class="lead text-secondary mb-5 mx-auto" style="max-width: 600px;">
                Wujudkan mimpimu meraih juara! Temukan dosen pembimbing yang tepat sesuai bidang perlombaanmu, ajukan proposal, dan dapatkan bimbingan secara digital tanpa ribet.
            </p>
            <a href="#fitur" class="btn btn-primary btn-lg shadow-sm px-5 rounded-pill">Mulai Sekarang</a>
        </div>
    </section>

    <!-- Fitur Section dengan Sistem Grid Bootstrap -->
    <section id="fitur" class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Mengapa Menggunakan Platform Ini?</h2>
            
            <div class="row g-4 text-center">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="card-body">
                            <i class="fa-solid fa-rocket fa-3x text-primary mb-3"></i>
                            <h5 class="card-title fw-bold">Lebih Cepat & Efisien</h5>
                            <p class="card-text text-muted">Tidak perlu lagi mencari dosen dari ruangan ke ruangan. Cari berdasarkan keahlian dan ajukan proposal perlombaanmu dari mana saja.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="card-body">
                            <i class="fa-solid fa-pen-to-square fa-3x text-success mb-3"></i>
                            <h5 class="card-title fw-bold">Revisi Terpantau</h5>
                            <p class="card-text text-muted">Dapatkan masukan dan catatan revisi langsung dari dosen pembimbing di dalam sistem. Tidak ada lagi dokumen fisik yang tercecer.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="card-body">
                            <i class="fa-solid fa-trophy fa-3x text-warning mb-3"></i>
                            <h5 class="card-title fw-bold">Wall of Fame</h5>
                            <p class="card-text text-muted">Setiap kemenangan dan prestasi yang kamu raih akan dipublikasikan di portal berita fakultas sebagai kebanggaan bersama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Bootstrap -->
    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sistem Peningkatan Prestasi Fakultas. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS CDN (diperlukan untuk fungsi toggle navbar mobile dll) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
