@extends('layouts.public')

@section('title', $berita->judul)

@section('content')
<div class="bg-primary text-white py-4 mb-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.berita.index') }}" class="text-white-50 text-decoration-none">Berita Prestasi</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
            </ol>
        </nav>
        <h1 class="fw-bold">{{ $berita->judul }}</h1>
        <div class="d-flex align-items-center opacity-75 mt-3">
            <i class="fa-regular fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="{{ $berita->judul }}">
                    @endif
                    
                    <div class="article-content" style="line-height: 1.8; font-size: 1.1rem; color: #444;">
                        {!! nl2br(e($berita->konten)) !!}
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('public.berita.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Berita</a>
            </div>
        </div>
        
        <!-- Sidebar Berita Terbaru -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                    <h5 class="fw-bold mb-0 border-start border-primary border-4 ps-2">Berita Terkini Lainnya</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($recentBeritas as $recent)
                            <li class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <div class="text-muted small mb-1"><i class="fa-regular fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($recent->tanggal)->translatedFormat('d M Y') }}</div>
                                <a href="{{ route('public.berita.show', $recent->id) }}" class="text-dark fw-semibold text-decoration-none d-block hover-primary">{{ $recent->judul }}</a>
                            </li>
                        @empty
                            <li class="text-muted small">Belum ada berita lainnya.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-primary:hover { color: #0d6efd !important; }
</style>
@endsection
