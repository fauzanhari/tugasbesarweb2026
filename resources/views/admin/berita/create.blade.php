@extends('layouts.main')

@section('title', 'Tambah Berita Prestasi')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-plus-circle me-2"></i> Tambah Berita Baru
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}" class="text-decoration-none">Berita Prestasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                <h5 class="mb-0"><i class="fa-solid fa-pen me-2 text-primary"></i> Isi Detail Berita</h5>
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

                <form action="{{ route('admin.berita.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="judul" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Tim Fakultas Menjuarai Kompetisi Nasional" required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal" class="form-label fw-bold">Tanggal Publikasi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="konten" class="form-label fw-bold">Isi Berita / Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="konten" name="konten" rows="8" placeholder="Tuliskan cerita lengkap tentang prestasi yang diraih..." required>{{ old('konten') }}</textarea>
                    </div>

                    <div class="d-grid gap-2 mt-4 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.berita.index') }}" class="btn btn-light px-4 border">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-save me-1"></i> Simpan Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
