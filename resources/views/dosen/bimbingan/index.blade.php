@extends('layouts.main')

@section('title', 'Daftar Mahasiswa Bimbingan')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-users me-2"></i> Mahasiswa Bimbingan
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mahasiswa Bimbingan</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3 pb-2">
                <p class="text-muted mb-0">
                    <i class="fa-solid fa-info-circle me-1 text-primary"></i>
                    Berikut adalah daftar mahasiswa yang proposal lombanya telah Anda setujui (ACC).
                </p>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle border">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="25%">Nama Mahasiswa</th>
                                <th width="35%">Judul Lomba</th>
                                <th width="20%">Tanggal Disetujui</th>
                                <th width="15%" class="text-center">Proposal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bimbingans as $index => $bimbingan)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                                                <span class="fw-bold">{{ substr($bimbingan->mahasiswa->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $bimbingan->mahasiswa->name }}</h6>
                                                <small class="text-muted">{{ $bimbingan->mahasiswa->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-dark">{{ $bimbingan->judul_lomba }}</td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1">
                                            <i class="fa-solid fa-calendar-check me-1"></i>
                                            {{ \Carbon\Carbon::parse($bimbingan->updated_at)->format('d M Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('dosen.bimbingan.show', $bimbingan->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa-solid fa-chart-line me-1"></i> Pantau Progress
                                            </a>
                                            <a href="{{ asset('storage/' . $bimbingan->file_proposal) }}" target="_blank" class="btn btn-sm btn-outline-danger" title="Buka File Proposal PDF">
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fa-solid fa-folder-open text-muted fa-3x mb-3 opacity-25"></i>
                                        <h5 class="text-muted">Belum ada mahasiswa bimbingan</h5>
                                        <p class="text-muted mb-0">Anda belum menyetujui (ACC) proposal mahasiswa satupun.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
