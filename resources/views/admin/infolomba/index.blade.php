@extends('layouts.main')

@section('title', 'Manajemen Info Lomba')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-trophy me-2"></i> Manajemen Info Lomba
            </h2>
            <a href="{{ route('admin.infolomba.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-1"></i> Tambah Info Lomba
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center py-3">No</th>
                                <th width="30%" class="py-3">Judul Lomba</th>
                                <th width="20%" class="py-3">Penyelenggara</th>
                                <th width="15%" class="py-3">Batas Waktu</th>
                                <th width="15%" class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lombas as $index => $lomba)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $lomba->judul }}</td>
                                    <td>{{ $lomba->penyelenggara ?? '-' }}</td>
                                    <td>
                                        @if($lomba->tanggal_batas)
                                            <span class="badge bg-warning text-dark px-2 py-1">
                                                <i class="fa-solid fa-calendar me-1"></i> {{ \Carbon\Carbon::parse($lomba->tanggal_batas)->format('d M Y') }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada batas</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.infolomba.edit', $lomba->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.infolomba.destroy', $lomba->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus info lomba ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fa-solid fa-folder-open text-muted fa-3x mb-3 opacity-25"></i>
                                        <h5 class="text-muted">Belum ada info lomba</h5>
                                        <p class="text-muted mb-0">Silakan tambahkan info lomba baru untuk mahasiswa.</p>
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
