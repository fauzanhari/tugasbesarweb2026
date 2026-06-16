@extends('layouts.public')

@section('title', 'Tentang Sistem')

@section('content')
<div class="bg-primary text-white py-5 mb-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);">
    <div class="container text-center py-4">
        <h1 class="fw-bold display-5">Tentang Sistem SIPRES</h1>
        <p class="lead opacity-75 mb-0">Sistem Peningkatan Prestasi Mahasiswa Fakultas</p>
    </div>
</div>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <div class="row g-5 align-items-center mb-5">
                    <div class="col-md-5 text-center">
                        <i class="fa-solid fa-trophy text-warning" style="font-size: 10rem;"></i>
                    </div>
                    <div class="col-md-7">
                        <h3 class="fw-bold text-primary mb-3">Apa itu SIPRES?</h3>
                        <p class="text-secondary" style="line-height: 1.8;">
                            <strong>SIPRES</strong> (Sistem Peningkatan Prestasi) adalah sebuah platform digital inovatif yang dikembangkan khusus untuk memfasilitasi, membina, dan mendata capaian prestasi mahasiswa di tingkat Fakultas.
                        </p>
                        <p class="text-secondary" style="line-height: 1.8;">
                            Sistem ini dirancang untuk menjembatani mahasiswa yang memiliki minat berlomba dengan Dosen Pembimbing yang memiliki keahlian di bidang terkait, sehingga proses bimbingan dapat berjalan lebih terarah, terpantau, dan menghasilkan output prestasi yang membanggakan.
                        </p>
                    </div>
                </div>

                <hr class="mb-5">

                <div class="row g-4 mb-5">
                    <div class="col-12 text-center mb-4">
                        <h3 class="fw-bold text-dark">Tujuan & Manfaat</h3>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-bullseye fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Sentralisasi Informasi</h5>
                            <p class="text-secondary small">Mahasiswa tidak perlu lagi kesulitan mencari info lomba. Seluruh info kompetisi bergengsi dirangkum dalam satu pintu.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-handshake-angle fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Bimbingan Terstruktur</h5>
                            <p class="text-secondary small">Proses pengajuan proposal dan bimbingan lomba dicatat secara digital agar progress mahasiswa dapat terpantau dengan jelas.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="text-center p-3">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-chart-line fs-1"></i>
                            </div>
                            <h5 class="fw-bold">Pendataan Prestasi</h5>
                            <p class="text-secondary small">Merekam jejak keberhasilan mahasiswa secara akurat untuk kebutuhan akreditasi fakultas dan pencapaian Indikator Kinerja Utama (IKU).</p>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-4 rounded text-center">
                    <h5 class="fw-bold mb-3">Siap untuk meraih prestasi?</h5>
                    <p class="text-muted mb-4">Jangan ragu untuk mendaftarkan akun Anda dan mulai mengeksplorasi berbagai lomba yang ada.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 rounded-pill">Daftar Sekarang</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
