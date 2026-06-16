@extends('layouts.public')

@section('title', 'Info Lomba')

@section('content')
<div class="bg-primary text-white py-5 mb-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);">
    <div class="container text-center py-4">
        <h1 class="fw-bold display-5">Pengumuman Lomba & Kompetisi</h1>
        <p class="lead opacity-75 mb-0">Temukan berbagai ajang kompetisi yang dapat Anda ikuti untuk mengasah kemampuan dan meraih prestasi.</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row g-4">
        @forelse($lombas as $lomba)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm card-hover h-100 border-top border-4 {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'border-success' : 'border-danger' }}">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="badge {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'bg-success' : 'bg-danger' }}">
                            {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'Aktif' : 'Tutup' }}
                        </div>
                        <div class="small fw-bold text-muted">
                            <i class="fa-regular fa-clock me-1"></i> Batas: {{ \Carbon\Carbon::parse($lomba->tanggal_batas)->translatedFormat('d M Y') }}
                        </div>
                    </div>
                    <h5 class="card-title fw-bold mb-2">
                        <a href="{{ route('public.lomba.show', $lomba->id) }}" class="text-dark text-decoration-none stretched-link">{{ $lomba->judul }}</a>
                    </h5>
                    <p class="text-secondary small mb-3"><i class="fa-solid fa-building me-1"></i> {{ $lomba->penyelenggara }}</p>
                    <p class="card-text text-secondary flex-grow-1">{{ Str::limit(strip_tags($lomba->deskripsi), 100) }}</p>
                    
                    <div class="mt-3 text-primary fw-semibold small">Lihat Syarat & Ketentuan <i class="fa-solid fa-arrow-right ms-1"></i></div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fa-solid fa-calendar-xmark text-muted fs-1 mb-3"></i>
            <h4 class="text-secondary fw-bold">Belum Ada Info Lomba</h4>
            <p class="text-muted">Saat ini belum ada pengumuman lomba atau kompetisi yang aktif.</p>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $lombas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
