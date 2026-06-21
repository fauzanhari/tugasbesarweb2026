<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PublicController::class, 'index'])->name('home');
Route::get('/berita', [\App\Http\Controllers\PublicController::class, 'berita'])->name('public.berita.index');
Route::get('/berita/{id}', [\App\Http\Controllers\PublicController::class, 'beritaDetail'])->name('public.berita.show');
Route::get('/lomba', [\App\Http\Controllers\PublicController::class, 'lomba'])->name('public.lomba.index');
Route::get('/lomba/{id}', [\App\Http\Controllers\PublicController::class, 'lombaDetail'])->name('public.lomba.show');
Route::get('/tentang', [\App\Http\Controllers\PublicController::class, 'tentang'])->name('public.tentang');

Route::get('/dashboard', function () {
    $beritas = \App\Models\Berita::orderBy('tanggal', 'desc')->get();
    $infolombas = \App\Models\InfoLomba::orderBy('created_at', 'desc')->take(5)->get();
    
    $stats = [];
    if (auth()->check() && auth()->user()->role === 'admin') {
        $stats['total_mahasiswa'] = \App\Models\User::where('role', 'mahasiswa')->count();
        $stats['total_dosen'] = \App\Models\User::where('role', 'dosen')->count();
        $stats['total_proposal'] = \App\Models\PengajuanLomba::count();
        $stats['proposal_acc'] = \App\Models\PengajuanLomba::where('status', 'ACC')->count();
    }
    
    return view('dashboard', compact('beritas', 'infolombas', 'stats'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route khusus Mahasiswa
    Route::get('/mahasiswa/dosen', [\App\Http\Controllers\Mahasiswa\DosenController::class, 'index'])->name('mahasiswa.dosen.index');
    
    // Route Pengajuan Lomba (Mahasiswa)
    Route::get('/mahasiswa/pengajuan', [\App\Http\Controllers\Mahasiswa\PengajuanController::class, 'index'])->name('mahasiswa.pengajuan.index');
    Route::get('/mahasiswa/pengajuan/buat', [\App\Http\Controllers\Mahasiswa\PengajuanController::class, 'create'])->name('mahasiswa.pengajuan.create');
    Route::post('/mahasiswa/pengajuan', [\App\Http\Controllers\Mahasiswa\PengajuanController::class, 'store'])->name('mahasiswa.pengajuan.store');
    Route::get('/mahasiswa/pengajuan/{id}', [\App\Http\Controllers\Mahasiswa\PengajuanController::class, 'show'])->name('mahasiswa.pengajuan.show');
    Route::put('/mahasiswa/pengajuan/{id}', [\App\Http\Controllers\Mahasiswa\PengajuanController::class, 'update'])->name('mahasiswa.pengajuan.update');
    Route::post('/mahasiswa/pengajuan/{id}/progress', [\App\Http\Controllers\Mahasiswa\ProgressController::class, 'store'])->name('mahasiswa.progress.store');

    // Route khusus Dosen
    Route::get('/dosen/pengajuan', [\App\Http\Controllers\Dosen\PengajuanMasukController::class, 'index'])->name('dosen.pengajuan.index');
    Route::get('/dosen/pengajuan/{id}', [\App\Http\Controllers\Dosen\PengajuanMasukController::class, 'show'])->name('dosen.pengajuan.show');
    Route::post('/dosen/pengajuan/{id}/update', [\App\Http\Controllers\Dosen\PengajuanMasukController::class, 'update'])->name('dosen.pengajuan.update');
    Route::get('/dosen/bimbingan', [\App\Http\Controllers\Dosen\BimbinganController::class, 'index'])->name('dosen.bimbingan.index');
    Route::get('/dosen/bimbingan/{id}', [\App\Http\Controllers\Dosen\BimbinganController::class, 'show'])->name('dosen.bimbingan.show');
    Route::post('/dosen/bimbingan/{id}/progress/{progress_id}', [\App\Http\Controllers\Dosen\BimbinganController::class, 'updateProgress'])->name('dosen.bimbingan.progress.update');

    // Route khusus Admin
    Route::resource('/admin/berita', \App\Http\Controllers\Admin\BeritaController::class)->names('admin.berita')->parameters(['berita' => 'berita']);
    Route::resource('/admin/infolomba', \App\Http\Controllers\Admin\InfoLombaController::class)->names('admin.infolomba')->parameters(['infolomba' => 'infolomba']);
    Route::resource('/admin/users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
});

require __DIR__.'/auth.php';
