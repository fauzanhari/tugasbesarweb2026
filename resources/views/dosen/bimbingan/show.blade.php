@extends('layouts.main')

@section('title', 'Pantau Progress Bimbingan')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-chart-line me-2"></i> Pantau Progress Bimbingan
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dosen.bimbingan.index') }}" class="text-decoration-none">Bimbingan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Progress</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <!-- Kolom Info Mahasiswa -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
            <div class="card-body text-center p-4">
                <div class="bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem;">
                    <span class="fw-bold">{{ substr($bimbingan->mahasiswa->name, 0, 1) }}</span>
                </div>
                <h5 class="fw-bold mb-1">{{ $bimbingan->mahasiswa->name }}</h5>
                <p class="text-muted small mb-3">{{ $bimbingan->mahasiswa->email }}</p>
                
                <div class="text-start mt-4">
                    <h6 class="fw-bold text-muted small text-uppercase">Judul Lomba</h6>
                    <p class="text-dark fw-bold">{{ $bimbingan->judul_lomba }}</p>
                    
                    <h6 class="fw-bold text-muted small text-uppercase mt-3">Disetujui Pada</h6>
                    <p class="text-dark mb-0"><i class="fa-solid fa-calendar text-success me-1"></i> {{ \Carbon\Carbon::parse($bimbingan->updated_at)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Timeline Progress -->
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-4 pb-3 border-bottom-0">
                <h5 class="fw-bold mb-0"><i class="fa-solid fa-timeline text-primary me-2"></i> Riwayat Progress</h5>
                <p class="text-muted small mb-0 mt-1">Laporan perkembangan project/lomba dari mahasiswa.</p>
            </div>
            <div class="card-body p-4 pt-2">
                @forelse($bimbingan->progress as $prog)
                    <div class="card mb-4 border border-primary border-opacity-25 shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                            <span class="text-muted small"><i class="fa-solid fa-clock me-1"></i> Dilaporkan: {{ \Carbon\Carbon::parse($prog->created_at)->format('d M Y, H:i') }}</span>
                            @if($prog->file_lampiran)
                                <a href="{{ asset('storage/' . $prog->file_lampiran) }}" target="_blank" class="badge bg-secondary text-decoration-none px-2 py-1">
                                    <i class="fa-solid fa-paperclip"></i> Lihat Lampiran
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold text-dark mb-2">Laporan Mahasiswa:</h6>
                            <p class="text-dark">{{ $prog->keterangan }}</p>
                            
                            <hr class="text-muted">

                            @if($prog->tanggapan_dosen)
                                <div class="bg-warning bg-opacity-10 p-3 rounded border border-warning border-opacity-50">
                                    <h6 class="text-warning text-darken-2 fw-bold mb-2"><i class="fa-solid fa-reply me-1"></i> Tanggapan Anda:</h6>
                                    <p class="mb-0 text-dark">{{ $prog->tanggapan_dosen }}</p>
                                </div>
                            @else
                                <!-- Form Tanggapan Dosen -->
                                <form action="{{ route('dosen.bimbingan.progress.update', ['id' => $bimbingan->id, 'progress_id' => $prog->id]) }}" method="POST">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label text-muted small fw-bold">Berikan Tanggapan / Feedback:</label>
                                        <textarea name="tanggapan_dosen" rows="2" class="form-control" required placeholder="Tuliskan komentar atau masukan untuk progress ini..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Kirim Tanggapan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fa-solid fa-folder-open text-muted fa-4x mb-3 opacity-25"></i>
                        <h5 class="text-muted fw-bold">Belum Ada Progress</h5>
                        <p class="text-muted mb-0">Mahasiswa ini belum melaporkan perkembangan apapun.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
