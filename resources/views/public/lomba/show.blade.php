@extends('layouts.public')

@section('title', $lomba->judul)

@section('content')
<div class="bg-primary text-white py-4 mb-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);">
    <div class="container py-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('public.lomba.index') }}" class="text-white-50 text-decoration-none">Info Lomba</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
            </ol>
        </nav>
        <h1 class="fw-bold">{{ $lomba->judul }}</h1>
        <div class="d-flex align-items-center opacity-75 mt-3">
            <i class="fa-solid fa-building me-2"></i> {{ $lomba->penyelenggara }}
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h4 class="fw-bold border-bottom pb-3 mb-4">Deskripsi Lomba</h4>
                    
                    <div class="article-content mb-5" style="line-height: 1.8; font-size: 1.1rem; color: #444;">
                        {!! nl2br(e($lomba->deskripsi)) !!}
                    </div>

                    @if($lomba->tanggal_batas >= date('Y-m-d'))
                        <div class="alert alert-info border-info border-start border-4 bg-light d-flex align-items-center mb-4">
                            <i class="fa-solid fa-circle-info fs-3 text-info me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Tertarik mengikuti lomba ini?</h6>
                                <p class="mb-0 small">Segera buat Pengajuan Proposal di dashboard mahasiswa Anda agar dapat dibimbing oleh Dosen yang ahli di bidangnya!</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('public.lomba.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Lomba</a>
            </div>
        </div>
        
        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                    <h5 class="fw-bold mb-0 border-start border-primary border-4 ps-2">Informasi Penting</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Status Pendaftaran</div>
                                @if($lomba->tanggal_batas >= date('Y-m-d'))
                                    <span class="fw-bold text-success"><i class="fa-solid fa-check-circle me-1"></i> Buka</span>
                                @else
                                    <span class="fw-bold text-danger"><i class="fa-solid fa-times-circle me-1"></i> Tutup</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item px-0 py-3">
                            <div class="text-muted small mb-1">Batas Waktu</div>
                            <div class="fw-bold text-dark"><i class="fa-regular fa-calendar-xmark text-danger me-2"></i> {{ \Carbon\Carbon::parse($lomba->tanggal_batas)->translatedFormat('d F Y') }}</div>
                        </li>
                        <li class="list-group-item px-0 py-3">
                            <div class="text-muted small mb-1">Penyelenggara</div>
                            <div class="fw-bold text-dark"><i class="fa-solid fa-building text-primary me-2"></i> {{ $lomba->penyelenggara }}</div>
                        </li>
                    </ul>

                    @if($lomba->link_pendaftaran)
                        <div class="d-grid gap-2">
                            <a href="{{ $lomba->link_pendaftaran }}" target="_blank" class="btn btn-primary fw-bold">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Kunjungi Web Penyelenggara
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
