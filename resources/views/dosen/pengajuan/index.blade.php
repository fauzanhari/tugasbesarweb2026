@extends('layouts.main')

@section('title', 'Daftar Pengajuan Masuk')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-inbox me-2"></i> Pengajuan Proposal Lomba Masuk
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Masuk</li>
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
            <div class="card-header bg-white pt-3 pb-2">
                <p class="text-muted mb-0">
                    <i class="fa-solid fa-info-circle me-1"></i> Daftar mahasiswa yang mengajukan Anda sebagai dosen pembimbing.
                </p>
            </div>
            <div class="card-body">
                @if($pengajuans->isEmpty())
                    <div class="text-center py-5 text-muted">
                        <i class="fa-regular fa-envelope-open fa-4x mb-3 text-secondary opacity-50"></i>
                        <h5>Belum Ada Pengajuan</h5>
                        <p>Belum ada mahasiswa yang mengajukan proposal lomba kepada Anda.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%" class="text-center">No</th>
                                    <th width="20%">Nama Mahasiswa</th>
                                    <th width="35%">Judul Lomba</th>
                                    <th width="15%" class="text-center">Tanggal</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $index => $pengajuan)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $pengajuan->mahasiswa->name }}</td>
                                        <td class="text-primary">{{ $pengajuan->judul_lomba }}</td>
                                        <td class="text-center small">{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}</td>
                                        <td class="text-center">
                                            @if($pengajuan->status == 'Menunggu')
                                                <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Baru</span>
                                            @elseif($pengajuan->status == 'Revisi')
                                                <span class="badge bg-danger"><i class="fa-solid fa-pen-to-square me-1"></i> Direvisi</span>
                                            @elseif($pengajuan->status == 'ACC')
                                                <span class="badge bg-success"><i class="fa-solid fa-check-double me-1"></i> ACC</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('dosen.pengajuan.show', $pengajuan->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fa-solid fa-magnifying-glass me-1"></i> Periksa
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
