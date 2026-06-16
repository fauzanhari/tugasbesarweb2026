@extends('layouts.main')

@section('title', 'Riwayat Pengajuan Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-list-check me-2"></i> Riwayat Pengajuan Lomba
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Lomba</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-secondary"><i class="fa-solid fa-clock-rotate-left me-1"></i> Proposal Anda</h5>
                <a href="{{ route('mahasiswa.pengajuan.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Buat Pengajuan Baru
                </a>
            </div>
            <div class="card-body">
                @if($pengajuans->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-folder-open fa-4x mb-3 text-secondary opacity-50"></i>
                        <h5>Belum Ada Pengajuan Lomba</h5>
                        <p>Anda belum pernah mengajukan proposal lomba ke dosen manapun.</p>
                        <a href="{{ route('mahasiswa.pengajuan.create') }}" class="btn btn-primary mt-2">Mulai Buat Pengajuan</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="30%">Judul Lomba</th>
                                    <th width="20%">Dosen Pembimbing</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="15%" class="text-center">Tanggal</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $index => $pengajuan)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold text-primary">{{ $pengajuan->judul_lomba }}</td>
                                        <td>{{ $pengajuan->dosen->name }}</td>
                                        <td class="text-center">
                                            @if($pengajuan->status == 'Menunggu')
                                                <span class="badge bg-warning text-dark px-3 py-2"><i class="fa-solid fa-clock me-1"></i> Menunggu</span>
                                            @elseif($pengajuan->status == 'Revisi')
                                                <span class="badge bg-danger px-3 py-2"><i class="fa-solid fa-pen-to-square me-1"></i> Revisi</span>
                                            @elseif($pengajuan->status == 'ACC')
                                                <span class="badge bg-success px-3 py-2"><i class="fa-solid fa-check-double me-1"></i> Diterima (ACC)</span>
                                            @endif
                                        </td>
                                        <td class="text-center text-muted small">
                                            {{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('mahasiswa.pengajuan.show', $pengajuan->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-circle-info me-1"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
