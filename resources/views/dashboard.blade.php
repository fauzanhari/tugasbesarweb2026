@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Kolom Utama -->
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h4 class="mb-0 text-primary"><i class="fa-solid fa-hand-wave me-2"></i> Selamat Datang!</h4>
            </div>
            <div class="card-body py-4">
                <p class="fs-5 text-secondary">
                    Halo <strong>{{ Auth::user()->name }}</strong>, Anda berhasil login ke Sistem Prestasi Fakultas. Anda terdaftar sebagai <span class="badge bg-success"><i class="fa-solid fa-user-shield me-1"></i> {{ ucfirst(Auth::user()->role) }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role === 'admin' && isset($stats))
<!-- Section Statistik Khusus Admin -->
<div class="row mb-4">
    <div class="col-12 mb-2">
        <h4 class="text-dark fw-bold border-bottom pb-2">
            <i class="fa-solid fa-chart-pie text-info me-2"></i> Ringkasan Statistik
        </h4>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="fs-1 opacity-50 me-3"><i class="fa-solid fa-user-graduate"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_mahasiswa'] }}</h3>
                    <p class="mb-0 small text-uppercase">Total Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm bg-success text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="fs-1 opacity-50 me-3"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_dosen'] }}</h3>
                    <p class="mb-0 small text-uppercase">Total Dosen</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm bg-warning text-dark h-100">
            <div class="card-body d-flex align-items-center">
                <div class="fs-1 opacity-50 me-3"><i class="fa-solid fa-file-signature"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $stats['total_proposal'] }}</h3>
                    <p class="mb-0 small text-uppercase">Total Proposal</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm bg-danger text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="fs-1 opacity-50 me-3"><i class="fa-solid fa-medal"></i></div>
                <div>
                    <h3 class="mb-0 fw-bold">{{ $stats['proposal_acc'] }}</h3>
                    <p class="mb-0 small text-uppercase">Proposal Di-ACC</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Section Berita Prestasi & Info Lomba -->
<div class="row">
    <!-- Kolom Kiri: Berita Prestasi -->
    <div class="col-lg-8 mb-4">
        <h4 class="text-dark fw-bold border-bottom pb-2 mb-3">
            <i class="fa-solid fa-trophy text-warning me-2"></i> Berita & Prestasi Terbaru
        </h4>
        <div class="row g-4">
            @forelse($beritas as $berita)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm card-hover h-100 cursor-pointer" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $berita->id }}">
                        <div class="card-body p-4">
                            <div class="text-muted small mb-2">
                                <i class="fa-regular fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-3">{{ $berita->judul }}</h5>
                            <p class="card-text text-secondary mb-0">
                                {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 100) }}
                            </p>
                            <div class="mt-3 text-primary fw-semibold small">Baca selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i></div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detail Berita -->
                <div class="modal fade" id="beritaModal{{ $berita->id }}" tabindex="-1" aria-labelledby="beritaModalLabel{{ $berita->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title fw-bold text-primary" id="beritaModalLabel{{ $berita->id }}">{{ $berita->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pt-2">
                                <p class="text-muted small mb-4 border-bottom pb-2">
                                    <i class="fa-solid fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') }}
                                </p>
                                <p class="text-dark" style="white-space: pre-wrap;">{{ $berita->konten }}</p>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light text-center py-4 border text-muted">
                        <i class="fa-solid fa-newspaper fa-3x mb-2 text-secondary opacity-50"></i>
                        <p class="mb-0">Belum ada berita prestasi yang diterbitkan saat ini.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Kolom Kanan: Papan Info Lomba -->
    <div class="col-lg-4 mb-4">
        <h4 class="text-dark fw-bold border-bottom pb-2 mb-3">
            <i class="fa-solid fa-bullhorn text-danger me-2"></i> Info Lomba Terkini
        </h4>
        
        <div class="row g-3">
            @forelse($infolombas ?? [] as $lomba)
                <div class="col-12">
                    <div class="card border-0 shadow-sm card-hover h-100 border-start border-4 {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'border-success' : 'border-danger' }}">
                        <div class="card-body p-3">
                            <h6 class="fw-bold text-dark mb-1">
                                {{ $lomba->judul }}
                                @if($lomba->link_pendaftaran)
                                    <a href="{{ $lomba->link_pendaftaran }}" target="_blank" class="text-danger ms-1" title="Kunjungi Website Pendaftaran"><i class="fa-solid fa-external-link-alt small"></i></a>
                                @endif
                            </h6>
                            @if($lomba->penyelenggara)
                                <p class="text-muted small mb-2"><i class="fa-solid fa-building me-1"></i> {{ $lomba->penyelenggara }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div class="small fw-semibold text-muted">Batas Waktu:</div>
                                @if($lomba->tanggal_batas)
                                    <span class="badge {{ $lomba->tanggal_batas >= date('Y-m-d') ? 'bg-success' : 'bg-danger' }}">
                                        {{ \Carbon\Carbon::parse($lomba->tanggal_batas)->translatedFormat('d M Y') }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted">Tanpa Batas</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted border rounded bg-white">
                    <i class="fa-solid fa-folder-open fa-2x mb-2 opacity-25"></i>
                    <p class="mb-0 small">Belum ada info lomba baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
