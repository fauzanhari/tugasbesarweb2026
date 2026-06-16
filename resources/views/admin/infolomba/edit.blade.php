@extends('layouts.main')

@section('title', 'Edit Info Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-pen-to-square me-2"></i> Edit Info Lomba
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.infolomba.index') }}" class="text-decoration-none">Info Lomba</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('admin.infolomba.update', $lomba->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul Lomba <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $lomba->judul) }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penyelenggara" class="form-label fw-bold">Penyelenggara</label>
                        <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara', $lomba->penyelenggara) }}">
                        @error('penyelenggara') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi Lomba <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $lomba->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_batas" class="form-label fw-bold">Batas Waktu Pendaftaran</label>
                            <input type="date" class="form-control @error('tanggal_batas') is-invalid @enderror" id="tanggal_batas" name="tanggal_batas" value="{{ old('tanggal_batas', $lomba->tanggal_batas) }}">
                            @error('tanggal_batas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="link_pendaftaran" class="form-label fw-bold">Link Pendaftaran/Info Web</label>
                            <input type="url" class="form-control @error('link_pendaftaran') is-invalid @enderror" id="link_pendaftaran" name="link_pendaftaran" value="{{ old('link_pendaftaran', $lomba->link_pendaftaran) }}">
                            @error('link_pendaftaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.infolomba.index') }}" class="btn btn-light border">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Update Lomba</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
