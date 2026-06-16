@extends('layouts.main')

@section('title', 'Detail Pengajuan Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-file-contract me-2"></i> Detail Pengajuan Proposal
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.pengajuan.index') }}" class="text-decoration-none">Pengajuan Lomba</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
    <!-- Kolom Kiri: Informasi Proposal -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white pt-3 pb-2">
                <h5 class="mb-0"><i class="fa-solid fa-info-circle me-2 text-primary"></i> Status & Informasi</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless mb-4">
                    <tr>
                        <td width="35%" class="text-muted fw-bold">Judul Lomba</td>
                        <td width="5%">:</td>
                        <td class="text-dark">{{ $pengajuan->judul_lomba }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">Dosen Pembimbing</td>
                        <td>:</td>
                        <td class="text-dark">{{ $pengajuan->dosen->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">Tanggal Diajukan</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted fw-bold">Status Terakhir</td>
                        <td>:</td>
                        <td>
                            @if($pengajuan->status == 'Menunggu')
                                <span class="badge bg-warning text-dark px-3 py-2"><i class="fa-solid fa-clock me-1"></i> Sedang Diproses Dosen</span>
                            @elseif($pengajuan->status == 'Revisi')
                                <span class="badge bg-danger px-3 py-2"><i class="fa-solid fa-pen-to-square me-1"></i> Perlu Direvisi</span>
                            @elseif($pengajuan->status == 'ACC')
                                <span class="badge bg-success px-3 py-2"><i class="fa-solid fa-check-double me-1"></i> Disetujui (ACC)</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="d-grid gap-2">
                    <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}" target="_blank" class="btn btn-outline-danger">
                        <i class="fa-solid fa-file-pdf me-2"></i> Buka PDF Proposal Saat Ini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Catatan Dosen & Form Revisi -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0 h-100 {{ $pengajuan->status == 'Revisi' ? 'border-danger border-2' : '' }}">
            <div class="card-header bg-white pt-3 pb-2">
                <h5 class="mb-0">
                    <i class="fa-solid fa-comment-dots me-2 text-warning"></i> Catatan Dosen
                </h5>
            </div>
            <div class="card-body bg-light p-4">
                
                @if($pengajuan->catatan)
                    <div class="alert alert-warning border text-dark">
                        <strong>Pesan dari {{ $pengajuan->dosen->name }}:</strong><br>
                        <p class="mb-0 mt-2" style="white-space: pre-wrap;">{{ $pengajuan->catatan }}</p>
                    </div>
                @else
                    <p class="text-muted text-center py-3">Dosen belum memberikan catatan apapun.</p>
                @endif

                <hr>

                @if($pengajuan->status == 'Revisi')
                    <div class="alert alert-danger mb-4">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> <strong>Penting:</strong> Anda harus mengunggah ulang file proposal yang telah diperbaiki.
                    </div>

                    <form action="{{ route('mahasiswa.pengajuan.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="file_proposal" class="form-label fw-bold">Unggah Proposal Revisi (PDF) <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" id="file_proposal" name="file_proposal" accept="application/pdf" required>
                            <div class="form-text">Format wajib PDF, maksimal 5MB. File lama akan ditimpa.</div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-danger btn-lg text-white">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i> Kirim Revisi
                            </button>
                        </div>
                    </form>
                @elseif($pengajuan->status == 'Menunggu')
                    <div class="text-center py-4">
                        <i class="fa-solid fa-mug-hot text-secondary fa-3x mb-3 opacity-50"></i>
                        <p class="text-muted">Silakan tunggu dosen pembimbing Anda memeriksa proposal ini.</p>
                    </div>
                @elseif($pengajuan->status == 'ACC')
                    <div class="alert alert-success border text-dark">
                        <i class="fa-solid fa-party-horn me-1"></i> <strong>Selamat!</strong> Proposal Anda telah disetujui. Silakan kerjakan project/lomba Anda dan laporkan progresnya secara berkala di bawah ini.
                    </div>

                    <h6 class="fw-bold mt-4 mb-3"><i class="fa-solid fa-timeline text-primary me-2"></i> Log Progress Bimbingan</h6>
                    
                    <div class="mb-4">
                        @forelse($pengajuan->progress as $prog)
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted"><i class="fa-solid fa-clock me-1"></i> {{ \Carbon\Carbon::parse($prog->created_at)->format('d M Y, H:i') }}</small>
                                        @if($prog->file_lampiran)
                                            <a href="{{ asset('storage/' . $prog->file_lampiran) }}" target="_blank" class="badge bg-secondary text-decoration-none">
                                                <i class="fa-solid fa-paperclip"></i> Lampiran
                                            </a>
                                        @endif
                                    </div>
                                    <p class="mt-2 mb-2">{{ $prog->keterangan }}</p>
                                    
                                    @if($prog->tanggapan_dosen)
                                        <div class="bg-light p-2 rounded border border-warning border-opacity-50 mt-2">
                                            <small class="text-warning fw-bold"><i class="fa-solid fa-reply me-1"></i> Balasan Dosen:</small>
                                            <p class="mb-0 text-sm mt-1">{{ $prog->tanggapan_dosen }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-muted fst-italic text-center py-3">Belum ada progress yang dilaporkan.</p>
                        @endforelse
                    </div>

                    <hr>
                    <h6 class="fw-bold mb-3">Tambah Laporan Progress</h6>
                    <form action="{{ route('mahasiswa.progress.store', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small">Deskripsi/Keterangan Progress</label>
                            <textarea name="keterangan" rows="3" class="form-control" required placeholder="Contoh: Telah menyelesaikan Bab 1..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">File Lampiran (Opsional)</label>
                            <input type="file" name="file_lampiran" class="form-control form-control-sm">
                            <div class="form-text" style="font-size: 0.75rem;">Format bebas, maks 5MB. Gunakan untuk menyertakan foto atau dokumen.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-paper-plane me-1"></i> Kirim Progress
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
