@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fs-6">Sistem Informasi Resmi</span>
                <h1 class="display-4 fw-bold mb-4">Tingkatkan Prestasimu,<br>Harumkan Nama Fakultas</h1>
                <p class="lead mb-4 opacity-75">Platform terintegrasi untuk menemukan info lomba terbaru, mengajukan proposal bimbingan dosen, dan mendata seluruh capaian prestasi mahasiswa secara digital.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg text-primary fw-bold px-4 rounded-pill">Mulai Sekarang</a>
                    <a href="{{ route('public.lomba.index') }}" class="btn btn-outline-light btn-lg px-4 rounded-pill">Lihat Lomba</a>
                </div>
            </div>
            <div class="col-lg-5 text-center d-none d-lg-block">
                <!-- Ilustrasi SVG Sederhana -->
                <i class="fa-solid fa-graduation-cap text-white" style="font-size: 15rem; opacity: 0.9; text-shadow: 0 10px 30px rgba(0,0,0,0.2);"></i>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-white mb-5">
    <div class="container">
        <div class="row text-center g-4 justify-content-center">
            <div class="col-md-4 col-sm-6">
                <div class="p-4 rounded bg-light border-bottom border-primary border-4 h-100">
                    <i class="fa-solid fa-users text-primary fs-1 mb-3"></i>
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_mahasiswa'] }}</h2>
                    <p class="text-secondary mb-0">Mahasiswa</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="p-4 rounded bg-light border-bottom border-success border-4 h-100">
                    <i class="fa-solid fa-chalkboard-user text-success fs-1 mb-3"></i>
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_dosen'] }}</h2>
                    <p class="text-secondary mb-0">Dosen Pembimbing</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="p-4 rounded bg-light border-bottom border-danger border-4 h-100">
                    <i class="fa-solid fa-bullhorn text-danger fs-1 mb-3"></i>
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_lomba_aktif'] }}</h2>
                    <p class="text-secondary mb-0">Lomba Aktif</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row g-5">
        <!-- Berita Terbaru -->
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                <h3 class="fw-bold mb-0"><i class="fa-solid fa-newspaper text-primary me-2"></i> Berita Prestasi</h3>
                <a href="{{ route('public.berita.index') }}" class="text-decoration-none fw-semibold">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row g-4">
                @forelse($beritas as $berita)
                <div class="col-12">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">
                                <i class="fa-regular fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                            </div>
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('public.berita.show', $berita->id) }}" class="text-dark text-decoration-none stretched-link">{{ $berita->judul }}</a>
                            </h5>
                            <p class="card-text text-secondary mb-0">{{ Str::limit(strip_tags($berita->konten), 100) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-regular fa-folder-open text-muted fs-1 mb-3"></i>
                    <p class="text-muted">Belum ada berita prestasi yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Info Lomba Terbaru -->
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                <h3 class="fw-bold mb-0"><i class="fa-solid fa-bullhorn text-danger me-2"></i> Info Lomba Terkini</h3>
                <a href="{{ route('public.lomba.index') }}" class="text-decoration-none fw-semibold">Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
            
            <div class="row g-4">
                @forelse($infolombas as $lomba)
                <div class="col-12">
                    <div class="card border-0 shadow-sm card-hover h-100 border-start border-4 {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'border-success' : 'border-danger' }}">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title fw-bold mb-1">
                                    <a href="{{ route('public.lomba.show', $lomba->id) }}" class="text-dark text-decoration-none stretched-link">{{ $lomba->judul }}</a>
                                </h5>
                                <div class="text-secondary small">
                                    <i class="fa-solid fa-building me-1"></i> {{ $lomba->penyelenggara }}
                                </div>
                            </div>
                            <div class="text-end ms-3">
                                <div class="small fw-semibold text-muted mb-1">Batas Waktu:</div>
                                <span class="badge {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'bg-success' : 'bg-danger' }}">
                                    {{ \Carbon\Carbon::parse($lomba->tanggal_batas)->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-calendar-xmark text-muted fs-1 mb-3"></i>
                    <p class="text-muted">Belum ada informasi lomba saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
