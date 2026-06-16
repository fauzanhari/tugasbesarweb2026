@extends('layouts.main')

@section('title', 'Cari Dosen Pembimbing')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-primary">
                <i class="fa-solid fa-chalkboard-user me-2"></i> Daftar Dosen Pembimbing
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cari Dosen</li>
                </ol>
            </nav>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-3">
                <p class="text-muted mb-0">
                    <i class="fa-solid fa-info-circle me-1"></i>
                    Gunakan kolom <strong>Search</strong> di bawah ini untuk mencari dosen berdasarkan nama atau bidang keahliannya.
                </p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle w-100" id="dosenTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th width="25%">Nama Dosen</th>
                                <th width="20%">Email</th>
                                <th width="35%">Bidang Keahlian</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $index => $dosen)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $dosen->name }}</td>
                                    <td>{{ $dosen->email }}</td>
                                    <td>
                                        @if($dosen->keahlian)
                                            <span class="badge bg-info text-dark px-2 py-1">
                                                <i class="fa-solid fa-tag me-1"></i> {{ $dosen->keahlian->bidang_keahlian }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Belum diatur</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#dosenModal{{ $dosen->id }}">
                                                <i class="fa-solid fa-circle-info me-1"></i> Info
                                            </button>
                                            <a href="{{ route('mahasiswa.pengajuan.create', ['dosen_id' => $dosen->id]) }}" class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-hand-pointer me-1"></i> Pilih
                                            </a>
                                        </div>
                                    </td>
                                </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Kumpulan Modal Info Dosen (Harus di luar table agar layout tidak rusak) -->
@foreach ($dosens as $dosen)
<div class="modal fade" id="dosenModal{{ $dosen->id }}" tabindex="-1" aria-labelledby="dosenModalLabel{{ $dosen->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary" id="dosenModalLabel{{ $dosen->id }}"><i class="fa-solid fa-chalkboard-user me-2"></i> Profil Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4 mt-2">
                    <i class="fa-solid fa-user-circle fa-5x text-secondary opacity-25 mb-3"></i>
                    <h4 class="mb-1 text-dark fw-bold">{{ $dosen->name }}</h4>
                    <span class="badge bg-info text-dark px-3 py-2 mt-2">
                        <i class="fa-solid fa-tag me-1"></i> {{ $dosen->keahlian ? $dosen->keahlian->bidang_keahlian : 'Belum diatur' }}
                    </span>
                </div>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="30%">Email</td>
                        <td width="5%">:</td>
                        <td class="fw-bold">{{ $dosen->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Jabatan</td>
                        <td>:</td>
                        <td class="fw-bold">Dosen Tetap Fakultas</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-between">
                <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('mahasiswa.pengajuan.create', ['dosen_id' => $dosen->id]) }}" class="btn btn-success">
                    <i class="fa-solid fa-hand-pointer me-1"></i> Ajukan Proposal ke Dosen Ini
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Library jQuery & DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Inisialisasi DataTables saat halaman selesai dimuat
    $(document).ready(function() {
        $('#dosenTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json', // Mengubah bahasa bawaan menjadi Bahasa Indonesia
            }
        });
    });
</script>
@endsection
