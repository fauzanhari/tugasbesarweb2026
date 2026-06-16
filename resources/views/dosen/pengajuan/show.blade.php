@extends('layouts.main')

@section('title', 'Periksa Proposal Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-magnifying-glass-chart me-2"></i> Detail & Review Proposal
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dosen.pengajuan.index') }}" class="text-decoration-none">Pengajuan Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Periksa</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <!-- Kolom Kiri: Informasi Mahasiswa & File Proposal -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white pt-3 pb-2">
                <h5 class="mb-0"><i class="fa-solid fa-file-pdf me-2 text-danger"></i> Dokumen Proposal</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-4">
                    <tr>
                        <td width="30%" class="text-muted">Nama Mahasiswa</td>
                        <td width="5%">:</td>
                        <td class="fw-bold">{{ $pengajuan->mahasiswa->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Judul Kompetisi</td>
                        <td>:</td>
                        <td class="text-primary fw-bold">{{ $pengajuan->judul_lomba }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal Diajukan</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Saat Ini</td>
                        <td>:</td>
                        <td>
                            @if($pengajuan->status == 'Menunggu')
                                <span class="badge bg-warning text-dark px-3"><i class="fa-solid fa-clock me-1"></i> Menunggu Diperiksa</span>
                            @elseif($pengajuan->status == 'Revisi')
                                <span class="badge bg-danger px-3"><i class="fa-solid fa-pen-to-square me-1"></i> Sedang Direvisi</span>
                            @elseif($pengajuan->status == 'ACC')
                                <span class="badge bg-success px-3"><i class="fa-solid fa-check-double me-1"></i> Telah di-ACC</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="d-grid gap-2">
                    <a href="{{ asset('storage/' . $pengajuan->file_proposal) }}" target="_blank" class="btn btn-outline-danger btn-lg">
                        <i class="fa-solid fa-file-pdf me-2"></i> Buka / Unduh File PDF Proposal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Aksi Review -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white pt-3 pb-2">
                <h5 class="mb-0"><i class="fa-solid fa-clipboard-check me-2 text-primary"></i> Keputusan Pembimbing</h5>
            </div>
            <div class="card-body bg-light">
                
                @if($pengajuan->status == 'ACC')
                    <div class="text-center py-4">
                        <i class="fa-solid fa-circle-check text-success fa-4x mb-3"></i>
                        <h4 class="text-success fw-bold">Proposal Telah Disetujui</h4>
                        <p class="text-muted">Anda sudah memberikan ACC pada proposal ini.</p>
                        @if($pengajuan->catatan)
                            <div class="alert alert-light border text-start mt-3">
                                <strong>Catatan yang diberikan:</strong><br>
                                {{ $pengajuan->catatan }}
                            </div>
                        @endif
                        
                        <form action="{{ route('dosen.pengajuan.update', $pengajuan->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan ACC ini? Status akan dikembalikan ke Menunggu.');">
                            @csrf
                            <input type="hidden" name="status" value="Menunggu">
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-xmark me-1"></i> Batalkan Keputusan ACC
                            </button>
                        </form>
                    </div>
                @else
                    <form action="{{ route('dosen.pengajuan.update', $pengajuan->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-bold">Catatan / Pesan Revisi</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="5" placeholder="Tuliskan catatan perbaikan jika proposal perlu direvisi. Atau tinggalkan pesan semangat jika Anda meng-ACC nya.">{{ $pengajuan->catatan }}</textarea>
                            <div class="form-text">Berikan feedback yang membangun untuk mahasiswa Anda.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Pilih Tindakan <span class="text-danger">*</span></label>
                            
                            <div class="form-check form-check-inline border rounded p-3 me-3 bg-white w-100 mb-2">
                                <input class="form-check-input ms-1" type="radio" name="status" id="status_acc" value="ACC" required>
                                <label class="form-check-label ms-2 fw-bold text-success" for="status_acc">
                                    <i class="fa-solid fa-check-circle me-1"></i> ACC (Setujui Proposal)
                                </label>
                            </div>
                            
                            <div class="form-check form-check-inline border rounded p-3 me-0 bg-white w-100">
                                <input class="form-check-input ms-1" type="radio" name="status" id="status_revisi" value="Revisi" required>
                                <label class="form-check-label ms-2 fw-bold text-danger" for="status_revisi">
                                    <i class="fa-solid fa-pen-to-square me-1"></i> Minta Revisi
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-save me-2"></i> Simpan Keputusan
                            </button>
                        </div>
                    </form>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
