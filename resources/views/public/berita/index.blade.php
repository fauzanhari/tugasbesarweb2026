@extends('layouts.public')

@section('title', 'Berita Prestasi')

@section('content')
<div class="bg-primary text-white py-5 mb-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);">
    <div class="container text-center py-4">
        <h1 class="fw-bold display-5">Berita Prestasi Mahasiswa</h1>
        <p class="lead opacity-75 mb-0">Ikuti terus kabar terbaru capaian luar biasa mahasiswa fakultas kita di berbagai ajang kompetisi.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse($beritas as $berita)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm card-hover h-100">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="text-muted small mb-2">
                        <i class="fa-regular fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </div>
                    <h5 class="card-title fw-bold mb-3">
                        <a href="{{ route('public.berita.show', $berita->id) }}" class="text-dark text-decoration-none stretched-link">{{ $berita->judul }}</a>
                    </h5>
                    <p class="card-text text-secondary flex-grow-1">{{ Str::limit(strip_tags($berita->konten), 120) }}</p>
                    <div class="mt-3 text-primary fw-semibold small">Baca selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fa-regular fa-folder-open text-muted fs-1 mb-3"></i>
            <h4 class="text-secondary fw-bold">Belum Ada Berita</h4>
            <p class="text-muted">Saat ini belum ada berita prestasi yang dipublikasikan.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $beritas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
