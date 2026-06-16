@extends('layouts.main')

@section('title', 'Buat Pengajuan Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-file-upload me-2"></i> Form Pengajuan Lomba
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.pengajuan.index') }}" class="text-decoration-none">Pengajuan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Buat Baru</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3 pb-2">
                <h5 class="mb-0"><i class="fa-solid fa-pen-to-square me-2 text-primary"></i> Isi Detail Pengajuan</h5>
            </div>
            <div class="card-body p-4">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="judul_lomba" class="form-label fw-bold">Judul Lomba / Kompetisi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="judul_lomba" name="judul_lomba" value="{{ old('judul_lomba') }}" placeholder="Contoh: Lomba Inovasi Digital Nasional 2026" required>
                    </div>

                    <div class="mb-4">
                        <label for="dosen_id" class="form-label fw-bold">Dosen Pembimbing <span class="text-danger">*</span></label>
                        <select class="form-select form-select-lg" id="dosen_id" name="dosen_id" required>
                            <option value="" disabled {{ !$dosen ? 'selected' : '' }}>-- Pilih Dosen Pembimbing --</option>
                            @foreach($semuaDosen as $d)
                                <option value="{{ $d->id }}" {{ (old('dosen_id') == $d->id) || ($dosen && $dosen->id == $d->id) ? 'selected' : '' }}>
                                    {{ $d->name }} 
                                    @if($d->keahlian)
                                        ({{ $d->keahlian->bidang_keahlian }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Pilih dosen yang bidang keahliannya sesuai dengan lomba Anda.</div>
                    </div>

                    <div class="mb-4">
                        <label for="file_proposal" class="form-label fw-bold">File Proposal (Format PDF) <span class="text-danger">*</span></label>
                        <input class="form-control form-control-lg" type="file" id="file_proposal" name="file_proposal" accept=".pdf" required>
                        <div class="form-text text-muted">
                            <i class="fa-solid fa-info-circle"></i> Pastikan file berformat <strong>.pdf</strong> dan ukuran maksimal <strong>5 MB</strong>.
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-paper-plane me-2"></i> Kirim Pengajuan Proposal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
