@extends('layouts.main')

@section('title', 'Kelola Berita Prestasi')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-newspaper me-2"></i> Kelola Berita Prestasi
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita Prestasi</li>
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
                <h5 class="mb-0 text-secondary"><i class="fa-solid fa-list me-1"></i> Daftar Berita</h5>
                <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Berita
                </a>
            </div>
            <div class="card-body">
                @if($beritas->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-newspaper fa-4x mb-3 text-secondary opacity-50"></i>
                        <h5>Belum Ada Berita</h5>
                        <p>Belum ada berita prestasi yang ditambahkan ke dalam sistem.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="45%">Judul Berita</th>
                                    <th width="20%" class="text-center">Tanggal Publikasi</th>
                                    <th width="30%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beritas as $index => $berita)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $berita->judul }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fa-solid fa-pen me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                                </button>
                                            </form>
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
